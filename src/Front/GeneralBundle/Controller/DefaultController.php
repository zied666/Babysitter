<?php

namespace Front\GeneralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function homePageAction()
    {
        return $this->render('FrontGeneralBundle:HomePage:homepage.html.twig');
    }
}
