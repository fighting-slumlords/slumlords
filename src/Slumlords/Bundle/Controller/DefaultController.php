<?php

namespace Slumlords\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Slumlords\Bundle\Entity\Log;
use Slumlords\Bundle\Entity\Bank;
use Slumlords\Bundle\Entity\Offer;
use Slumlords\Bundle\Entity\User;
use Slumlords\Bundle\Entity\Property;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse; 

class DefaultController extends Controller
{
    public function indexAction() 
    {
        $user = $this->getUser();

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
    
    public function attendanceAction($courseId)
    {
        $users = $this->getDoctrine()
                      ->getRepository('SlumlordsBundle:Course')
                      ->find($courseId)
                      ->getUsers();
 
        return $this->render('SlumlordsBundle:Default:attendance.html.twig',
                             array('users' => $users,
                                   'courseId' => $courseId)
                             );
    }

    public function propertyOfferResponseAction($courseId, $id, Request $request) 
    {

        $user = $this->get('security.context')->getToken()->getUser();
  
        $offer = $this->getDoctrine()
            ->getRepository('SlumlordsBundle:Offer')
            ->find($request->request->get('offer_id'));

        $property = $this->getDoctrine()
            ->getRepository('SlumlordsBundle:Property')
            ->find($id);

        $bankAccount = $this->getDoctrine()
            ->getRepository('SlumlordsBundle:Bank')
            ->findOneBy(
                array('course' => $property->getCourse(), 'user' => $user)
            );

        $newOwnerBankAccount = $this->getDoctrine()
            ->getRepository('SlumlordsBundle:Bank')
            ->findOneBy(
                array('course' => $property->getCourse(), 'user' => $offer->getBuyer())
            );

        if ($request->isMethod('POST')) 
        {
            if ($request->request->get('action') == "Accept") {
                 $offer->setStatus('accepted');
                 $property->setOwner($offer->getBuyer());
                 // increase old owner's bank
                 $bankAccount->addBalance($offer->getAmount());
                 // decrease new owner's bank
                 $newOwnerBankAccount->setBalance($newOwnerBankAccount->getBalance() - $offer->getAmount());
		 $logSeller = new Log();
		 $logSeller->entry('Sold', $offer->getAmount(), $user->getUsername(), $offer->getBuyer()->getUsername(), $property->getID());
                 $logBuyer = new Log();
		 $logBuyer->entry('Purchased', $offer->getAmount(), $offer->getBuyer()->getUsername(), $user->getUsername(), $property->getID());

		 $em = $this->getDoctrine()->getEntityManager();
                 $em->persist($logSeller);
		 $em->persist($logBuyer);
		 $em->flush();

                 $this->get('session')->getFlashBag()->add('notice', 'It has been done.');
            } else {
		$offer->setStatus('rejected');
		$em = $this->getDoctrine()->getEntityManager();
		$em->flush();
	
		$this->get('session')->getFlashBag()->add('notice', 'Rejected ' . $offer->getBuyer() . '\'s offer.');
            }
	    return new RedirectResponse($this->generateUrl('slumlords_properties'));
        }
    }

    public function propertyOfferAction($courseId, $id, Request $request)
    { 
        $user = $this->get('security.context')->getToken()->getUser();

        $property = $this->getDoctrine()
            ->getRepository('SlumlordsBundle:Property')
            ->find($id);

        $bankAccount = $this->getDoctrine()
            ->getRepository('SlumlordsBundle:Bank')
            ->findOneBy(
                array('course' => $property->getCourse(), 'user' => $user)
            );

        if ($request->isMethod('POST')) 
        {
            $offer = new Offer();
              
            $getOffer = $request->request->get('offer');

            if (is_numeric($getOffer)) {
                if ($bankAccount->getBalance() >= $getOffer) {
                    $offer->setAmount($getOffer);
                } else { 
                    $this->get('session')->getFlashBag()->add('notice', 'Slow down there, pal.. Your offer of $'.$getOffer.' is more than what\'s in your bank account.');
                    $url = $request->headers->get('referer');

                    return new RedirectResponse($url);
                }
            } else { 
                $this->get('session')->getFlashBag()->add('notice', 'Your offer of $'.$getOffer.' is not a number. Try again.');
                $url = $request->headers->get('referer');

                return new RedirectResponse($url);
            }       

            $offer->setBuyer($user);
            $offer->setProperty($property);          
            $offer->setStatus("waiting");
            $offer->setTimestamp(new \DateTime('now'));

            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($offer);
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', 'Your offer of $'.$_POST['offer'].' has been submitted.');
            $url = $request->headers->get('referer');

            return new RedirectResponse($url);
        }
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
                array('course' => $property->getCourse(), 'user' => $user)
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
                $property->setIsActive(false);
                $property->setRenter($user);
                $em->flush();

                
                $this->get('session')->getFlashBag()->add('notice', 'Your balance has been updated to $'.$bankAccount->getBalance().' and you are now assigned to sit in Property #'.$property->getId().'.');
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
                array('course' => $property->getCourse(), 'user' => $user)
            );
   
        $offers = $this->getDoctrine()
            ->getRepository('SlumlordsBundle:Offer')
            ->findBy(
                array('property' => $property)
            );

        // Prep the form for display
        $form = $this->createFormBuilder($property)
            ->add('rent', 'integer')
            ->getForm();

        // Catch the POST update once user saves the form
        // and hits the page again
        if ($request->isMethod('POST')) 
        {
            if ($request->request->get('rent')) 
            {
                $property->setRent($request->request->get('rent'));
                $em = $this->getDoctrine()->getManager();
                $em->flush();
            }
            if ($request->request->get('price'))
            {
                $property->setPrice($request->request->get('price'));
                $em = $this->getDoctrine()->getManager();
                $em->flush();
            }

            return $this->redirect($this->generateUrl('slumlords_properties'));;
        }

        return $this->render('SlumlordsBundle:Default:property_edit.html.twig', array(
            'property' => $property,
            'courseId' => $courseId,
            'form' => $form->createView(),
            'account' => $bankAccount,
            'offers' => $offers
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

        $account = $this->getDoctrine()
            ->getRepository('SlumlordsBundle:Bank')
            ->findOneBy(
                array('course' => $course, 'user' => $user)
                //array('user' => $user)
            );

        $log = $this->getDoctrine()->getRepository('SlumlordsBundle:Log')
            ->findBy(
                array('targetID' => $user->getUsername()),
                array('timestamp' => 'DESC')
            );
        //print_r($log[0]);
	/*$targetUsername = $this->getDoctrine()->getRepository('SlumlordsBundle:User')
	    ->find($log->getTargetID()
	    );
	
	$originUsername = $this->getDoctrine()->getRepository('SlumlordsBundle:User')
	    ->find($log->getOriginID()
	    );*/
        return $this->render('SlumlordsBundle:Default:bank.html.twig', array(
            'user' => $user,
            'account' => $account, 
            'log' => $log,
            'course' => $course
	    //'originUser' => $originUsername,
	    //'targetUser' => $targetUsername
        ));
    }
}
