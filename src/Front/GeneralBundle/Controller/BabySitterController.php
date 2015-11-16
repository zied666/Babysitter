<?php

namespace Front\GeneralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BabySitterController extends Controller
{
    public function listeAction($page)
    {
        $em=$this->getDoctrine()->getManager();
        $session = $this->get('session');
        $babysitters=$em->getRepository('BackUserBundle:Babysitter')->findAll();
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
