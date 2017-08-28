<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="defaultIndex")
     */
    public function indexAction(Request $request)
    {
        $response = $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
        return $response;
    }

    /**
     * @Route("/{base}", name="defaultOther", requirements={"base"="^(?!api).*"})
     */
    public function otherAction(Request $request)
    {
        return $this->redirectToRoute('defaultIndex');
    }
}
