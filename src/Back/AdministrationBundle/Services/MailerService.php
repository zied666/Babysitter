<?php

namespace Back\AdministrationBundle\Services;

use Back\UserBundle\Entity\Booking;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\DependencyInjection\Container;

class MailerService
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

    public function sendBookingPaid(Booking $booking)
    {
        //to customer
        $message = \Swift_Message::newInstance()
            ->setSubject('Baby-Siitter' )
            ->setFrom("zied.kharraz@gmail.com","Baby-Sitter")
            ->setTo($booking->getUser()->getEmail(),$booking->getName())
            ->setCc("zied.kharraz@gmail.com","Zied Kharraz");
        $message->setContentType("text/html");
        $message->setCharset("utf-8");
        $message->setBody($this->templating->render('BackAdministrationBundle:mails:bookingPaidUser.html.twig', array(
            'booking' => $booking,
        )));
        $this->mailer->send($message);

        //to Babysitter
        $message = \Swift_Message::newInstance()
            ->setSubject('Baby-Siitter' )
            ->setFrom("zied.kharraz@gmail.com","Baby-Sitter")
            ->setTo($booking->getBabysitter()->getUser()->getEmail(),$booking->getBabysitter()->getFirstName())
            ->setCc("zied.kharraz@gmail.com","Zied Kharraz");
        $message->setContentType("text/html");
        $message->setCharset("utf-8");
        $message->setBody($this->templating->render('BackAdministrationBundle:mails:bookingPaidBabysitter.html.twig', array(
            'booking' => $booking,
        )));
        $this->mailer->send($message);
    }

    public function sendBookingValidated(Booking $booking)
    {
        //to customer
        $message = \Swift_Message::newInstance()
            ->setSubject('Baby-Siitter' )
            ->setFrom("zied.kharraz@gmail.com","Baby-Sitter")
            ->setTo($booking->getUser()->getEmail(),$booking->getName())
            ->setCc("zied.kharraz@gmail.com","Zied Kharraz");
        $message->setContentType("text/html");
        $message->setCharset("utf-8");
        $message->setBody($this->templating->render('BackAdministrationBundle:mails:bookingValidatedUser.html.twig', array(
            'booking' => $booking,
        )));
        $this->mailer->send($message);

        //to Babysitter
        $message = \Swift_Message::newInstance()
            ->setSubject('Baby-Siitter' )
            ->setFrom("zied.kharraz@gmail.com","Baby-Sitter")
            ->setTo($booking->getBabysitter()->getUser()->getEmail(),$booking->getBabysitter()->getFirstName())
            ->setCc("zied.kharraz@gmail.com","Zied Kharraz");
        $message->setContentType("text/html");
        $message->setCharset("utf-8");
        $message->setBody($this->templating->render('BackAdministrationBundle:mails:bookingValidatedBabysitter.html.twig', array(
            'booking' => $booking,
        )));
        $this->mailer->send($message);
    }

    public function sendBookingCanceled(Booking $booking)
    {
        //to customer
        $message = \Swift_Message::newInstance()
            ->setSubject('Baby-Siitter' )
            ->setFrom("zied.kharraz@gmail.com","Baby-Sitter")
            ->setTo($booking->getUser()->getEmail(),$booking->getName())
            ->setCc("zied.kharraz@gmail.com","Zied Kharraz");
        $message->setContentType("text/html");
        $message->setCharset("utf-8");
        $message->setBody($this->templating->render('BackAdministrationBundle:mails:bookingCanceledUser.html.twig', array(
            'booking' => $booking,
        )));
        $this->mailer->send($message);

        //to Babysitter
        $message = \Swift_Message::newInstance()
            ->setSubject('Baby-Siitter' )
            ->setFrom("zied.kharraz@gmail.com","Baby-Sitter")
            ->setTo($booking->getBabysitter()->getUser()->getEmail(),$booking->getBabysitter()->getFirstName())
            ->setCc("zied.kharraz@gmail.com","Zied Kharraz");
        $message->setContentType("text/html");
        $message->setCharset("utf-8");
        $message->setBody($this->templating->render('BackAdministrationBundle:mails:bookingCanceledBabysitter.html.twig', array(
            'booking' => $booking,
        )));
        $this->mailer->send($message);
    }

}
