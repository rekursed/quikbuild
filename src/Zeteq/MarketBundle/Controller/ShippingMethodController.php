<?php

namespace Zeteq\MarketBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Zeteq\MarketBundle\Entity\ShippingMethod;
use Zeteq\MarketBundle\Form\ShippingMethodType;

use APY\DataGridBundle\Grid\Source\Entity;
use APY\DataGridBundle\Grid\Export\ExcelExport;
use APY\DataGridBundle\Grid\Action\RowAction;
use APY\DataGridBundle\Grid\Action\MassAction;
use APY\DataGridBundle\Grid\Action\DeleteMassAction;

/**
 * ShippingMethod controller.
 *
 */
class ShippingMethodController extends Controller
{
    
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $source = new Entity('ZeteqMarketBundle:ShippingMethod');
        $grid = $this->get('grid');
        $grid->setSource($source);
        $grid->setLimits(array(10, 25, 50, 100, 1000));
        $title = "excel";
        $fileName = "shipping_methods.xls";
        $grid->addExport(new ExcelExport($title, $fileName));


        $rowActionDelete = new RowAction('delete', 'shippingmethod_delete', true);
        $rowAction = new RowAction('edit', 'shippingmethod_edit');




        $grid->addRowAction($rowAction);
        $grid->addRowAction($rowActionDelete);

        $callback = 'ZeteqMarketBundle\ShippingMethodController::delete';
        $grid->addMassAction(new DeleteMassAction());
        $grid->hideColumns(array(
            ));





        $grid->isReadyForRedirect();


        return $grid->getGridResponse('ZeteqMarketBundle:ShippingMethod:indexapy.html.twig');
    }
    
    /**
     * Lists all ShippingMethod entities.
     *
     */
    public function index1Action()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ZeteqMarketBundle:ShippingMethod')->findAll();

        return $this->render('ZeteqMarketBundle:ShippingMethod:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new ShippingMethod entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new ShippingMethod();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('shippingmethod_show', array('id' => $entity->getId())));
        }

        return $this->render('ZeteqMarketBundle:ShippingMethod:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a ShippingMethod entity.
    *
    * @param ShippingMethod $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(ShippingMethod $entity)
    {
        $form = $this->createForm(new ShippingMethodType(), $entity, array(
            'action' => $this->generateUrl('shippingmethod_create'),
            'method' => 'POST',
        ));


        return $form;
    }

    /**
     * Displays a form to create a new ShippingMethod entity.
     *
     */
    public function newAction()
    {
        $entity = new ShippingMethod();
        $form   = $this->createCreateForm($entity);

        return $this->render('ZeteqMarketBundle:ShippingMethod:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ShippingMethod entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZeteqMarketBundle:ShippingMethod')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ShippingMethod entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ZeteqMarketBundle:ShippingMethod:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing ShippingMethod entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZeteqMarketBundle:ShippingMethod')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ShippingMethod entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ZeteqMarketBundle:ShippingMethod:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a ShippingMethod entity.
    *
    * @param ShippingMethod $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ShippingMethod $entity)
    {
        $form = $this->createForm(new ShippingMethodType(), $entity, array(
            'action' => $this->generateUrl('shippingmethod_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));


        return $form;
    }
    /**
     * Edits an existing ShippingMethod entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZeteqMarketBundle:ShippingMethod')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ShippingMethod entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('shippingmethod_edit', array('id' => $id)));
        }

        return $this->render('ZeteqMarketBundle:ShippingMethod:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a ShippingMethod entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ZeteqMarketBundle:ShippingMethod')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ShippingMethod entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('shippingmethod'));
    }

    /**
     * Creates a form to delete a ShippingMethod entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('shippingmethod_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
