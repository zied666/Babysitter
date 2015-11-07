<?php

namespace Back\UserBundle\Controller;

use FOS\UserBundle\Model\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BabySitterController extends Controller
{
    public function listeAction($page)
    {
        $em=$this->getDoctrine()->getManager();
        $session = $this->get('session');
        $users=$em->getRepository('BackUserBundle:User')->findByRole(array('ROLE_BABYSITTER'));
        $users = $this->get('knp_paginator')->paginate($users,$page,20);
        return $this->render('BackUserBundle:BabySitter:liste.html.twig', array('users' => $users));
    }

    public function detailsAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->get('session');
        $user=$em->find('BackUserBundle:User',$id);
        if(is_null($user->getBabySitter()))
            $session->getFlashBag()->add('info', "Profile not filled");
        return $this->render('BackUserBundle:BabySitter/details:details.html.twig', array('user' => $user));
    }

    public function enableAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->get('session');
        $user=$em->find('BackUserBundle:User',$id);
        if($user->isEnabled())
            $user->setEnabled(false);
        else
            $user->setEnabled(true);
        $em->flush();
        $session->getFlashBag()->add('success', "Your BabuSitter has been changed successfully");
        return $this->redirect($this->generateUrl('back_user_babysiter_listes'));
    }
}
