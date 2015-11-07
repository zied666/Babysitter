<?php

namespace Back\AdministrationBundle\Controller;

use Back\UserBundle\Form\AdminType;
use Back\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdministrationController extends Controller
{
    public function adminsAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        if (is_null($id))
            $user = new User();
        else
            $user = $em->find('BackUserBundle:User', $id);
        $users=$em->getRepository('BackUserBundle:User')->findByRole(array('ROLE_ADMIN','ROLE_SUPER_ADMIN'));
        if (!is_null($id))
            $form = $this->createForm(New AdminType(), $user, array('validation_groups' => array('Profile')))->remove('plainPassword');
        else
            $form = $this->createForm(New AdminType(), $user, array('validation_groups' => array('Registration')));
        $request = $this->getRequest();
        if ($request->isMethod('POST')) {
            $form->submit($request);
            if ($form->isValid()) {
                $user = $form->getData();
                $em->persist($user->setEnabled(true)->addRole('ROLE_ADMIN'));
                $em->flush();
                $session->getFlashBag()->add('success', "Your administrator has been added successfully");
                return $this->redirect($this->generateUrl('back_administration_admins'));
            }
        }
        return $this->render('BackAdministrationBundle:administration:admins.html.twig', array(
            'form' => $form->createView(),
            'users' => $users
        ));
    }

    public function adminsEnableAction(User $user)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        if($user->isEnabled())
            $user->setEnabled(false);
        else
            $user->setEnabled(true);
        $em->flush();
        $session->getFlashBag()->add('success', "Your administrator has been changed successfully");
        return $this->redirect($this->generateUrl('back_administration_admins'));
    }
}
