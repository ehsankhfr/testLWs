<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class AuthController extends Controller
{
    /**
     * @Route("/api/version1/user/login", name="login")
     * @Method({"POST"})
     */
    public function loginAction(Request $request)
    {
        $username = $request->request->get('username');
        $password = $request->request->get('password');

        //TODO: validation
        //TODO: Check the user
        //TODO: Cookie creation
        //TODO: response

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
        
    }

}
