<?php

namespace Front\GeneralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BabySitterController extends Controller
{
    public function listeAction($page,$country,$city,$gender,$languages,$smoker,$specialNeeds,$provideSickCare,$pets,$homeWorkHelp,$motCle)
    {
        $em=$this->getDoctrine()->getManager();
        $babysitters=$em->getRepository('BackUserBundle:Babysitter')->filtre($country,$city,$gender,$languages,$smoker,$specialNeeds,$provideSickCare,$pets,$homeWorkHelp,$motCle);
        $babysitters = $this->get('knp_paginator')->paginate($babysitters,$page,15);
        return $this->render('FrontGeneralBundle:BabySitter/liste:liste.html.twig', array('babysitters' => $babysitters));
    }

    public function babysiterAction($slug)
    {
        $em=$this->getDoctrine()->getManager();
        $babysitter=$em->getRepository('BackUserBundle:BabySitter')->findOneBySlug($slug);
        return $this->render('FrontGeneralBundle:BabySitter/Profile:profile.html.twig', array('babysitter' => $babysitter));
    }
}
