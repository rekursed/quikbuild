<?php

namespace Zeteq\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ZeteqUserBundle:Default:index.html.twig', array('name' => $name));
    }
}
