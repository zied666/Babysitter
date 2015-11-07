<?php

namespace Back\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ParentController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }
}
