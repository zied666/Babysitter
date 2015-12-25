<?php

namespace Back\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CalendrierType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('year',"choice",array(
                'choices'=>array(
                    date('Y')=>date('Y')
                )
            ))
            ->add('month','choice',array(
                'choices'=>array(
                    1=>"January",
                    2=>"February",
                    3=>"March",
                    4=>"April",
                    5=>"May",
                    6=>"June",
                    7=>"July",
                    8=>"August",
                    9=>"September",
                    10=>"October",
                    11=>"November",
                    12=>"December",
                )
            ))
            ->add('day1')
            ->add('day2')
            ->add('day3')
            ->add('day4')
            ->add('day5')
            ->add('day6')
            ->add('day7')
            ->add('day8')
            ->add('day9')
            ->add('day10')
            ->add('day11')
            ->add('day12')
            ->add('day13')
            ->add('day14')
            ->add('day15')
            ->add('day16')
            ->add('day17')
            ->add('day18')
            ->add('day19')
            ->add('day20')
            ->add('day21')
            ->add('day22')
            ->add('day23')
            ->add('day24')
            ->add('day25')
            ->add('day26')
            ->add('day27')
            ->add('day28')
            ->add('day29')
            ->add('day30')
            ->add('day31')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Back\UserBundle\Entity\Calendrier'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'back_userbundle_calendrier';
    }
}
