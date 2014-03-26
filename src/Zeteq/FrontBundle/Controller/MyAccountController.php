<?php

namespace Zeteq\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Zeteq\UserBundle\Entity\User;
use Zeteq\UserBundle\Entity\Role;
use Zeteq\UserBundle\Form\RegisterUserType;
use Zeteq\MarketBundle\Entity\Customer;
use Zeteq\MarketBundle\Entity\Cart;
use Zeteq\MarketBundle\Entity\CartItem;
use Zeteq\MarketBundle\Form\CustomerShippingAddressType;
use Zeteq\MarketBundle\Form\CustomerBillingAddressType;
use Zeteq\MarketBundle\Entity\Product;
use Symfony\Component\HttpFoundation\JsonResponse;

class MyAccountController extends Controller {

    public function view_orderAction($id) {

        $user = $this->get('security.context')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();

        $sale = $em->getRepository('ZeteqMarketBundle:Sale')->find($id);

        if (!$sale) {
            throw $this->createNotFoundException('Unable to find Sale entity.');
        }


        return $this->render('ZeteqFrontBundle:MyAccount:show_orderinfo.html.twig', array(
                    'sale' => $sale,
        ));
    }

    public function view_salelistAction(Request $request) {

        $user = $this->get('security.context')->getToken()->getUser();

        $sales = $user->getSales();


        return $this->render('ZeteqFrontBundle:MyAccount:sale_index.html.twig'
                        , array('user' => $user, 'sales' => $sales)
        );
    }

    

    public function indexAction(Request $request) {

        $user = $this->get('security.context')->getToken()->getUser();
        $customer = $user->getCustomer();

        return $this->render('ZeteqFrontBundle:MyAccount:index.html.twig'
                        , array('user' => $user, 'customer' => $customer)
        );
    }

    public function edit_shipping_addressAction() {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.context')->getToken()->getUser();
        $entity = $em->getRepository('ZeteqMarketBundle:Customer')->findOneByUser($user->getId());

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Customer entity.');
        }

        $editForm = $this->createEdit_shipping_addressForm($entity);


        return $this->render('ZeteqFrontBundle:MyAccount:edit_shipping_address.html.twig', array(
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


        return $this->render('ZeteqFrontBundle:MyAccount:edit_billing_address.html.twig', array(
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

        return $this->render('ZeteqFrontBundle:MyAccount:edit_shipping_address.html.twig', array(
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

        return $this->render('ZeteqFrontBundle:MyAccount:edit_billing_address.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
        ));
    }

    public function registerAction(Request $request) {

        $entity = new User();
        $form = $this->createForm(new RegisterUserType(), $entity);



        return $this->render('ZeteqFrontBundle:MyAccount:register.html.twig', array(
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
            $email = $this->get('service')->getSite()->getEmail();
            $email_name = $this->get('service')->getSite()->getEmailName();
            $site_name = $this->get('service')->getSite()->getName();
            $web = $this->get('service')->getSite()->getUrl();



            $message = \Swift_Message::newInstance()
                    ->setSubject('Registration Successful ')
                    ->setFrom(array($email => $email_name))
                    ->setTo($entity->getEmail())
                    ->setBody(
                    $this->renderView(
                            'ZeteqFrontBundle:MyAccount:register_success_email.html.twig', array('site_name' => $site_name, 'web' => $web, 'user' => $entity)
                    ), 'text/html'
                    )
            ;
            $this->get('mailer')->send($message);
            //end send email

            return $this->redirect($this->generateUrl('myaccount_register_success', array('id' => $entity->getId())));
        }

        $template = "register";
        return $this->render('ZeteqFrontBundle:MyAccount:register.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
                        )
        );
    }

    public function register_successAction(Request $request) {

        $site_name = $this->get('service')->getSite()->getName();
        return $this->render(
                        'ZeteqFrontBundle:MyAccount:register_success.html.twig', array(
                    'site_name' => $site_name,
                        )
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


        return $this->render('ZeteqFrontBundle:MyAccount:activate_user.html.twig', array(
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
                    ->setFrom(array('ecommerce@gmail.com' => 'Mr Admin'))
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
