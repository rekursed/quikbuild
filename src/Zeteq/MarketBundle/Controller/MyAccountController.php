<?php

namespace Zeteq\MarketBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Zeteq\MarketBundle\Entity\Store;
use Zeteq\UserBundle\Entity\User;
use Zeteq\UserBundle\Entity\Role;
use Zeteq\UserBundle\Form\RegisterUserType;
use Zeteq\MarketBundle\Entity\Customer;
use Zeteq\MarketBundle\Entity\Cart;
use Zeteq\MarketBundle\Entity\CartItem;
use Zeteq\MarketBundle\Form\StoreType;
use Zeteq\MarketBundle\Form\CustomerShippingAddressType;
use Zeteq\MarketBundle\Form\CustomerBillingAddressType;
use Zeteq\MarketBundle\Entity\Product;
use \Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\SecurityContext;

class MyAccountController extends Controller {

    public function register_loginAction(Request $request) {

        $entity = new User();
        $form = $this->createForm(new RegisterUserType(), $entity);
        $request = $this->getRequest();
        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                    SecurityContext::AUTHENTICATION_ERROR
            );
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }       


        return $this->render('ZeteqMarketBundle:MyAccount:register_login.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
                    'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                    'error' => $error,
                        )
        );
    }

    public function purchase_indexAction(Request $request) {

        $user = $this->get('security.context')->getToken()->getUser();

        $wl = $user->getSales();


        return $this->render('ZeteqMarketBundle:MyAccount:purchase_index.html.twig'
                        , array('user' => $user, 'purchases' => $wl)
        );
    }

    /**
     * Deletes a FavoriteStore entity.
     *
     */
    public function favorite_store_deleteAction(Request $request, $id) {

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('ZeteqMarketBundle:FavoriteStore')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FavoriteStore entity.');
        }

        $em->remove($entity);
        $em->flush();


        return new JsonResponse(array('val' => $entity->getStore() . ' has been removed to your favorites'));
    }

    /**
     * Deletes a FavoriteItem entity.
     *
     */
    public function favorite_item_deleteAction(Request $request, $id) {

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('ZeteqMarketBundle:FavoriteItem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Favorite Item entity.');
        }

        $em->remove($entity);
        $em->flush();


        return new JsonResponse(array('val' => $entity->getProduct() . ' has been removed to your favorites'));
    }

    public function view_favorite_storeAction(Request $request) {

        $user = $this->get('security.context')->getToken()->getUser();

        $wl = $user->getFavoriteStores();


        return $this->render('ZeteqMarketBundle:MyAccount:favorite_store_index.html.twig'
                        , array('user' => $user, 'fav' => $wl)
        );
    }

    public function view_favorite_itemAction(Request $request) {

        $user = $this->get('security.context')->getToken()->getUser();

        $wl = $user->getFavoriteItems();


        return $this->render('ZeteqMarketBundle:MyAccount:favorite_item_index.html.twig'
                        , array('user' => $user, 'fav' => $wl)
        );
    }

    public function add_to_favorite_storeAction($slug) {
        $user = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $store = $em->getRepository('ZeteqMarketBundle:Store')->findOneBySlug($slug);

        $ws = new \Zeteq\MarketBundle\Entity\FavoriteStore();
        $ws->setStore($store);
        $ws->setUser($user);

        $em->persist($ws);
        $em->flush();

        $val = 1;
        return new JsonResponse(array('val' => $store . ' has been added to your favorite store'));
//
//        return $this->render('ZeteqFrontBundle:Market:product_show.html.twig', array(
//                    'entity' => $product,
//        ));
    }

    public function add_to_favorite_itemAction($slug) {
        $user = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('ZeteqMarketBundle:Product')->findOneBySlug($slug);

        $ws = new \Zeteq\MarketBundle\Entity\FavoriteItem();
        $ws->setProduct($product);
        $ws->setUser($user);

        $em->persist($ws);
        $em->flush();

        $val = 1;
        return new JsonResponse(array('val' => $product->getName() . ' has been added to your favorite product'));
//
//        return $this->render('ZeteqFrontBundle:Market:product_show.html.twig', array(
//                    'entity' => $product,
//        ));
    }

    public function indexAction(Request $request) {

        $user = $this->get('security.context')->getToken()->getUser();
        $customer = $user->getCustomer();

        return $this->render('ZeteqMarketBundle:MyAccount:index.html.twig'
                        , array('user' => $user, 'customer' => $customer)
        );
    }

    public function edit_settingsAction() {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.context')->getToken()->getUser();
        $entity = $em->getRepository('ZeteqMarketBundle:Customer')->findOneByUser($user->getId());

        if (!$entity) {
            $entity = new Customer();
            $entity->setUser($user);
            $em->persist($entity);
            $em->flush();
//            throw $this->createNotFoundException('Unable to find Customer entity.');
        }

        $editForm = $this->createForm(new \Zeteq\MarketBundle\Form\CustomerSettingsType(), $entity, array(
            'action' => $this->generateUrl('myaccount_update_settings', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        return $this->render('ZeteqMarketBundle:MyAccount:edit_settings.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Edits an existing Customer entity.
     *
     */
    public function update_settingsAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $user = $this->get('security.context')->getToken()->getUser();
        $entity = $em->getRepository('ZeteqMarketBundle:Customer')->findOneByUser($user->getId());

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Customer entity.');
        }


        $editForm = $this->createForm(new \Zeteq\MarketBundle\Form\CustomerSettingsType(), $entity, array(
            'action' => $this->generateUrl('myaccount_update_settings', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('myaccount_edit_settings'));
        }

        return $this->render('ZeteqMarketBundle:MyAccount:edit_settings.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
        ));
    }

    public function edit_shipping_addressAction() {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.context')->getToken()->getUser();
        $entity = $em->getRepository('ZeteqMarketBundle:Customer')->findOneByUser($user->getId());

        if (!$entity) {
            $entity = new Customer();
            $entity->setUser($user);
            $em->persist($entity);
            $em->flush();
//            throw $this->createNotFoundException('Unable to find Customer entity.');
        }

        $editForm = $this->createForm(new CustomerShippingAddressType(), $entity, array(
            'action' => $this->generateUrl('myaccount_update_shipping_address', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));


        return $this->render('ZeteqMarketBundle:MyAccount:edit_shipping_address.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
        ));
    }

    public function edit_billing_addressAction() {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.context')->getToken()->getUser();
        $entity = $em->getRepository('ZeteqMarketBundle:Customer')->findOneByUser($user->getId());

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Customer entity.');
        }

        $editForm = $this->createEdit_billing_addressForm($entity);


        return $this->render('ZeteqMarketBundle:MyAccount:edit_billing_address.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Customer entity.
     *
     * @param Customer $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEdit_shipping_addressForm(Customer $entity) {
        $form = $this->createForm(new CustomerShippingAddressType(), $entity, array(
            'action' => $this->generateUrl('myaccount_update_shipping_address', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    private function createEdit_billing_addressForm(Customer $entity) {
        $form = $this->createForm(new CustomerBillingAddressType(), $entity, array(
            'action' => $this->generateUrl('myaccount_update_billing_address', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Customer entity.
     *
     */
    public function update_shipping_addressAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $user = $this->get('security.context')->getToken()->getUser();
        $entity = $em->getRepository('ZeteqMarketBundle:Customer')->findOneByUser($user->getId());

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Customer entity.');
        }


        $editForm = $this->createEdit_shipping_addressForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('myaccount_edit_shipping_address'));
        }

        return $this->render('ZeteqMarketBundle:MyAccount:edit_shipping_address.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
        ));
    }

    public function update_billing_addressAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $user = $this->get('security.context')->getToken()->getUser();
        $entity = $em->getRepository('ZeteqMarketBundle:Customer')->findOneByUser($user->getId());

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Customer entity.');
        }


        $editForm = $this->createEdit_billing_addressForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('myaccount_edit_billing_address'));
        }

        return $this->render('ZeteqMarketBundle:MyAccount:edit_billing_address.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
        ));
    }

    public function registerAction(Request $request) {

        $entity = new User();
        $form = $this->createForm(new RegisterUserType(), $entity);



        return $this->render('ZeteqMarketBundle:MyAccount:register.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
                        )
        );
    }

    public function registersaveAction(Request $request) {

        $entity = new User();
        $form = $this->createForm(new RegisterUserType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {


            $factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($entity);
            $password = $encoder->encodePassword($entity->getPassword(), $entity->getSalt());
            $entity->setPassword($password);
            $em = $this->getDoctrine()->getManager();
            $group = $em->getRepository('ZeteqUserBundle:Role')->findOneByRole('ROLE_CUSTOMER');
            $entity->addRole($group);
            $rand_string = $this->randString(15);
            $entity->setActivationCode($rand_string);
            $entity->setIsActive(false);
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();


            //send email
            $web = $this->container->getParameter('web');
            $email = $this->container->getParameter('email');
            $email_name = $this->container->getParameter('email_name');
            $site_name = $this->container->getParameter('site_name');
            $message = \Swift_Message::newInstance()
                    ->setSubject('Registration Successful ')
                    ->setFrom(array($email => $email_name))
                    ->setTo($entity->getEmail())
                    ->setBody(
                    $this->renderView(
                            'ZeteqMarketBundle:MyAccount:register_success_email.html.twig', array('site_name' => $site_name, 'web' => $web, 'user' => $entity)
                    ), 'text/html'
                    )
            ;
            $this->get('mailer')->send($message);
            //end send email

            return $this->redirect($this->generateUrl('myaccount_register_success', array('id' => $entity->getId())));
        }

        $template = "register";
        return $this->render('ZeteqMarketBundle:MyAccount:register.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),));
    }

    public function register_successAction(Request $request) {


        return $this->render(
                        'ZeteqMarketBundle:MyAccount:register_success.html.twig'
        );
    }

    public function activate_userAction($rand_string) {

        $em = $this->getDoctrine()->getManager();

        $dql = "SELECT a FROM ZeteqUserBundle:User a WHERE a.activation_code=:rand_string";

        $query = $em->createQuery($dql);
        $query->setParameter('rand_string', $rand_string);
        $entity = $query->getOneOrNullResult();



        $entity->setIsActive(true);
        $entity->setActivationCode($this->randString(25));


        $em->persist($entity);
        $em->flush();

        $customer = new Customer();
        $customer->setUser($entity);
        $em->persist($customer);
        $em->flush();

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Page entity.');
        }


        return $this->render('ZeteqMarketBundle:MyAccount:activate_user.html.twig', array(
                    'user' => $entity,
        ));
    }

    function randString($length, $charset = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789') {
        $str = '';
        $count = strlen($charset);
        while ($length--) {
            $str .= $charset[mt_rand(0, $count - 1)];
        }
        return $str;
    }

    public function forgot_passwordAction(Request $request) {

        return $this->render('ZeteqUserBundle:User:forgot_password.html.twig');
    }

    public function reset_passwordAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('ZeteqUserBundle:User')->findOneByEmail($request->request->get('email'));

        if ($user) {
            $rand_string = $this->randString(15);
            $user->setActivationCode($rand_string);
            $em->persist($user);
            $em->flush();


            //send email

            $message = \Swift_Message::newInstance()
                    ->setSubject('Reset Password ')
                    //      ->setFrom($this->get('siteinfo')->getSite()->getEmail())
                    ->setFrom(array('halalneeds@gmail.com' => 'John Doe'))
                    ->setTo($user->getEmail())
                    ->setBody(
                    $this->renderView(
                            'ZeteqUserBundle:User:reset_password_email.html.twig', array('user' => $user, 'rand_string' => $rand_string, 'ip' => $this->container->get('request')->getClientIp())
                    ), 'text/html'
                    )
            ;
            $this->get('mailer')->send($message);
            //end send email




            $template = "reset_password";
            return $this->render('ZeteqUserBundle:User:reset_password.html.twig'
            );
        } else {
            $error = 1;


            return $this->redirect($this->generateUrl('forgot_password', array('error' => $error)));
        }
    }

    public function reset_password_linkAction(Request $request, $tmp) {



        $em = $this->getDoctrine()->getManager();
        $dql = "SELECT a FROM ZeteqUserBundle:User a WHERE a.activation_code=:rand_string";

        $query = $em->createQuery($dql);
        $query->setParameter('rand_string', $tmp);
        $entity = $query->getOneOrNullResult();

        if ($entity) {

            $defaultData = array('message' => 'Type your message here');
            $form = $this->createFormBuilder($defaultData)
                    ->add('password', 'repeated', array(
                        'invalid_message' => 'The password fields must match.',
                        'required' => true,
                        'first_options' => array('label' => 'Password'),
                        'second_options' => array('label' => 'Repeat Password'),
                    ))
                    ->getForm();


            if ($request->isMethod('POST')) {
                $form->bind($request);


                if ($form->isValid()) {

                    $data = $form->getData();






                    $factory = $this->get('security.encoder_factory');
                    $encoder = $factory->getEncoder($entity);
                    $password = $encoder->encodePassword($data['password'], $entity->getSalt());
                    $entity->setPassword($password);

                    $rand_string = $this->randString(15);
                    $entity->setActivationCode($rand_string);

                    $em = $this->getDoctrine()->getManager();
                    $em->persist($entity);
                    $em->flush();


                    return $this->render('ZeteqUserBundle:User:reset_password_link_successful.html.twig', array('tmp' => $tmp, 'form' => $form->createView())
                    );
                }
            }







            $template = "reset_password_link";
            return $this->render('ZeteqUserBundle:User:reset_password_link.html.twig', array('tmp' => $tmp, 'form' => $form->createView())
            );
        } else {





            return $this->render('ZeteqUserBundle:User:reset_password_link_not_found.html.twig'
            );
        }
    }

}
