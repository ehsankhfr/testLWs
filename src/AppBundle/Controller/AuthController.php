<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\JsonResponse;

use AppBundle\Entity\Users;
use AppBundle\Entity\Sessions;

const SESSION_LIMIT = 36000;

class AuthController extends Controller
{

    /**
     * @Route("/api/version1/user/login", name="login")
     * @Method({"POST"})
     */
    public function loginAction(Request $request)
    {
        $content = $request->getContent();

        $content = json_decode($content, true);

        if (empty($content)) {
            $response = new JsonResponse();
                    $response->headers->clearCookie('LW_ssn');
                    $response->setData(array('status' => 0, 'message' => 'invalid user information'));
                    return $response;
        }

        $username = $content['username'];
        $password = $content['password'];

        //DONE: validation
        if (
            (empty($password) || strlen(trim($password)) < 8 || strlen(trim($password)) > 15) ||
            (empty($username) || strlen(trim($username)) < 2 || strlen(trim($username)) > 30)
        ) {
            $response = new JsonResponse();
            $response->headers->clearCookie('LW_ssn');
            $response->setData(array('status' => 0, 'message' => 'invalid user information'));
            return $response;
        }

        //DONE: Check the user
        $user = $this->getDoctrine()
            ->getRepository('AppBundle:Users')
            ->findOneByUsername($username);

        if (empty($user)) {
            // the user is getting created if it doesn't exist
            $user = new Users();

            $options = [
                'cost' => 12,
            ];
            $password = password_hash($password, PASSWORD_BCRYPT, $options);

            $user->setPassword($password);

            $user->setUsername($username);

            $em = $this->getDoctrine()->getManager();

            $em->persist($user);
            $em->flush();
        } else {
            // if the user exist it will be checked against the stored password
            if (!password_verify($password, $user->getPassword())) {
                $response = new JsonResponse();
                $response->headers->clearCookie('LW_ssn');
                $response->setData(array('status' => 0, 'message' => 'wrong password'));
                return $response;
            }
        }

        //DONE: Cookie creation
        $session = $this->getDoctrine()
            ->getRepository('AppBundle:Sessions')
            ->findOneByUserId($user->getId());

        $shouldCreateSession = false;

        if (!empty($session)) {
            if ((time() - $session->getSessionTime()) > SESSION_LIMIT) {
                $em = $this->getDoctrine()->getManager();
                $query = $em->createQuery('DELETE AppBundle:Sessions s WHERE s.userId = :user_id');
                $query->setParameters(array(
                    ':user_id' => $user->getId()
                ));
                $shouldCreateSession = true;
            }

        } else {
            $shouldCreateSession = true;
        }

        if ($shouldCreateSession) {
            $session = new Sessions();
            $session->setUserId($user->getId());
            $session->setSessionId(uniqid() . time());
            $session->setSessionTime(time());
            $em = $this->getDoctrine()->getManager();

            $em->persist($session);
            $em->flush();
        }

        //DONE: response
        $response = new JsonResponse();
        $response->headers->setCookie(
            new Cookie(
                'LW_ssn',
                $session->getSessionId(),
                time() + (SESSION_LIMIT),
                   '/',      // Path.
                   null,     // Domain.
                   false,    // Xmit secure https.
                   false     // HttpOnly Flag.
            )
        );
        $response->setData(array(
            'status' => 1,
            'userid' => $user->getId()
        ));
        return $response;
    }

    /**
     * @Route("/api/version1/user/logout", name="logout")
     * @Method({"POST"})
     */
    public function logoutAction(Request $request)
    {
        $userid = $request->request->get('userid');
        $em = $this->getDoctrine()->getManager();

        //DONE: validation
        if ((empty($userid))) {
            $response = new JsonResponse();
            $response->headers->clearCookie('LW_ssn');
            $response->setData(array(
                'status' => 0,
                'message' => 'invalid user information'
            ));
            return $response;
        }

        //TODO: more comments needed
        $cookies = $request->cookies;
        if (!$cookies->has('LW_ssn')) {

            $response = new JsonResponse();
            $response->headers->clearCookie('LW_ssn');
            $response->setData(array(
                'status' => 0,
                'message' => 'invalid user information'
            ));
            return $response;

        } else {

            $session = $this->getDoctrine()
                ->getRepository('AppBundle:Sessions')
                ->findOneBySessionId($cookies->get('LW_ssn'));

            if ($session) {
                $query = $em->createQuery('DELETE AppBundle:Sessions s WHERE s.userId = :user_id');
                $query->setParameters(array(
                    ':user_id' => $userid
                ));
                $query->execute();
                $response = new JsonResponse();
                $response->headers->clearCookie('LW_ssn');
                $response->setData(array('status' => 1));
                return $response;
            } else {
                $response = new JsonResponse();
                $response->headers->clearCookie('LW_ssn');
                $response->setData(array(
                    'status' => 0,
                    'message' => 'invalid user information'
                ));
                return $response;
            }

        }
    }

}
