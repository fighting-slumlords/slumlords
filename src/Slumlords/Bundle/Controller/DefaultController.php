<?php

namespace Slumlords\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Slumlords\Bundle\Entity\Log;

class DefaultController extends Controller
{
    public function indexAction() 
    {
        $user = $this->get('security.context')->getToken()->getUser();

        /*
        $log = new Log();
        $log->entry('transaction', 1000);
        $log2 = new Log();
        $log2->entry('event', 100000, 1, 0, 0);
        $log3 = new Log();
        $log3->entry('purchase', 100, 1, 0, 0);

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($log);
        $em->persist($log2);
        $em->persist($log3);
        $em->flush();
        */
        
        return $this->render('SlumlordsBundle:Default:index.html.twig', array(
            'user' => $user));
    }

    public function propertiesAction()
    {
        $properties = $this->getDoctrine()
            ->getRepository('SlumlordsBundle:Property')
            ->findAll();
            
        return $this->render('SlumlordsBundle:Default:properties.html.twig', array(
            'properties' => $properties));
    }

    public function bankAction()
    {
        $user = $this->get('security.context')->getToken()->getUser();
        
        return $this->render('SlumlordsBundle:Default:bank.html.twig', array(
            'user' => $user));
    }
}
