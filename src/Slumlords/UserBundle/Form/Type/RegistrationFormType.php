<?php

namespace Slumlords\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        // add your custom field
        $builder->setAttribute('formLabel', false);
        $builder->add('firstName');
        $builder->add('lastName');
    }

    public function getName()
    {
        return 'slumlords_user_registration';
    }
}