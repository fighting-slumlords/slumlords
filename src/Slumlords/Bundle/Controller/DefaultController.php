<?php

namespace Slumlords\Bundle\Controller;

use Slumlords\Bundle\Entity\Property;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction() 
    {
        // Prep mock property
        $property = new Property();
        $property->setAccountID(213);
        $property->setRent(500);
 
        // Create mock property data
        // $em = $this->getDoctrine()->getEntityManager();
        // $em->persist($property);
        // $em->flush();

        // Get property data
        $getProperty = $this->getDoctrine()
            ->getRepository('SlumlordsBundle:Property')
            ->find(1);

        return $this->render('SlumlordsBundle:Default:index.html.twig');
    }

    public function desksAction()
    {
        return $this->render('SlumlordsBundle:Default:desks.html.twig');
    }
}
