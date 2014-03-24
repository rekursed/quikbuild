<?php

namespace Zeteq\MarketBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Zeteq\MarketBundle\Entity\StoreSection;
use Zeteq\MarketBundle\Form\StoreSectionType;

use APY\DataGridBundle\Grid\Source\Entity;
use APY\DataGridBundle\Grid\Export\ExcelExport;
use APY\DataGridBundle\Grid\Action\RowAction;
use APY\DataGridBundle\Grid\Action\MassAction;
use APY\DataGridBundle\Grid\Action\DeleteMassAction;

/**
 * StoreSection controller.
 *
 */
class StoreSectionController extends Controller {

    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $source = new Entity('ZeteqMarketBundle:StoreSection');
        $grid = $this->get('grid');
        $grid->setSource($source);
        $grid->setLimits(array(10, 25, 50, 100, 1000));
        $title = "excel";
        $fileName = "pages.xls";
        $grid->addExport(new ExcelExport($title, $fileName));


        $rowActionDelete = new RowAction('delete', 'storesection_delete', true);
        $rowAction = new RowAction('edit', 'storesection_edit');




        $grid->addRowAction($rowAction);
        $grid->addRowAction($rowActionDelete);

        $callback = 'ZeteqMarketBundle\StoreSectionController::delete';
        $grid->addMassAction(new DeleteMassAction());
        $grid->hideColumns(array(
            
        ));





        $grid->isReadyForRedirect();


        return $grid->getGridResponse('ZeteqMarketBundle:StoreSection:indexapy.html.twig');
    }

    /**
     * Lists all StoreSection entities.
     *
     */
    public function index1Action() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ZeteqMarketBundle:StoreSection')->findAll();

        return $this->render('ZeteqMarketBundle:StoreSection:index.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**
     * Creates a new StoreSection entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new StoreSection();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('storesection_edit', array('id' => $entity->getId())));
        }

        return $this->render('ZeteqMarketBundle:StoreSection:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a StoreSection entity.
     *
     * @param StoreSection $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(StoreSection $entity) {
        $form = $this->createForm(new StoreSectionType(), $entity, array(
            'action' => $this->generateUrl('storesection_create'),
            'method' => 'POST',
        ));

      

        return $form;
    }

    /**
     * Displays a form to create a new StoreSection entity.
     *
     */
    public function newAction() {
        $entity = new StoreSection();
        $form = $this->createCreateForm($entity);

        return $this->render('ZeteqMarketBundle:StoreSection:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a StoreSection entity.
     *
     */

    /**
     * Displays a form to edit an existing StoreSection entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZeteqMarketBundle:StoreSection')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find StoreSection entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ZeteqMarketBundle:StoreSection:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a StoreSection entity.
     *
     * @param StoreSection $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(StoreSection $entity) {
        $form = $this->createForm(new StoreSectionType(), $entity, array(
            'action' => $this->generateUrl('storesection_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        return $form;
    }

    /**
     * Edits an existing StoreSection entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZeteqMarketBundle:StoreSection')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find StoreSection entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('storesection_edit', array('id' => $id)));
        }

        return $this->render('ZeteqMarketBundle:StoreSection:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a StoreSection entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ZeteqMarketBundle:StoreSection')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find StoreSection entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('storesection'));
    }

    /**
     * Creates a form to delete a StoreSection entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('storesection_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm()
        ;
    }

}
