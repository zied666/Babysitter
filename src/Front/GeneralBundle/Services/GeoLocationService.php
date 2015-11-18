<?php

namespace Front\GeneralBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\DependencyInjection\Container;

class GeoLocationService
{

    protected $em;
    protected $session;
    protected $container;
    protected $mailer;
    protected $templating;

    public function __construct(EntityManager $em, Session $session, Container $container, \Swift_Mailer $mailer, $templating)
    {
        $this->em = $em;
        $this->session = $session;
        $this->container = $container;
        $this->mailer = $mailer;
        $this->templating = $templating;
    }

    public function getLongitude($address)
    {
        $address=urlencode($address);
        $url = "http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        curl_close($ch);
        $response_a = json_decode($response);
        return $response_a->results[0]->geometry->location->lng;
    }

    public function getLatitude($address)
    {
        $address=urlencode($address);
        $url = "http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        curl_close($ch);
        $response_a = json_decode($response);
        return $response_a->results[0]->geometry->location->lat;
    }

    public function getCountry($address)
    {
        $address=urlencode($address);
        $url = "http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        curl_close($ch);
        $response_a = json_decode($response);
        foreach($response_a->results[0]->address_components as $component)
        {
            if (in_array("country", $component->types))
                return $component->long_name;
        }
        return " ";
    }

    public function getCity($address)
    {
        $address=urlencode($address);
        $url = "http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        curl_close($ch);
        $response_a = json_decode($response);
        foreach($response_a->results[0]->address_components as $component)
        {
            if (in_array("locality", $component->types))
                return $component->long_name;
        }
        return " ";
    }
}
