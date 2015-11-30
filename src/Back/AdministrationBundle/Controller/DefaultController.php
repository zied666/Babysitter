<?php

namespace Back\AdministrationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em=$this->get('doctrine.orm.entity_manager');
        $countBabysitter=count($users=$em->getRepository('BackUserBundle:User')->findBabySitter());
        $countAdmin=$em->getRepository('BackUserBundle:User')->countByRole(array('ROLE_ADMIN'));
        $countParent=$em->getRepository('BackUserBundle:User')->countByRole(array('ROLE_PARRENT'));
        return $this->render('BackAdministrationBundle:Default:index.html.twig',array(
            'countAdmin'=>$countAdmin,
            'countBabysitter'=>$countBabysitter,
            'countParent'=>$countParent,
        ));
    }
}
