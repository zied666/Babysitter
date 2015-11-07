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
        $km=array();for($i=1;$i<=1000;$i++)$km[$i]=$i;
        $religions=array( 'Christianity'=>'Christianity', 'Islam'=>'Islam', 'Judaism'=>'Judaism', 'Atheist'=>'Atheist', 'Hinduism'=>'Hinduism', 'Chinese traditional religion'=>'Chinese traditional religion', 'Buddhism'=>'Buddhism', 'African traditional religions'=>'African traditional religions', 'Other'=>'Other');
        $array=array(0=>0,1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>10,11=>11,12=>12,13=>13,14=>14,15=>15,16=>16,17=>17,18=>18,19=>19,20=>20);
        $builder
            ->add('firstName')
            ->add('lastName')
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
            ->add('religion','choice',array(
                'choices'=>$religions,
                'required'=>true,
                'empty_value'   => 'List of Relgion',
                'empty_data'    => null
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
                'expanded'=>true,
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
            ->add('education')
            ->add('pets','checkbox',array(
                'label'=>'Comfortable with pets  ',
                'required'=>false
            ))
            ->add('smoker','checkbox',array(
                'label'=>'Smoker',
                'required'=>false
            ))
            ->add('alcoholic','checkbox',array(
                'label'=>'Alcoholic',
                'required'=>false
            ))
            ->add('provideSickCare','checkbox',array(
                'label'=>'Provide sick care ',
                'required'=>false
            ))
            ->add('specialNeeds','checkbox',array(
                'label'=>'Special needs',
                'required'=>false
            ))
            ->add('homeWorkHelp','checkbox',array(
                'label'=>'Homework help',
                'required'=>false
            ))
            ->add('file')
            ->add('city')
            ->add('near')
            ->add('howManyKM','choice',array(
                'choices'=>$km,
                'required'=>false,
            ))
            ->add('facebook')
            ->add('googlePlus')
            ->add('linkedIn')
            ->add('twitter')
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
