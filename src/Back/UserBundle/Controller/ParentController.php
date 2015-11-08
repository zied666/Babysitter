<?php

namespace Back\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ParentController extends Controller
{
    public function listeAction($page)
    {
        $em=$this->getDoctrine()->getManager();
        $session = $this->get('session');
        $users=$em->getRepository('BackUserBundle:User')->findByRole(array('ROLE_PARRENT'));
        $users = $this->get('knp_paginator')->paginate($users,$page,20);
        return $this->render('BackUserBundle:Parent:liste.html.twig', array('users' => $users));
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
        $session->getFlashBag()->add('success', "Your Parent has been changed successfully");
        return $this->redirect($this->generateUrl('back_user_parent_listes'));
    }
}
