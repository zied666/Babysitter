<?php

namespace Front\GeneralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function homePageAction()
    {
        $em=$this->getDoctrine()->getManager();
        $lastBabySitters=$em->getRepository('BackUserBundle:BabySitter')->last4BabySitter();
        return $this->render('FrontGeneralBundle:HomePage:homepage.html.twig',array(
            'lastBabySitters'=>$lastBabySitters
        ));
    }
}
