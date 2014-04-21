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

    function __construct(EntityManager $em, $session, $service_container) {

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

    public function getCurrencySymbol() {

        return 'Tk.';
    }

    public function getCarts() {

        $session = $this->container->get('session');
        $session_cart = $session->get('carts');
        if (!$session_cart) {
            $arr = array();
            $session->set('carts', $arr);
        }

        return $session_cart;
    }

    public function getCartItems() {
        $carts = $this->getCarts();
        $var = array();
        if (count($carts) > 0) {
            foreach ($carts as $c) {
                $var[] = $this->em->getRepository('ZeteqMarketBundle:Cart')->findOneById($c);
            }
        }
        return $var;
    }
    
    public function getCartItemCount(){
        $carts = $this->getCartItems();
        $sum = 0;
        foreach ($carts as $cart) {
            $sum += count($cart->getCartItems());            
        }
        return $sum ;
    } 

    public function getCart($store_slug) {


        $session = $this->container->get('session');


        $session_cart = $session->get('carts');
        if (!$session_cart) {
            $arr = array();
            $session->set('carts', $arr);
        }

        if (isset($session_cart[$store_slug])) {
            $store_cart_id = $session_cart[$store_slug];
        } else {
            $store = $this->em->getRepository('ZeteqMarketBundle:Store')->findOneBySlug($store_slug);
            $c = New Cart();
//            throw new \Symfony\Component\Security\Acl\Exception\Exception($store_slug);
            $c->setStore($store);

            $this->em->persist($c);
            $this->em->flush();
            $session_cart[$store_slug] = $c->getId();
            $session->set('carts', $session_cart);
            $store_cart_id = $c->getId();
        }
        $cart = $this->em->getRepository('ZeteqMarketBundle:Cart')->findOneById($store_cart_id);
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

    public function getParentCategories() {
        try {

            $query = $this->em->createQuery('SELECT a from ZeteqMarketBundle:ProductCategory a WHERE a.is_parent=true AND a.enabled=1 ')

            ;
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

    public function getHomeImage($id) {
        try {

            $query = $this->em->createQuery('SELECT a from ZeteqFrontBundle:HomeImage a where a.enabled =1 and a.id = ?1');
            $query->setParameter(1, $id);
            $as = $query->getResult();
        } catch (\Doctrine\Orm\NoResultException $e) {
            $as = false;
        }

        return $as;
    }

    public function getHomeSlideImage() {
        try {

            $query = $this->em->createQuery('SELECT a from ZeteqFrontBundle:HomeSlideImage a where a.enabled =1 order by a.sort DESC');
            $as = $query->getResult();
        } catch (\Doctrine\Orm\NoResultException $e) {
            $as = false;
        }

        return $as;
    }

}
