<?php

namespace Back\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstName');
        $builder->add('lastName');


        $builder->add('roles','collection',array(
            'type'=>'choice',
            'options'=>array(
                'choices'=>array(
                    "ROLE_PARRENT"=>'Parrent',
                    "ROLE_BABYSITTER"=>'Baby Sitter',
                ),
                'label'=>'profile',
                'expanded'=>true,
                'required'=>true,
            ),
        ));
    }

    public function getParent()
    {
        return 'fos_user_registration';
    }

    public function getName()
    {
        return 'app_user_registration';
    }
}