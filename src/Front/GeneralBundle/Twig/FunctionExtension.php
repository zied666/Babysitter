<?php
namespace Front\GeneralBundle\Twig;
use Doctrine\ORM\EntityManager;


class FunctionExtension extends \Twig_Extension
{
    protected $em;
    public function __construct(EntityManager $em)
    {
        $this->em=$em;
    }
    public function getFunctions()
    {
        return array(
            'getCountries'=>new \Twig_Function_Method($this, 'getCountries'),
            'getCities'=>new \Twig_Function_Method($this, 'getCities'),
            'getNameMonth'=>new \Twig_Function_Method($this, 'getNameMonth'),
        );
    }

    public function getNameMonth($monthNum)
    {
        $dateObj   = \DateTime::createFromFormat('!m', $monthNum);
        return $dateObj->format('F');
    }

    public function getCountries()
    {
        return $this->em->getRepository("BackUserBundle:BabySitter")->getCountries();
    }

    public function getCities($country='all')
    {
        return $this->em->getRepository("BackUserBundle:BabySitter")->getCities($country);
    }

    public function getName()
    {
        return 'FunctionExtension';
    }
}