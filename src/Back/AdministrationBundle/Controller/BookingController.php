<?php

namespace Back\AdministrationBundle\Controller;

use Back\AdministrationBundle\Form\FiltreListType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class BookingController extends Controller
{
    public function listAction($page, $status, Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $form = $this->createForm(new FiltreListType($status));
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $data = $form->getData();
                return $this->redirectToRoute('back_booking_list', array('status' => $data['status']));
            }
        }
        $bookings = $em->getRepository('BackUserBundle:Booking')->filtre($status);
        $bookings = $this->get('knp_paginator')->paginate($bookings, $page, 20);
        return $this->render('BackAdministrationBundle:booking:list.html.twig', array(
            'bookings' => $bookings,
            'form'     => $form->createView()
        ));
    }

    public function ajaxPaypalAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $id=$request->get("id");
        $tab=array();
        $response=new JsonResponse();
        $booking=$em->find("BackUserBundle:Booking",$id);
        $tab['data']=$booking->getPaypalData();
        $response->setData($tab);
        return $response;
    }
}
