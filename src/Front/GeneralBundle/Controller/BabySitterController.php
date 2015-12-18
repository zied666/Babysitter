<?php

namespace Front\GeneralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

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
        $em = $this->getDoctrine()->getManager();
        $babysitter = $em->getRepository('BackUserBundle:BabySitter')->findOneBySlug($slug);
        return $this->render('FrontGeneralBundle:BabySitter:calendar.html.twig', array('babysitter' => $babysitter, 'age' => $babysitter->getBirthday()->diff(new \DateTime())->y));
    }
}
