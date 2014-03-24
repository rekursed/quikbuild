<?php

namespace Zeteq\MarketBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Zeteq\MarketBundle\Entity\Product;
use Zeteq\MarketBundle\Entity\Store;
use Zeteq\MarketBundle\Entity\Cart;
use Zeteq\MarketBundle\Entity\Page;
use Symfony\Component\HttpFoundation\Session\Session;

class MarketController extends Controller
{
    
    
        /**
     * Finds and displays a StoreCategory entity.
     *
     */
    public function show_storecategoryAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZeteqMarketBundle:StoreCategory')->findOneBySlug($slug);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find StoreCategory entity.');
        }

 

        return $this->render('ZeteqMarketBundle:Market:show_storecategory.html.twig', array(
            'entity'      => $entity,
                 ));
    }
    
    
        public function show_storeproductcategoryAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZeteqMarketBundle:StoreProductCategory')->findOneBySlug($slug);
      $is_admin= false;
          $user = $this->get('security.context')->getToken()->getUser();
          if($entity->getStore()->getUser() == $user)
          {
              $is_admin = true;
          }
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find StoreProductCategory entity.');
        }



        return $this->render('ZeteqMarketBundle:Market:show_storeproductcategory.html.twig', array(
            'entity'      => $entity,
             'store'   => $entity->getStore(),   
                'is_admin'   => $is_admin,
            ));
    }
    
    
    
        public function show_productcategoryAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

      $entity = $em->getRepository('ZeteqMarketBundle:ProductCategory')->findOneBySlug($slug);
     
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductCategory entity.');
        }

            $repository = $em->getRepository('ZeteqMarketBundle:Product');
           
            $query = $repository->createQueryBuilder('p')
           ->innerJoin('p.categories', 's', 'WITH', 's.id = :sid')
                    ->where('p.enabled=1')
                    ->andWhere('p.approved=1')
            ->setParameter('sid', $entity->getId())

                    ->getQuery();

        
        
        $products = $query->getResult();
        

       

        return $this->render('ZeteqMarketBundle:Market:show_productcategory.html.twig', array(
            'entity'      => $entity,
            'products'     => $products,
            
               ));
    }
    
    
    
    
    
    
    
    // this is the homepage
    
    
        public function indexAction(Request $request)
    {
          
    $em = $this->getDoctrine()->getManager();


        return $this->render('ZeteqMarketBundle:Market:index.html.twig');
    }
    
    
    
    
    
    
        public function show_storesectionAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZeteqMarketBundle:StoreSection')->findOneBySlug($slug);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find StoreSection entity.');
        }
 

        return $this->render('ZeteqMarketBundle:Market:show_storesection.html.twig', array(
            'entity'      => $entity,
                   ));
    }

    public function show_pageAction($slug,$store_slug)
    {
        $em = $this->getDoctrine()->getManager();
        $store = $em->getRepository('ZeteqMarketBundle:Store')->findOneBySlug($store_slug);
        $entity = $em->getRepository('ZeteqMarketBundle:Page')->findOneBySlug($slug);
      $is_admin= false;
          $user = $this->get('security.context')->getToken()->getUser();
          if($entity->getStore()->getUser() == $user)
          {
              $is_admin = true;
          }
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Store entity.');
        }


        return $this->render('ZeteqMarketBundle:Market:show_page.html.twig', array(
            'page'      => $entity,
            'store'    => $store,
                'is_admin'   => $is_admin,
                   ));
    }
    
    
    public function show_storeAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZeteqMarketBundle:Store')->findOneBySlug($slug);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Store entity.');
        }
        
        $is_admin= false;
          $user = $this->get('security.context')->getToken()->getUser();
          if($entity->getUser() == $user)
          {
              $is_admin = true;
          }


        return $this->render('ZeteqMarketBundle:Market:show_store.html.twig', array(
            'store'      => $entity,
            'is_admin'   => $is_admin,
                   ));
    }
    
    
     public function show_productAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZeteqMarketBundle:Product')->findOneBySlug($slug);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }

        
              $is_admin= false;
          $user = $this->get('security.context')->getToken()->getUser();
          if($entity->getStore()->getUser() == $user)
          {
              $is_admin = true;
          }


        return $this->render('ZeteqMarketBundle:Market:show_product.html.twig', array(
            'product'      => $entity,
            'store'   => $entity->getStore(),
                'is_admin'   => $is_admin,
        ));
    }


}
