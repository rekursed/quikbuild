<?php

namespace Zeteq\MarketBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Zeteq\MarketBundle\Entity\Store;
use Zeteq\MarketBundle\Form\StoreType;
use Zeteq\UserBundle\Form\UserChangePasswordType;
use Zeteq\MarketBundle\Form\StoreAdminSaleType;

/**
 * Store controller.
 *
 */
class StoreAdminController extends Controller {

    /**
     * Edits an existing Sale entity.
     *
     */
    public function sale_updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZeteqMarketBundle:Sale')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sale entity.');
        }
        

        $editForm = $this->createForm(new StoreAdminSaleType(), $entity, array(
            'action' => $this->generateUrl('store_admin_sale_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));
//        throw $this->createNotFoundException('Unable to find User entity.');
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('store_admin_sale_edit', array('store_id' => $entity->getStore()->getId(), 'order' => $entity->getOrderNumber())));
        }
        
        return $this->render('ZeteqMarketBundle:StoreAdminSales:edit.html.twig', array(
                    'edit_form' => $editForm->createView(),
                    'store_id' => $entity->getStore()->getId(),
                    'sale' => $entity,
                    'store' => $entity->getStore()
        ));
    }

    public function sale_editAction($store_id, $order) {
        $em = $this->getDoctrine()->getManager();

        $store = $em->getRepository('ZeteqMarketBundle:Store')->find($store_id);


        $sale = $em->getRepository('ZeteqMarketBundle:Sale')->findOneBy(array('order_number' => $order));

        //throw $this->createNotFoundException('Unable to find User entity.');

        $form = $this->createForm(new StoreAdminSaleType(), $sale, array(
            'action' => $this->generateUrl('store_admin_sale_update', array('id' => $sale->getId())),
            'method' => 'PUT',
        ));

        return $this->render('ZeteqMarketBundle:StoreAdminSales:edit.html.twig', array(
                    'edit_form' => $form->createView(),
                    'store_id' => $store_id,
                    'sale' => $sale,
                    'store' => $store
        ));
    }

    /**
     * Lists all StoreProductCategory entities.
     *
     */
    public function sale_indexAction($store_id) {
        $em = $this->getDoctrine()->getManager();

        $store = $em->getRepository('ZeteqMarketBundle:Store')->find($store_id);

        $repository = $em->getRepository('ZeteqMarketBundle:Sale');
        $query = $repository->createQueryBuilder('p')
                ->where('p.store =:store')
                ->setParameter('store', $store)
                ->getQuery();

        $entities = $query->getResult();


        return $this->render('ZeteqMarketBundle:StoreAdminSales:index.html.twig', array(
                    'entities' => $entities,
                    'store_id' => $store_id,
                    'store' => $store
        ));
    }

    public function my_accountAction() {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.context')->getToken()->getUser();
        $entities = $em->getRepository('ZeteqMarketBundle:Store')->findAll();

        return $this->render('ZeteqMarketBundle:StoreAdmin:my_account.html.twig', array(
                    'entities' => $entities,
        ));
    }

    public function change_passwordAction() {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.context')->getToken()->getUser();
        $entity = $em->getRepository('ZeteqUserBundle:User')->find($user->getId());

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $editForm = $this->createChangePasswordForm($entity);


        return $this->render('ZeteqMarketBundle:StoreAdmin:change_password.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
        ));
    }

    private function createChangePasswordForm($entity) {
        $form = $this->createForm(new UserChangePasswordType(), $entity, array(
            'action' => $this->generateUrl('store_admin_update_password', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    public function update_passwordAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.context')->getToken()->getUser();
        $entity = $em->getRepository('ZeteqUserBundle:User')->find($user->getId());

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }


        $editForm = $this->createChangePasswordForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {


            $factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($entity);
            $password = $encoder->encodePassword($entity->getPassword(), $entity->getSalt());
            $entity->setPassword($password);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('store_admin_change_password'));
        }

        return $this->render('ZeteqMarketBundle:StoreAdmin:change_password.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Lists all Store entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $user = $this->get('security.context')->getToken()->getUser();

        $repo = $em->getRepository('ZeteqMarketBundle:Store');

        $q = $repo->createQueryBuilder('q')
                ->where('q.user=:user')
                ->setParameter('user', $user)
                ->getQuery();

        $entities = $q->getResult();

        return $this->render('ZeteqMarketBundle:StoreAdmin:index.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**
     * Creates a new Store entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new Store();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setUser($this->get('security.context')->getToken()->getUser());
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('store_admin_edit', array('id' => $entity->getId())));
        }

        return $this->render('ZeteqMarketBundle:StoreAdmin:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Store entity.
     *
     * @param Store $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Store $entity) {
        $form = $this->createForm(new StoreType(), $entity, array(
            'action' => $this->generateUrl('store_admin_create'),
            'method' => 'POST',
        ));



        return $form;
    }

    /**
     * Displays a form to create a new Store entity.
     *
     */
    public function newAction() {
        $entity = new Store();
        $form = $this->createCreateForm($entity);

        return $this->render('ZeteqMarketBundle:StoreAdmin:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Store entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZeteqMarketBundle:Store')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Store entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ZeteqMarketBundle:StoreAdmin:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),));
    }

    /**
     * Displays a form to edit an existing Store entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.context')->getToken()->getUser();
        $entity = $em->getRepository('ZeteqMarketBundle:Store')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Store entity.');
        }
        if ($entity->getUser() != $user) {
            throw $this->createNotFoundException('Unable to find Store entity.');
        }


        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ZeteqMarketBundle:StoreAdmin:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
                    'store' => $entity,
        ));
    }

    /**
     * Creates a form to edit a Store entity.
     *
     * @param Store $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Store $entity) {
        $form = $this->createForm(new StoreType(), $entity, array(
            'action' => $this->generateUrl('store_admin_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));



        return $form;
    }

    /**
     * Edits an existing Store entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZeteqMarketBundle:Store')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Store entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('store_admin_edit', array('id' => $id)));
        }

        return $this->render('ZeteqMarketBundle:StoreAdmin:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
                    'store' => $entity,
        ));
    }

    /**
     * Deletes a Store entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ZeteqMarketBundle:Store')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Store entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('store_admin'));
    }

    /**
     * Creates a form to delete a Store entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('store_admin_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm()
        ;
    }

}
