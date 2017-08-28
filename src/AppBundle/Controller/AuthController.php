<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthController extends Controller
{
    //TODO: make it only POST
    /**
     * @Route("/api/version1/user/login", name="login")
     * @Method({"POST","GET"})
     */
    public function loginAction(Request $request)
    {
        $username = $request->request->get('username');
        $password = $request->request->get('password');

        //TODO: validation
        //TODO: Check the user
        //TODO: Cookie creation
        //TODO: response
        $response = new JsonResponse();
        $response->setData(array('status' => 1));
        return $response;
    }

    //TODO: make it only POST
    /**
     * @Route("/api/version1/user/logout", name="logout")
     * @Method({"POST","GET"})
     */
    public function logoutAction(Request $request)
    {
        $userid = $request->request->get('userid');
        $em = $this->getDoctrine()->getManager();
        //TODO: validation
        $response = new JsonResponse();
        $response->setData(array('status' => 1));
        return $response;

    }

}
