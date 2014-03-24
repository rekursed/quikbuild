<?php

namespace Zeteq\MarketBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Zeteq\MarketBundle\Entity\PaymentMethod;
use Zeteq\MarketBundle\Form\PaymentMethodType;

use APY\DataGridBundle\Grid\Source\Entity;
use APY\DataGridBundle\Grid\Export\ExcelExport;
use APY\DataGridBundle\Grid\Action\RowAction;
use APY\DataGridBundle\Grid\Action\MassAction;
use APY\DataGridBundle\Grid\Action\DeleteMassAction;


/**
 * PaymentMethod controller.
 *
 */
class PaymentMethodController extends Controller
{
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $source = new Entity('ZeteqMarketBundle:PaymentMethod');
        $grid = $this->get('grid');
        $grid->setSource($source);
        $grid->setLimits(array(10, 25, 50, 100, 1000));
        $title = "excel";
        $fileName = "payment_methods.xls";
        $grid->addExport(new ExcelExport($title, $fileName));


        $rowActionDelete = new RowAction('delete', 'paymentmethod_delete', true);
        $rowAction = new RowAction('edit', 'paymentmethod_edit');




        $grid->addRowAction($rowAction);
        $grid->addRowAction($rowActionDelete);

        $callback = 'ZeteqMarketBundle\PaymentMethodController::delete';
        $grid->addMassAction(new DeleteMassAction());
        $grid->hideColumns(array(
            ));





        $grid->isReadyForRedirect();


        return $grid->getGridResponse('ZeteqMarketBundle:PaymentMethod:indexapy.html.twig');
    }

    /**
     * Lists all PaymentMethod entities.
     *
     */
    public function index1Action()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ZeteqMarketBundle:PaymentMethod')->findAll();

        return $this->render('ZeteqMarketBundle:PaymentMethod:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new PaymentMethod entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new PaymentMethod();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('paymentmethod_show', array('id' => $entity->getId())));
        }

        return $this->render('ZeteqMarketBundle:PaymentMethod:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a PaymentMethod entity.
    *
    * @param PaymentMethod $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(PaymentMethod $entity)
    {
        $form = $this->createForm(new PaymentMethodType(), $entity, array(
            'action' => $this->generateUrl('paymentmethod_create'),
            'method' => 'POST',
        ));

       

        return $form;
    }

    /**
     * Displays a form to create a new PaymentMethod entity.
     *
     */
    public function newAction()
    {
        $entity = new PaymentMethod();
        $form   = $this->createCreateForm($entity);

        return $this->render('ZeteqMarketBundle:PaymentMethod:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a PaymentMethod entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZeteqMarketBundle:PaymentMethod')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PaymentMethod entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ZeteqMarketBundle:PaymentMethod:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing PaymentMethod entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZeteqMarketBundle:PaymentMethod')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PaymentMethod entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ZeteqMarketBundle:PaymentMethod:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a PaymentMethod entity.
    *
    * @param PaymentMethod $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(PaymentMethod $entity)
    {
        $form = $this->createForm(new PaymentMethodType(), $entity, array(
            'action' => $this->generateUrl('paymentmethod_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

   

        return $form;
    }
    /**
     * Edits an existing PaymentMethod entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZeteqMarketBundle:PaymentMethod')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PaymentMethod entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('paymentmethod_edit', array('id' => $id)));
        }

        return $this->render('ZeteqMarketBundle:PaymentMethod:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a PaymentMethod entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ZeteqMarketBundle:PaymentMethod')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find PaymentMethod entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('paymentmethod'));
    }

    /**
     * Creates a form to delete a PaymentMethod entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('paymentmethod_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
