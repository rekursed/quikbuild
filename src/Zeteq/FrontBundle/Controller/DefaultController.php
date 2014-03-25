<?php

namespace Zeteq\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ZeteqFrontBundle:Default:index.html.twig', array('name' => $name));
    }
}
