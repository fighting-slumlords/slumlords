<?php

namespace Slumlords\Bundle\Controller;

use Slumlords\Bundle\Entity\Property;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

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

        return $this->render('SlumlordsBundle:Default:desks.html.twig', array(
            'desks' => $desks));
    }

    public function bankAction()
    {
        return $this->render('SlumlordsBundle:Default:bank.html.twig');
    }
}
