<?php

namespace Slumlords\Bundle\Controller;

use Doctrine\ORM\EntityRepository;
use Slumlords\Bundle\Entity\Course;
use Slumlords\Bundle\Entity\User;
use Slumlords\Bundle\Entity\Bank;
use Slumlords\Bundle\Entity\Property;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    public function indexAction() 
    {
        return $this->render('SlumlordsBundle:Admin:index.html.twig');
    }

    public function coursesAction() 
    {
        $courses = $this->getDoctrine()
            ->getRepository('SlumlordsBundle:Course')
            ->findAll();

        return $this->render('SlumlordsBundle:Admin:courses.html.twig', array(
            'courses' => $courses,
        ));
    }

    public function courseAddAction(Request $request) 
    {
        $course = new Course();

        // Prep the form for display
        $form = $this->createFormBuilder($course)
            ->add('columns', 'integer')
            ->add('rows', 'integer')
            ->add('name', 'text')
            ->add('active', 'choice', array(
                'choices'  => array(0 => 'Enabled', 1 => 'Disabled'),
                'preferred_choices' => array(0),
                'required' => false, // true
            ))
            ->getForm();

        // Catch the POST update once user saves the form
        // and hits the page again
        if ($request->isMethod('POST')) 
        {
            $form->bind($request);

            if ($form->isValid()) 
            {
		// Persist $course and calculate total number of properties
                $em = $this->getDoctrine()->getManager();
                $totalProperties = $form->get('columns')->getData() * $form->get('rows')->getData();
                $em->persist($course);
                $em->flush();

                // Populate the database with properties
                for ($i = 0; $i < $totalProperties; $i++) {
                    $property = new Property();
                    $property->setRent(0);
                    $property->setIsActive(1); // Default the property to active
                    $property->setCourse($course); // Assign property a course
                    $em->persist($property);
                    $em->flush();
                }

                // After save, redirect viewer back to users list
                return $this->redirect($this->generateUrl('slumlords_admin_courses'));
            }
        }

        return $this->render('SlumlordsBundle:Admin:course_add.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function courseEditAction($id, Request $request) 
    {
        $course = $this->getDoctrine()
            ->getRepository('SlumlordsBundle:Course')
            ->find($id);

        // Prep the form for display
        $form = $this->createFormBuilder($course)
            ->add('name', 'text')
            ->add('active', 'choice', array(
                'choices'  => array(0 => 'Enabled', 1 => 'Disabled'),
                'required' => false, // true
            ))
            ->getForm();

        // Catch the POST update once user saves the form
        if ($request->isMethod('POST')) 
        {
            $form->bind($request);

            if ($form->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                $em->persist($course); // Persist the form changes
                $em->flush();

                return $this->redirect($this->generateUrl('slumlords_admin_courses'));
            }
        }

        return $this->render('SlumlordsBundle:Admin:course_edit.html.twig', array(
            'course' => $course,
            'form' => $form->createView(),
        ));
    }

    public function courseShowAction($id) 
    {

    }

    public function usersAction() 
    {
		$users = $this->getDoctrine()
		    ->getRepository('SlumlordsBundle:User')
		    ->findAll();

        return $this->render('SlumlordsBundle:Admin:users.html.twig', array(
            'users' => $users,
        ));
    }

    public function userAddAction(Request $request) 
    {
        $user = new User();

        // Prep the form for display
        $form = $this->createFormBuilder($user)
            ->add('username', 'text')
            ->add('firstName', 'text')
            ->add('lastName', 'text')
            ->add('password', 'password', array (
                'property_path' => false,
                'required' => true,
            ))
            ->add('email', 'text')
            ->add('wage', 'text')
            ->add('enabled', 'choice', array(
                'choices'  => array(0 => 'Enabled', 1 => 'Disabled'),
                'preferred_choices' => array(0),
                'required' => true,
            ))       
            ->add('roleList', 'choice', array(
                'choices'   => $this->container->getParameter('security.role_hierarchy.roles'),
                'expanded' => false,
                'label' => 'Role',
                'multiple'  => false,
                'property_path' => false,
            ))
            ->add('courses', null, array(
                'class' => 'Slumlords\Bundle\Entity\Course',
                'property' => 'name',
                'expanded' => true
            ))
            ->getForm();

        // Catch the POST update once user saves the form
        // and hits the page again
        if ($request->isMethod('POST')) 
        {
            $form->bind($request);

            if ($form->isValid()) 
            {
                $roles = $form->get('roleList')->getData();
                $user->addRole($roles);

                if ($form->get('password')->getData()) 
                {
                    $factory = $this->get('security.encoder_factory');
                    $encoder = $factory->getEncoder($user);
                    $password = $encoder->encodePassword($form->get('password')->getData(), $user->getSalt()); // Hash plaintext-provided password

                    $user->setPassword($password); // Pass on hashed password
                }

                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                // After save, redirect viewer back to users list
                return $this->redirect($this->generateUrl('slumlords_admin_users'));;
            }
        }

        return $this->render('SlumlordsBundle:Admin:user_add.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function userEditAction($id, Request $request) 
    {
        $user = $this->getDoctrine()
            ->getRepository('SlumlordsBundle:User')
            ->find($id);

        // Generate an array of the user's current course IDs
        // - Needed for properly setting up account information
        $userCourses = array(); 
        foreach($user->getCourses() as $course) {
            $userCourses[] = $course->getId();
        }

        // Prep the form for display
        $form = $this->createFormBuilder($user)
            ->add('username', 'text')
            ->add('firstName', 'text')
            ->add('lastName', 'text')
            ->add('password', 'password', array(
                'property_path' => false,
                'required'      => false,
            ))
            ->add('email', 'text')
            ->add('wage', 'text')
            ->add('enabled', 'choice', array(
                'choices'  => array(0 => 'Disabled', 1 => 'Enabled'),
                'preferred_choices' => array(0),
                'required' => true,
            ))
            ->add('roleList', 'choice', array(
                'choices'   => array(
                    'ROLE_SUPER_ADMIN' => 'ROLE_SUPER_ADMIN',
                    'ROLE_INSTRUCTOR' => 'ROLE_INSTRUCTOR',
                    'ROLE_STUDENT' => 'ROLE_STUDENT'
                ),
                'expanded' => false,
                'label' => 'Roles',
                'multiple'  => false,
                'property_path' => false,
                'required' => false
            ))
            ->add('courses', 'entity', array(
                'class' => 'Slumlords\Bundle\Entity\Course',
                'expanded' => true,
                'multiple' => true,
                'property' => 'name',
            ))
            ->getForm();


        // Catch the POST update once user saves the form
        // and hits the page again
        if ($request->isMethod('POST')) 
        {
            $form->bind($request);

            if ($form->isValid())
            {
                // Get the supplied role
                $roles = $form->get('roleList')->getData();
                $user->setRoles(array($roles)); // save the supplied role

                if ($form->get('password')->getData()) 
                {
                    $factory = $this->get('security.encoder_factory');
                    $encoder = $factory->getEncoder($user);
                    $password = $encoder->encodePassword($form->get('password')->getData(), $user->getSalt());

                    $user->setPassword($password);
                }

                // Check to see if the form set any courses
                if ($form->get('courses')->getData()) 
                {
                    // Loop through each course and check to see if the user already has a bank account
                    foreach ($form->get('courses')->getData() as $course) {
                        $courseFound = false;

                        // Loop through each of the user's current courses
                        foreach ($userCourses as $currentCourse) {
                            // Check to see if current course is selected
                            if ($course->getId() == $currentCourse) {
                                $courseFound = true; // User has the course
                            }
                        }

                        // Setup a new bank account if the user doesn't have one
                        // @TODO Will it add a new one if the user removes the class and then readds?
                        if (!$courseFound) {
                            $bankAccount = new Bank();
                            $bankAccount->setUser($user);
                            $bankAccount->setCourse($course);
                            $bankAccount->setBalance(0);

                            $em = $this->getDoctrine()->getManager();
                            $em->persist($bankAccount);
                            $em->flush();
                        }
                    }
                }


                // Save changes to the database
                $em = $this->getDoctrine()->getManager();
                $this->get('fos_user.user_manager')->updateUser($user, false);
                // $em->persist($user);
                $em->flush();

                // After save, redirect viewer back to users list
                return $this->redirect($this->generateUrl('slumlords_admin_users'));
            }
        }

        return $this->render('SlumlordsBundle:Admin:user_edit.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
        ));
    }

    public function userShowAction($id) 
    {
    }
}
