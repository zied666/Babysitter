<?php

namespace Back\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BabySitterType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $array=array(0=>0,1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>10,11=>11,12=>12,13=>13,14=>14,15=>15,16=>16,17=>17,18=>18,19=>19,20=>20);
        $builder
            ->add('address')
            ->add('phoneNumber')
            ->add('shortDescription')
            ->add('birthday','birthday')
            ->add('gender','choice',array(
                'choices'=>array(
                    'Masculine'=>'Masculine',
                    'Feminine'=>'Feminine',
                ),
                'expanded'=>true,
                'required'=>true,
            ))
            ->add('languages','choice',array(
                'choices'=>array(
                    'English'=>'English',
                    'French'=>'French',
                    'Deutsh'=>'Deutsh',
                    'Spanish'=>'Spanish',
                    'Arabic'=>'Arabic',
                    'Chinese'=>'Chinese',
                    'Japanese'=>'Japanese',
                    'Others'=>'Others',
                ),
                'multiple'=>true,
                'required'=>true,
            ))
            ->add('yearsExperiance','choice',array(
                'choices'=>$array,
                'required'=>true,
            ))
            ->add('kidsAbleCarry','choice',array(
                'choices'=>$array,
                'required'=>true,
            ))
            ->add('pets')
            ->add('smoker')
            ->add('alcoholic')
            ->add('provideSickCare')
            ->add('specialNeeds')
            ->add('homeWorkHelp')
            ->add('education')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Back\UserBundle\Entity\BabySitter'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'back_userbundle_babysitter';
    }
}
