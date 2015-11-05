<?php

namespace Front\GeneralBundle\Controller;

use Back\UserBundle\Entity\BabySitter;
use Back\UserBundle\Form\BabySitterType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProfileBabySitterController extends Controller
{
    public function profileAction()
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        $user = $this->container->get('security.context')->getToken()->getUser();
        if(!is_null($user->getBabySitter()))
            $babysitter=$user->getBabySitter();
        else
        {
            $babysitter=new BabySitter();
            $babysitter->setLastName($user->getLastName())->setFirstName($user->getFirstName());
        }
        $form=$this->createForm(new BabySitterType(),$babysitter);
        if($this->getRequest()->isMethod('POST'))
        {
            $form->submit($this->getRequest());
            if($form->isValid())
            {
                $babysitter=$form->getData();
                $em->persist($babysitter);
                $em->persist($user->setBabySitter($babysitter));
                $em->flush();
                return $this->redirect($this->generateUrl('Front_BabySitter_Profile_myprofile'));
            }
        }
        return $this->render('FrontGeneralBundle:ProfileBabySitter:MyProfile.html.twig',array(
            'form'=>$form->createView(),
            'babysitter'=>$babysitter
        ));
    }
}
