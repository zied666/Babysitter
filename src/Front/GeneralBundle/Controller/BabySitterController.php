<?php

namespace Front\GeneralBundle\Controller;

use Back\UserBundle\Entity\Booking;
use Back\UserBundle\Entity\Calendrier;
use Back\UserBundle\Form\BookingType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class BabySitterController extends Controller
{
    public function listeAction($page, $country, $city, $gender, $languages, $smoker, $specialNeeds, $provideSickCare, $pets, $homeWorkHelp, $motCle)
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        if ($request->isMethod('POST')) return $this->redirect($this->generateUrl('front_babysitter_liste', array('country' => $request->get('countrySearch'), 'city' => $request->get('citySearch'), 'gender' => $request->get('genderSearch'), 'languages' => $request->get('languagesSearch'), 'smoker' => $request->get('smokerSearch'), 'specialNeeds' => $request->get('specialNeedsSearch'), 'provideSickCare' => $request->get('provideSickCareSearch'), 'pets' => $request->get('petsSearch'), 'homeWorkHelp' => $request->get('homeWorkHelpSearch'), 'motCle' => urlencode($request->get('motCleSearch')),)));
        $babysitters = $em->getRepository('BackUserBundle:Babysitter')->filtre($country, $city, $gender, $languages, $smoker, $specialNeeds, $provideSickCare, $pets, $homeWorkHelp, $motCle);
        $babysitters = $this->get('knp_paginator')->paginate($babysitters, $page, 15);
        return $this->render('FrontGeneralBundle:BabySitter/liste:liste.html.twig', array('babysitters' => $babysitters));
    }

    public function babysiterAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $babysitter = $em->getRepository('BackUserBundle:BabySitter')->findOneBySlug($slug);
        return $this->render('FrontGeneralBundle:BabySitter/Profile:profile.html.twig', array('babysitter' => $babysitter, 'age' => $babysitter->getBirthday()->diff(new \DateTime())->y));
    }

    public function ajaxCountryToCityAction()
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $cities = $em->getRepository('BackUserBundle:BabySitter')->getCities($this->get('request')->get('country'));
        $array = array();
        $response = new JsonResponse();
        $array[]='All';
        foreach ($cities as $city)
            $array[] = $city['city'];
        $response->setData($array);
        return $response;
    }

    public function calendarAction($slug){
        $em = $this->get('doctrine.orm.entity_manager');
        $babysitter = $em->getRepository('BackUserBundle:BabySitter')->findOneBySlug($slug);
        $calendar= $em->getRepository('BackUserBundle:Calendrier')->findOneBy(array(
            'month'=>date('m'),
            'year'=>date('Y'),
            'babysitter'=>$babysitter
        ));
        if(!$calendar)
        {
            $calendar = new Calendrier($babysitter,date('Y'),date('m'));
            $em->persist($calendar);
            $em->flush();
        }
        return $this->render('FrontGeneralBundle:BabySitter:calendar.html.twig', array(
            'calendar'=>$calendar,
            'babysitter' => $babysitter,
            'age' => $babysitter->getBirthday()->diff(new \DateTime())->y
        ));
    }

    public function bookingAction($slug,$month,$year,$day,Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $babysitter = $em->getRepository('BackUserBundle:BabySitter')->findOneBySlug($slug);
        $calendar= $em->getRepository('BackUserBundle:Calendrier')->findOneBy(array(
            'month'=>$month,
            'year'=>$year,
            'babysitter'=>$babysitter
        ));
        if(!$calendar or is_null($calendar->getPriceByDay($day)))
        {
            $this->addFlash('Info','This date is not available');
            return $this->redirectToRoute('front_babysitter_calendar',array('slug'=>$slug));
        }
        $booking= new Booking();
        $booking->setUser($this->getUser())
            ->setBabysitter($babysitter)
            ->setDateBooking(\DateTime::createFromFormat('Ymd', $year.$month.$day));
        $form=$this->createForm(new BookingType(),$booking);
        if($request->isMethod('POST'))
        {
            $form->handleRequest($request);
            if($form->isValid())
            {
                $booking=$form->getData();
                $booking->setTotal($calendar->getPriceByDay($day)*$booking->getNumberHour());
                $em->persist($booking);
                $em->flush();
                return $this->redirectToRoute('front_babysitter_sendToPaipal',array('id'=>$booking->getId()));
            }
        }
        return $this->render('FrontGeneralBundle:BabySitter:booking.html.twig', array(
            'calendar'=>$calendar,
            'babysitter' => $babysitter,
            'age' => $babysitter->getBirthday()->diff(new \DateTime())->y,
            'bookingDate'=>\DateTime::createFromFormat('Ymd', $year.$month.$day),
            'form'=>$form->createView()
        ));

    }

    public function sendToPaipalAction(Booking $booking)
    {
        $em=$this->get('doctrine.orm.entity_manager');
        return $this->render("FrontGeneralBundle:BabySitter:sendToPaipal.html.twig",array(
            'booking'=>$booking,
            'paypal'=>$em->getRepository('BackUserBundle:Paypal')->findOneBy(array())
        ));
    }

    public function paypalNotifyAction()
    {
        $em=$this->get('doctrine.orm.entity_manager');
        $paypal = $em->getRepository('BackUserBundle:Paypal')->findOneBy(array());
        $email_account = $paypal->getAccount();
        $req = 'cmd=_notify-validate';

        foreach ($_POST as $key => $value) {
            $value = urlencode(stripslashes($value));
            $req .= "&$key=$value";
        }

        $header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
        if ($paypal->getTestMode()) $header .= "Host: www.sandbox.paypal.com\r\n"; else
            $header .= "Host: www.paypal.com\r\n";
        $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
        $header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
        if ($paypal->getTestMode()) $fp = fsockopen('ssl://www.sandbox.paypal.com', 443, $errno, $errstr, 30); else
            $fp = fsockopen('ssl://www.paypal.com', 443, $errno, $errstr, 30);
        $item_name = $_POST['item_name'];
        $item_number = $_POST['item_number'];
        $payment_status = $_POST['payment_status'];
        $payment_amount = $_POST['mc_gross'];
        $payment_currency = $_POST['mc_currency'];
        $txn_id = $_POST['txn_id'];
        $receiver_email = $_POST['receiver_email'];
        $payer_email = $_POST['payer_email'];
        parse_str($_POST['custom'], $custom);
        file_put_contents('log', print_r($_POST, true));
        $booking = $em->find("BackUserBundle:Booking",$custom['id']);
        if (!$fp) {

        } else {
            fputs($fp, $header . $req);
            while (!feof($fp)) {
                $res = fgets($fp, 1024);
                if (strcmp($res, "VERIFIED") == 0) {
                    if ($payment_status == "Completed" || ($paypal->getTestMode() && $payment_status == 'Pending')) {
                        if ($email_account == $receiver_email) {
                            if ($payment_amount == $booking->getTotal() && $payment_currency == 'USD') {
                                $booking->setDateTrasaction(new \DateTime());
                                $booking->setIdTransaction($_POST['txn_id']);
                                $booking->setStatus(2);
                                $booking->setPaypalData($_POST);
                                $em->persist($booking);
                                $em->flush();
                            } else {

                            }
                        }
                    } else {

                    }
                    exit();
                } else if (strcmp($res, "INVALID") == 0) {

                }
            }
            fclose($fp);
        }
    }
}
