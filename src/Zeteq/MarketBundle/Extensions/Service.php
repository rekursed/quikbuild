<?php

namespace Zeteq\MarketBundle\Extensions;

use Doctrine\ORM\EntityManager;
use Zeteq\MarketBundle\Entity\Cart;
use Zeteq\UserBundle\Entity\User;
use Zeteq\MarketBundle\Entity\ProductSection;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\DependencyInjection\Container;

class Service {

    protected $em;
    private $session;
    private $container;
    function __construct(EntityManager $em,$session,$service_container) 
    {

        $this->em = $em;
        $this->session = $session;
        $this->container = $service_container;
    }
    
        public function getSlot($id) {
//        try {
//
//            $query = $this->em->createQuery('SELECT a from ZeteqPageBundle:Slot a where a.id=:id ')
//                    ->setParameter('id',$id);
//            $as = $query->getSingleResult();
//        } catch (\Doctrine\Orm\NoResultException $e) {
//            $as = false;
//        }

        return 'ZeteqMarketBundle:Slots:' . $id . '.html.twig';
    }
    
    public function getCurrencySymbol()
    {
        
        return 'Tk.';
    }
    
    public function getCart()
    {


$session = $this->container->get('session');

        
        $cid = $session->get('cart_id');
        if(!$cid){
            $c = New Cart();
            $this->em->persist($c);
            $this->em->flush();
            $session->set('cart_id',$c->getId());
            $cid = $session->get('cart_id');
        }
        $cart = $this->em->getRepository('ZeteqMarketBundle:Cart')->findOneById($cid);
        return $cart;
        
    }
    
     public function getFeaturedStores() {
        try {

            $query = $this->em->createQuery('SELECT a from ZeteqMarketBundle:Store a where a.featured =1 and a.enabled=1 and a.approved=1 ');
            $as = $query->getResult();
        } catch (\Doctrine\Orm\NoResultException $e) {
            $as = false;
        }

        return $as;
    }

    public function getEnabledProductSections() {
        try {

            $query = $this->em->createQuery('SELECT a from ZeteqMarketBundle:ProductSection a ');
            $as = $query->getResult();
        } catch (\Doctrine\Orm\NoResultException $e) {
            $as = false;
        }

        return $as;
    }
    
    public function getEnabledStoreSections() {
        try {

            $query = $this->em->createQuery('SELECT a from ZeteqMarketBundle:StoreSection a ');
            $as = $query->getResult();
        } catch (\Doctrine\Orm\NoResultException $e) {
            $as = false;
        }

        return $as;
    }
    
    
    public function getEnabledProducts() {
        try {

            $query = $this->em->createQuery('SELECT a from ZeteqMarketBundle:Product a where a.enabled =1 and a.approved=1 order by a.created ');
            $as = $query->getResult();
        } catch (\Doctrine\Orm\NoResultException $e) {
            $as = false;
        }

        return $as;
    }
}