<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AuthController extends Controller
{
    /**
     * @Route("/api/version1/user/login")
     */
    public function loginAction()
    {
        return $this->render('AppBundle:Auth:login.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/api/version1/user/logout")
     */
    public function logoutAction()
    {
        return $this->render('AppBundle:Auth:logout.html.twig', array(
            // ...
        ));
    }

}
