<?php

namespace Slumlords\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Slumlords\Bundle\Entity\Log;
use Slumlords\Bundle\Entity\Bank;

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
        $course = $this->getDoctrine()
            ->getRepository('SlumlordsBundle:Course')
            ->find(12);

        $propertyUsername = array();
 
        foreach ($course->getProperties() as $property) {
         
echo $property->getId();
        } 

            
        return $this->render('SlumlordsBundle:Default:properties.html.twig', array(
            'course' => $course,
        ));
    }

    public function bankAction()
    {
        $user = $this->get('security.context')->getToken()->getUser();
        $bank = $this->getDoctrine()->getRepository('SlumlordsBundle:Bank');
        $account = $bank->findOneByAccountID($user->getId());
        if(!$account) {
            $account = new Bank();
            $account->setAccountID($user->getID());
            $account->setBalance(0);
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($account);
            $em->flush();
        }
        $log = $this->getDoctrine()->getRepository('SlumlordsBundle:Log')
            ->findBy(array('targetID' => $user->getId()),
                     array('timestamp' => 'DESC'));
        
        return $this->render('SlumlordsBundle:Default:bank.html.twig', array(
            'user' => $user, 'account' => $account, 'log' => $log));
    }
}
