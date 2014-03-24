<?php

namespace Zeteq\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Zeteq\UserBundle\Entity\User;
use Zeteq\UserBundle\Form\UserType;
use Zeteq\UserBundle\Form\RegisterUserType;
use Zeteq\UserBundle\Form\UserChangePasswordType;
use APY\DataGridBundle\Grid\Source\Entity;
use APY\DataGridBundle\Grid\Export\ExcelExport;
use APY\DataGridBundle\Grid\Action\RowAction;
use APY\DataGridBundle\Grid\Action\MassAction;
use APY\DataGridBundle\Grid\Action\DeleteMassAction;

/**
 * User controller.
 *
 */
class UserController extends Controller {

    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $source = new Entity('ZeteqUserBundle:User');
        $grid = $this->get('grid');
        $grid->setSource($source);
        $grid->setLimits(array(10, 25, 50, 100, 1000));
        $title = "excel";
        $fileName = "users.xls";
        $grid->addExport(new ExcelExport($title, $fileName));


        $rowActionDelete = new RowAction('delete', 'user_delete', true);
        $rowAction = new RowAction('edit', 'user_edit');
        $row_cp_Action = new RowAction('change_password', 'user_change_password');


        $grid->addRowAction($row_cp_Action);
        $grid->addRowAction($rowAction);
        $grid->addRowAction($rowActionDelete);

        $callback = 'ZeteqUserBundle\UserController::delete';
        $grid->addMassAction(new DeleteMassAction());
        $grid->hideColumns(array(
            'password', 'activation_code', 'username', 'salt'));





        $grid->isReadyForRedirect();


        return $grid->getGridResponse('ZeteqUserBundle:User:indexapy.html.twig');
    }

    /**
     * Lists all User entities.
     *
     */
    public function index1Action() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ZeteqUserBundle:User')->findAll();

        return $this->render('ZeteqUserBundle:User:index.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**
     * Creates a new User entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new User();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($entity);
            $password = $encoder->encodePassword($entity->getPassword(), $entity->getSalt());
            $entity->setPassword($password);


            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('user_edit', array('id' => $entity->getId())));
        }

        return $this->render('ZeteqUserBundle:User:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a User entity.
     *
     * @param User $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(User $entity) {
        $form = $this->createForm(new UserType(), $entity, array(
            'action' => $this->generateUrl('user_create'),
            'method' => 'POST',
        ));



        return $form;
    }

    /**
     * Displays a form to create a new User entity.
     *
     */
    public function newAction() {
        $entity = new User();
        $form = $this->createCreateForm($entity);

        return $this->render('ZeteqUserBundle:User:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a User entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZeteqUserBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ZeteqUserBundle:User:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),));
    }

    /**
     * Displays a form to edit an existing User entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZeteqUserBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ZeteqUserBundle:User:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a User entity.
     *
     * @param User $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(User $entity) {
        $form = $this->createForm(new UserType(), $entity, array(
            'action' => $this->generateUrl('user_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));



        return $form;
    }

    /**
     * Edits an existing User entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZeteqUserBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {


//            $factory = $this->get('security.encoder_factory');
//            $encoder = $factory->getEncoder($entity);
//            $password = $encoder->encodePassword($entity->getPassword(), $entity->getSalt());
//            $entity->setPassword($password);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('user_edit', array('id' => $id)));
        }

        return $this->render('ZeteqUserBundle:User:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a User entity.
     *
     */
    public function deleteAction(Request $request, $id) {

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('ZeteqUserBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $em->remove($entity);
        $em->flush();


        return $this->redirect($this->generateUrl('user'));
    }

    /**
     * Creates a form to delete a User entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('user_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm()
        ;
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

        return $this->render('ZeteqUserBundle:User:forgot_password.html.twig'
        );
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
                    ->setFrom(array($this->container->getParameter('email') => $this->container->getParameter('email_name')))
                    ->setTo($user->getEmail())
                    ->setBody(
                    $this->renderView(
                            'ZeteqUserBundle:User:reset_password_email.html.twig', array('user' => $user, 'web' => $this->container->getParameter('web'), 'rand_string' => $rand_string, 'ip' => $this->container->get('request')->getClientIp())
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
                        'type' => 'password',
                        'required' => true,
                        'first_options' => array('label' => 'New Password'),
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

    public function change_passwordAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZeteqUserBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $editForm = $this->createChangePasswordForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ZeteqUserBundle:User:change_password.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    private function createChangePasswordForm(User $entity) {
        $form = $this->createForm(new UserChangePasswordType(), $entity, array(
            'action' => $this->generateUrl('user_update_password', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));



        return $form;
    }

    public function update_passwordAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZeteqUserBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createChangePasswordForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {


            $factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($entity);
            $password = $encoder->encodePassword($entity->getPassword(), $entity->getSalt());
            $entity->setPassword($password);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('user_change_password', array('id' => $id)));
        }

        return $this->render('ZeteqUserBundle:User:change_password.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

}
