<?php

namespace Slumlords\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Slumlords\Bundle\Entity\Log;
use Slumlords\Bundle\Entity\Bank;
use Slumlords\Bundle\Entity\User;
use Slumlords\Bundle\Entity\Property;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction() 
    {
        //$user = $this->get('security.context')->getToken()->getUser();

        /*
        $newUser = new User();

        $newUser->setUsername('mjhale');
        $newUser->setEmail('john.doe@example.com');
        $newUser->setPlainPassword('failure');
        $newUser->setFirstName("Michael");
        $newUser->setLastName("Hale");
        $newUser->setWage(5000);
        $newUser->setSuperAdmin(true);
        $newUser->setEnabled(true);

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($newUser);
        $em->flush();
        */
        return $this->render('SlumlordsBundle:Default:index.html.twig', array(
            //'user' => $user
        ));
    }

    public function propertyRentAction($id, Request $request)
    {
        $property = $this->getDoctrine()
            ->getRepository('SlumlordsBundle:Property')
            ->find($id);



        // Catch the POST update once user saves the form
        // and hits the page again
        if ($request->isMethod('POST')) 
        {
            $user = $this->get('security.context')->getToken()->getUser();

            return $property->getRent();
        }

        return $property->getRent;
    }

    public function propertyEditAction($id, Request $request)
    {
        $property = $this->getDoctrine()
            ->getRepository('SlumlordsBundle:Property')
            ->find($id);

        // Prep the form for display
        $form = $this->createFormBuilder($property)
            ->add('rent', 'integer')
            ->getForm();

        // Catch the POST update once user saves the form
        // and hits the page again
        if ($request->isMethod('POST')) 
        {
            $form->bind($request);

            if ($form->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                $em->persist($property);
                $em->flush();

                return $this->redirect($this->generateUrl('slumlords_properties'));;
            }
        }

        return $this->render('SlumlordsBundle:Default:property_edit.html.twig', array(
            'property' => $property,
            'form' => $form->createView(),
        ));
    }

    public function propertiesAction()
    {
        $user = $this->get('security.context')->getToken()->getUser();

        $course = $user->getCourses()[0];

        if (!$course) {
            $course = null;
        }
        
        $properties = $this->getDoctrine()
            ->getRepository('SlumlordsBundle:Property')
            ->findBy(
                array('course' => $course)
            );
        
        return $this->render('SlumlordsBundle:Default:properties.html.twig', array(
            'properties' => $properties,
            'user'       => $user,
            'course'     => $course
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
