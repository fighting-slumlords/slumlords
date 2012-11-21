<?php

namespace Slumlords\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction() 
    {
        $user = $this->get('security.context')->getToken()->getUser();

        return $this->render('SlumlordsBundle:Default:index.html.twig', array(
            'user' => $user));
    }

    public function desksAction()
    {
        $desks = $this->getDoctrine()
            ->getRepository('SlumlordsBundle:Property')
            ->findAll();
            
        return $this->render('SlumlordsBundle:Default:desks.html.twig', array(
            'desks' => $desks));
    }

    public function bankAction()
    {
        return $this->render('SlumlordsBundle:Default:bank.html.twig');
    }
}
