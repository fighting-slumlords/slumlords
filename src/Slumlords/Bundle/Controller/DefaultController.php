<?php

namespace Slumlords\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Slumlords\Bundle\Entity\Log;
use Slumlords\Bundle\Entity\Bank;
use Slumlords\Bundle\Entity\User;
use Slumlords\Bundle\Entity\Property;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse; 

class DefaultController extends Controller
{
    public function indexAction() 
    {
        $user = $this->get('security.context')->getToken()->getUser();

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
            'user' => $user
        ));
    }

    public function propertyRentAction($courseId, $id, Request $request)
    {
        $user = $this->get('security.context')->getToken()->getUser();

        $property = $this->getDoctrine()
            ->getRepository('SlumlordsBundle:Property')
            ->find($id);

        $bankAccount = $this->getDoctrine()
            ->getRepository('SlumlordsBundle:Bank')
            ->findOneBy(
                array('course' => $property->getCourse()),
                array('user' => $user)
            );
        /* Example on how to add balance
        $em = $this->getDoctrine()->getManager();
        $bankAccount->addBalance(250);
        $em->flush();
        */
 
        // Catch the POST update once user saves the form
        // and hits the page again
        if ($request->isMethod('POST')) 
        {
            if ($bankAccount->getBalance() < $property->getRent())
            {
                $this->get('session')->getFlashBag()->add('notice', 'Your balance of $'.$bankAccount->getBalance().' is less than the property\'s rent of $'.$property->getRent().'.');
                $url = $request->headers->get('referer');

                return new RedirectResponse($url);
            } else {
                // @TODO: Set property as occupied until next class
                $em = $this->getDoctrine()->getManager();
                $bankAccount->setBalance($bankAccount->getBalance() - $property->getRent());
                $property->setIsActive(true);
                $em->flush();

                
                $this->get('session')->getFlashBag()->add('notice', 'Your balance has been updated to $'.$bankAccount->getBalance().' and you are now assigned to sit in Property #'.$property->getId().'.');
                $url = $request->headers->get('referer');
                return new RedirectResponse($this->generateUrl('slumlords_properties'));
            }
        }
    }

    public function propertyEditAction($courseId, $id, Request $request)
    {
        $user = $this->get('security.context')->getToken()->getUser();

        $property = $this->getDoctrine()
            ->getRepository('SlumlordsBundle:Property')
            ->find($id);

        $bankAccount = $this->getDoctrine()
            ->getRepository('SlumlordsBundle:Bank')
            ->findOneBy(
                array('course' => $property->getCourse()),
                array('user' => $user)
            );

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
            'courseId' => $courseId,
            'form' => $form->createView(),
            'account' => $bankAccount
        ));
    }

    public function propertiesShowAction($id)    
    {
        $user = $this->get('security.context')->getToken()->getUser();

        $course = $this->getDoctrine()
            ->getRepository('SlumlordsBundle:Course')
            ->findOneBy(
                array('id' => $id)
            );
 
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

    public function propertiesAction()
    {     
        $user = $this->get('security.context')->getToken()->getUser();

        $course = $user->getCourses()[0];

        if (!$course) {
            $course = null;
        }
       
        // Forward the user to the correct controller with the course ID 
        $response = $this->forward('SlumlordsBundle:Default:propertiesShow', array (
            'id' => $course->getId()
        ));

        return $response;
    }

    public function bankAction()
    {
        $user = $this->get('security.context')->getToken()->getUser();

        $course = $user->getCourses()[0]; // @TODO: Don't assume a course exists

        $bank = $this->getDoctrine()->getRepository('SlumlordsBundle:Bank');

        $account = $bank->findOneBy(
            array('user' => $user),
            array('course' => $course)
        );

        $log = $this->getDoctrine()->getRepository('SlumlordsBundle:Log')
            ->findBy(
                array('targetID' => $user->getId()),
                array('timestamp' => 'DESC')
            );
        
        return $this->render('SlumlordsBundle:Default:bank.html.twig', array(
            'user' => $user,
            'account' => $account, 
            'log' => $log,
            'course' => $course
        ));
    }
}
