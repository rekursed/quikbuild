<?php

namespace Zeteq\MarketBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Zeteq\MarketBundle\Entity\Store;
use Zeteq\MarketBundle\Entity\Cart;
use Zeteq\MarketBundle\Entity\CartItem;
use Zeteq\MarketBundle\Entity\Sale;
use Zeteq\MarketBundle\Entity\SaleItem;
use Zeteq\MarketBundle\Form\StoreType;
use Zeteq\MarketBundle\Entity\Product;
use Zeteq\MarketBundle\Form\CartAddressType;

class CartController extends Controller {

    public function pop_indexAction() {
        $em = $this->getDoctrine()->getManager();
        $carts = $this->get('service')->getCarts();
        $mycarts = array();
        if (count($carts)>0) {
            foreach ($carts as $cart) {
                $mycarts[] = $em->getRepository('ZeteqMarketBundle:Cart')->findOneById($cart);
            }
        }
        return $this->render('ZeteqMarketBundle:Cart:pop_index.html.twig', array('mycarts' => $mycarts));
    }

    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $carts = $this->get('service')->getCarts();
        $mycarts = array();
        foreach ($carts as $cart) {
            $mycarts[] = $em->getRepository('ZeteqMarketBundle:Cart')->findOneById($cart);
        }
        return $this->render('ZeteqMarketBundle:Cart:index.html.twig', array('mycarts' => $mycarts));
    }

    public function checkoutAction($store_slug) {

        $em = $this->getDoctrine()->getManager();
        $cart = $this->get('service')->getCart($store_slug);
        $form = $this->create_cart_addressForm($cart);


        return $this->render('ZeteqMarketBundle:Cart:checkout.html.twig', array('cart' => $cart, 'form' => $form->createView()));
    }

    private function create_cart_addressForm(Cart $entity) {
        $form = $this->createForm(new CartAddressType(), $entity, array(
            'action' => $this->generateUrl('cart_checkout_update'),
            'method' => 'PUT',
        ));

        // $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    public function checkout_updateAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $store_slug = $request->request->get('store');
        $entity = $this->get('service')->getCart($store_slug);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Customer entity.');
        }


        $form = $this->create_cart_addressForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('cart_preview', array('store' => $store_slug)));
        }
        return $this->render('ZeteqMarketBundle:Cart:checkout.html.twig', array('cart' => $entity, 'form' => $form->createView()));
    }

    public function add_itemAction($product_slug, $store_slug, Request $request) {
        $quantity = $request->request->get('quantity', 1);
        $em = $this->getDoctrine()->getManager();
        $cart = $this->get('service')->getCart($store_slug);

        $product = $em->getRepository('ZeteqMarketBundle:Product')->findOneBySlug($product_slug);



        $q = $em->createQuery('SELECT a from ZeteqMarketBundle:CartItem a WHERE a.product= :product AND a.cart=:cart ');
        $q->setParameter('product', $product);
        $q->setParameter('cart', $cart);
        $cart_item = $q->getOneOrNullResult();

        if (!$cart_item) {
            $cart_item = new CartItem();
            $cart_item->setProduct($product);
            $cart_item->setCart($cart);
            $cart_item->setQuantity($quantity);
            $em->persist($cart_item);
            $em->flush();
        } else {
            $cart_item->setQuantity($quantity + $cart_item->getQuantity());
            $em->persist($cart_item);
            $em->flush();
        }



        $carts = $this->get('service')->getCarts();
        $mycarts = array();
        foreach ($carts as $cart) {
            $mycarts[] = $em->getRepository('ZeteqMarketBundle:Cart')->findOneById($cart);
        }

        return new \Symfony\Component\HttpFoundation\JsonResponse(array('val' => $product . ' is Added to you cart'));
//        return $this->render('ZeteqMarketBundle:Cart:index.html.twig', array('mycarts' => $mycarts, 'cart' => $cart));
    }

    public function update_quantityAction(Request $request) {
        $quantity = $request->request->get('quantity');
        $id = $request->request->get('id');

        $em = $this->getDoctrine()->getManager();




        $q = $em->createQuery('SELECT a from ZeteqMarketBundle:CartItem a WHERE a.id = :id ');
        $q->setParameter('id', $id);

        $cart_item = $q->getOneOrNullResult();
        $cart_item->setQuantity($quantity);
        $em->persist($cart_item);
        $em->flush();
        return $this->redirect($this->generateUrl('cart_index'));
    }

    public function remove_itemAction(Request $request, $id) {



        $em = $this->getDoctrine()->getManager();


        $q = $em->createQuery('SELECT a from ZeteqMarketBundle:CartItem a WHERE a.id = :id ');
        $q->setParameter('id', $id);

        $cart_item = $q->getOneOrNullResult();

        $em->remove($cart_item);
        $em->flush();
        return $this->redirect($this->generateUrl('cart_index'));
    }

    public function previewAction(Request $request, $store) {

        $em = $this->getDoctrine()->getManager();

        $cart_s = $this->get('service')->getCart($store);
        $cart = $em->getRepository('ZeteqMarketBundle:Cart')->findOneById($cart_s->getId());
        return $this->render('ZeteqMarketBundle:Cart:preview.html.twig', array('cart' => $cart));
    }

    public function clearAction(Request $request, $store) {
        $em = $this->getDoctrine()->getManager();
        $cart = $this->get('service')->getCart($store);

        foreach ($cart->getCartItems() as $ci) {

            $em->remove($ci);
            $em->flush();
        }
        return $this->redirect($this->generateUrl('cart_index'));
    }

    public function confirmAction(Request $request, $store) {

        $em = $this->getDoctrine()->getManager();

        $cart = $this->get('service')->getCart($store);

        $st = $em->getRepository('ZeteqMarketBundle:Store')->findOneBySlug($store);


        $sale = new Sale();

        $sale->setStore($st);

        $user = $this->get('security.context')->getToken()->getUser();
        $sale->setUser($user);

        $sale->setOrderNumber(strtotime('now'));

        $sale->setBillingFirstName($cart->getBillingFirstName());
        $sale->setBillingLastName($cart->getBillingLastName());
        $sale->setBillingAddress($cart->getBillingAddress());
        $sale->setBillingCity($cart->getBillingCity());
        $sale->setBillingState($cart->getBillingState());
        $sale->setBillingCountry($cart->getBillingCountry());
        $sale->setBillingPostalcode($cart->getBillingPostalcode());
        $sale->setBillingEmail($cart->getBillingEmail());
        $sale->setBillingPhone($cart->getBillingPhone());


        $sale->setShippingFirstName($cart->getShippingFirstName());
        $sale->setShippingLastName($cart->getShippingLastName());
        $sale->setShippingAddress($cart->getShippingAddress());
        $sale->setShippingCity($cart->getShippingCity());
        $sale->setShippingState($cart->getShippingState());
        $sale->setShippingCountry($cart->getShippingCountry());
        $sale->setShippingPostalcode($cart->getShippingPostalcode());
        $sale->setShippingEmail($cart->getShippingEmail());
        $sale->setShippingPhone($cart->getShippingPhone());


        $sale->setShippingCost($cart->getShippingCost());
        $sale->setShippingMethod($cart->getShippingMethod()->getName());
        $sale->setPaymentMethod($cart->getPaymentMethod()->getName());
        $sale->setTotal($cart->getTotal());

        $em->persist($sale);
        $em->flush();

        foreach ($cart->getCartItems() as $ci) {

            $si = new SaleItem();
            $si->setSale($sale);
            $si->setProductName($ci->getProduct()->getName());
            $si->setPrice($ci->getProduct()->getPrice());
            $si->setQuantity($ci->getQuantity());
            $em->persist($si);
            $em->remove($ci);
            $em->flush();
            $sale->addSaleItem($si);
        }

        $email = $this->container->getParameter('email');
        $email_name = $this->container->getParameter('email_name');
        $site_name = $this->container->getParameter('site_name');
        $message = \Swift_Message::newInstance()
                ->setSubject('Order Confirmation ')
                ->setFrom(array($email => $email_name))
                ->setTo($sale->getBillingEmail())
                ->setBody(
                $this->renderView(
                        'ZeteqMarketBundle:Cart:confirmation_email.html.twig', array('sale' => $sale)
                ), 'text/html'
                )
        ;




        $this->get('mailer')->send($message);

        return $this->render('ZeteqMarketBundle:Cart:confirm.html.twig', array(
                    'sale' => $sale,
        ));
    }

    public function order_detailsAction($sale) {
        $em = $this->getDoctrine()->getManager();

        $sale = $em->getRepository('ZeteqMarketBundle:Sale')->findOneById($sale);
        return $this->render('ZeteqMarketBundle:Cart:order_details.html.twig', array(
                    'sale' => $sale,
        ));
    }

}
