<?php

namespace Slumlords\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction() 
    {
        return $this->render('SlumlordsBundle:Default:index.html.twig');
    }

    public function desksAction()
    {
        $desks = $this->getDoctrine()
            ->getRepository('SlumlordsBundle:Property')
            ->findAll();

        $this->getDoctrine()->getEntityManager()->flush();

        return $this->render('SlumlordsBundle:Default:desks.html.twig', array(
            'desks' => $desks));
    }

    public function bankAction()
    {
        return $this->render('SlumlordsBundle:Default:bank.html.twig');
    }
}
