<?php

namespace Zeteq\MarketBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


use Symfony\Component\HttpFoundation\Request;
use Zeteq\MarketBundle\Entity\Store;
use Zeteq\MarketBundle\Form\StoreType;



class AdminController extends Controller
{

    public function adminAction()
    {
        
  $user = $this->get('security.context')->getToken()->getUser();
        return $this->render('ZeteqMarketBundle:Admin:admin.html.twig',array('user'=>$user));
        
    }

        public function store_adminAction()
    {
        return $this->render('ZeteqMarketBundle:Admin:store_admin.html.twig');
    }
    
     public function stores_for_userAction()
    {
           $user = $this->get('security.context')->getToken()->getUser();
                 $em = $this->getDoctrine()->getManager();

        
$query = $em->createQuery('SELECT a from ZeteqMarketBundle:Store a WHERE a.user= :user');
$query->setParameter('user',$user);

        $entities = $query->getResult();


        return $this->render('ZeteqMarketBundle:Admin:stores_for_user.html.twig', array(
            'entities' => $entities,
        ));

    }
    
    
    }
