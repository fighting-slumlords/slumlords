<?php

namespace Slumlords\Bundle\Controller;

use Slumlords\Bundle\Entity\Course;
use Slumlords\Bundle\Entity\User;
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
                'required' => true,
            ))
            ->getForm();

        // Catch the POST update once user saves the form
        // and hits the page again
        if ($request->isMethod('POST')) 
        {
            $form->bind($request);

            if ($form->isValid()) 
            {
                $em = $this->getDoctrine()->getManager();
                $em->persist($course);
                $em->flush();

                //$log = new Log();
                // .. some code goes here

                // After save, redirect viewer back to users list
                return $this->redirect($this->generateUrl('slumlords_admin_courses'));;
            }
        }

        return $this->render('SlumlordsBundle:Admin:course_add.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function courseEditAction($id, Request $request) 
    {

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

    }

    public function userEditAction($id, Request $request) 
    {
        $user = $this->getDoctrine()
            ->getRepository('SlumlordsBundle:User')
            ->find($id);

        // Prep the form for display
        $form = $this->createFormBuilder($user)
            ->add('username', 'text')
            ->add('firstName', 'text')
            ->add('lastName', 'text')
            ->add('email', 'text')
            ->add('wage', 'text')
            ->add('roleList', 'choice', array(
                'choices'   => array(
                    'ROLE_SUPER_ADMIN'   => 'ROLE_SUPER_ADMIN',
                    'ROLE_INSTRUCTOR' => 'ROLE_INSTRUCTOR',
                    'ROLE_STUDENT' => 'ROLE_STUDENT',
                ),
                'property_path' => false,
                'multiple'  => true,
            ))
            ->add('courses', 'collection', array(
                'type' => 'text',
                'options' => array (
                    'allow_add' => true,
                    'required' => false
                ),
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

                foreach ($roles as $key => $value)
                {
                    $user->addRole($value);
                }

                // Save changes to the database
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                // After save, redirect viewer back to users list
                return $this->redirect($this->generateUrl('slumlords_admin_users'));;
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