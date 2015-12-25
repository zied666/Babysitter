<?php

namespace Front\GeneralBundle\Controller;

use Back\UserBundle\Entity\BabySitter;
use Back\UserBundle\Entity\Calendrier;
use Back\UserBundle\Form\BabySitterType;
use Back\UserBundle\Form\CalendrierType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

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
            $babysitter->setLastName($user->getLastName())->setFirstName($user->getFirstName())->setEmail($user->getEmail());
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

    public function ajaxToAddressAction()
    {
        $response = new JsonResponse();
        $response->setData(array(
            $this->get('geolocation')->getCity($this->getRequest()->get('address')),
            $this->get('geolocation')->getCountry($this->getRequest()->get('address')),
            $this->get('geolocation')->getLongitude($this->getRequest()->get('address')),
            $this->get('geolocation')->getLatitude($this->getRequest()->get('address'))

        ));
        return $response;
    }

    public function calendarAction($id)
    {
        $em=$this->get('doctrine.orm.entity_manager');
        $session=$this->get('session');
        $request=$this->get('request');
        $user=$this->getUser();
        if(!is_null($id))
            $calendrier=$em->find('BackUserBundle:Calendrier',$id);
        else
            $calendrier=new Calendrier();
        $calendriers=$em->getRepository('BackUserBundle:Calendrier')->findBy(array('babysitter'=>$user->getBabysitter()),array('year'=>"desc",'month'=>"desc"));
        $form=$this->createForm(new CalendrierType(),$calendrier);
        if($request->isMethod('POST'))
        {
            $form->handleRequest($request);
            if($form->isValid())
            {
                $calendrier=$form->getData();
                $verif=$em->getRepository('BackUserBundle:Calendrier')->findOneBy(array(
                    'month'=>$calendrier->getMonth(),
                    'year'=>$calendrier->getYear(),
                ));
                if($verif and is_null($id))
                {
                    $this->addFlash("danger","You have already entered this date");
                    return $this->redirectToRoute("Front_BabySitter_Profile_mycalendar");
                }
                $em->persist($calendrier->setBabysitter($user->getBabysitter()));
                $em->flush();
                $this->addFlash("success","success");
                return $this->redirectToRoute("Front_BabySitter_Profile_mycalendar");
            }
        }
        return $this->render('FrontGeneralBundle:ProfileBabySitter:MyCalendar.html.twig',array(
            'form'=>$form->createView(),
            'calendars'=>$calendriers
        ));
    }
}
