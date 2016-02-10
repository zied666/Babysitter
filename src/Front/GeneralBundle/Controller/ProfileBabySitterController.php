<?php

namespace Front\GeneralBundle\Controller;

use Back\UserBundle\Entity\BabySitter;
use Back\UserBundle\Entity\Booking;
use Back\UserBundle\Entity\Calendrier;
use Back\UserBundle\Form\BabySitterType;
use Back\UserBundle\Form\CalendrierType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ProfileBabySitterController extends Controller
{
    public function profileAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $user = $this->getUser();
        if(!is_null($user->getBabySitter()))
            $babysitter=$user->getBabySitter();
        else
        {
            $babysitter=new BabySitter();
            $babysitter->setLastName($user->getLastName())->setFirstName($user->getFirstName())->setEmail($user->getEmail());
        }
        $form=$this->createForm(new BabySitterType(),$babysitter);
        if($request->isMethod('POST'))
        {
            $form->submit($request);
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

    public function calendarAction($id,Request $request)
    {
        $em=$this->get('doctrine.orm.entity_manager');
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

    public function listBookingAction($page)
    {
        $em=$this->get('doctrine.orm.entity_manager');
        $user=$this->getUser();
        $booking=$em->getRepository('BackUserBundle:Booking')->findBy(array('babysitter'=>$user->getBabysitter()),array('id'=>'desc'));
        $bookings = $this->get('knp_paginator')->paginate($booking,$page,20);
        return $this->render('FrontGeneralBundle:ProfileBabySitter:listBooking.html.twig',array(
            'bookings'=>$bookings
        ));
    }

    public function validateAction(Booking $booking)
    {
        $em=$this->get('doctrine.orm.entity_manager');
        if($booking->getUser()->getId()==$this->getUser()->getId())
        {
            $booking->setStatus(3);
            $em->persist($booking);
            $em->flush();
            $this->get('mailerservice')->sendBookingValidated($booking);
            $this->addFlash('success','success');
        }
        return $this->redirectToRoute('Front_BabySitter_Profile_listBooking');
    }

    public function cancelAction(Booking $booking)
    {
        $em=$this->get('doctrine.orm.entity_manager');
        if($booking->getUser()->getId()==$this->getUser()->getId())
        {
            $booking->setStatus(4);
            $em->persist($booking);
            $em->flush();
            $this->get('mailerservice')->sendBookingCanceled($booking);
            $this->addFlash('success','success');
        }
        return $this->redirectToRoute('Front_BabySitter_Profile_listBooking');
    }

}
