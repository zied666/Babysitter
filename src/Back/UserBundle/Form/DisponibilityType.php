<?php

namespace Back\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DisponibilityType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lundi1','checkbox',array(
                'required'=>false,
                'label'=>" ",
            ))
            ->add('lundi2','checkbox',array(
                'required'=>false,
                'label'=>" ",
            ))
            ->add('lundi3','checkbox',array(
                'required'=>false,
                'label'=>" ",
            ))
            ->add('lundi4','checkbox',array(
                'required'=>false,
                'label'=>" ",
            ))
            ->add('mardi1','checkbox',array(
                'required'=>false,
                'label'=>" ",
            ))
            ->add('mardi2','checkbox',array(
                'required'=>false,
                'label'=>" ",
            ))
            ->add('mardi3','checkbox',array(
                'required'=>false,
                'label'=>" ",
            ))
            ->add('mardi4','checkbox',array(
                'required'=>false,
                'label'=>" ",
            ))
            ->add('mercredi1','checkbox',array(
                'required'=>false,
                'label'=>" ",
            ))
            ->add('mercredi2','checkbox',array(
                'required'=>false,
                'label'=>" ",
            ))
            ->add('mercredi3','checkbox',array(
                'required'=>false,
                'label'=>" ",
            ))
            ->add('mercredi4','checkbox',array(
                'required'=>false,
                'label'=>" ",
            ))
            ->add('jeudi1','checkbox',array(
                'required'=>false,
                'label'=>" ",
            ))
            ->add('jeudi2','checkbox',array(
                'required'=>false,
                'label'=>" ",
            ))
            ->add('jeudi3','checkbox',array(
                'required'=>false,
                'label'=>" ",
            ))
            ->add('jeudi4','checkbox',array(
                'required'=>false,
                'label'=>" ",
            ))
            ->add('vendredi1','checkbox',array(
                'required'=>false,
                'label'=>" ",
            ))
            ->add('vendredi2','checkbox',array(
                'required'=>false,
                'label'=>" ",
            ))
            ->add('vendredi3','checkbox',array(
                'required'=>false,
                'label'=>" ",
            ))
            ->add('vendredi4','checkbox',array(
                'required'=>false,
                'label'=>" ",
            ))
            ->add('samedi1','checkbox',array(
                'required'=>false,
                'label'=>" ",
            ))
            ->add('samedi2','checkbox',array(
                'required'=>false,
                'label'=>" ",
            ))
            ->add('samedi3','checkbox',array(
                'required'=>false,
                'label'=>" ",
            ))
            ->add('samedi4','checkbox',array(
                'required'=>false,
                'label'=>" ",
            ))
            ->add('dimanche1','checkbox',array(
                'required'=>false,
                'label'=>" ",
            ))
            ->add('dimanche2','checkbox',array(
                'required'=>false,
                'label'=>" ",
            ))
            ->add('dimanche3','checkbox',array(
                'required'=>false,
                'label'=>" ",
            ))
            ->add('dimanche4','checkbox',array(
                'required'=>false,
                'label'=>" ",
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Back\UserBundle\Entity\Disponibility'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'back_userbundle_disponibility';
    }
}
