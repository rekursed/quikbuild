<?php

namespace Zeteq\MarketBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Zeteq\MarketBundle\Entity\ProductSection;
use Zeteq\MarketBundle\Form\ProductSectionType;
use APY\DataGridBundle\Grid\Source\Entity;
use APY\DataGridBundle\Grid\Export\ExcelExport;
use APY\DataGridBundle\Grid\Action\RowAction;
use APY\DataGridBundle\Grid\Action\MassAction;
use APY\DataGridBundle\Grid\Action\DeleteMassAction;

/**
 * ProductSection controller.
 *
 */
class ProductSectionController extends Controller {

    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $source = new Entity('ZeteqMarketBundle:ProductSection');
        $grid = $this->get('grid');
        $grid->setSource($source);
        $grid->setLimits(array(10, 25, 50, 100, 1000));
        $title = "excel";
        $fileName = "productsections.xls";
        $grid->addExport(new ExcelExport($title, $fileName));


        $rowActionDelete = new RowAction('delete', 'productsection_delete', true);
        $rowAction = new RowAction('edit', 'productsection_edit');




        $grid->addRowAction($rowAction);
        $grid->addRowAction($rowActionDelete);

        $callback = 'ZeteqMarketBundle\ProductController::delete';
        $grid->addMassAction(new DeleteMassAction());
        $grid->hideColumns(array(
            'slug','description'
            ));





        $grid->isReadyForRedirect();


        return $grid->getGridResponse('ZeteqMarketBundle:ProductSection:indexapy.html.twig');
    }

    /**
     * Lists all ProductSection entities.
     *
     */
    public function index1Action() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ZeteqMarketBundle:ProductSection')->findAll();

        return $this->render('ZeteqMarketBundle:ProductSection:index.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**
     * Creates a new ProductSection entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new ProductSection();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('productsection_edit', array('id' => $entity->getId())));
        }

        return $this->render('ZeteqMarketBundle:ProductSection:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a ProductSection entity.
     *
     * @param ProductSection $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(ProductSection $entity) {
        $form = $this->createForm(new ProductSectionType(), $entity, array(
            'action' => $this->generateUrl('productsection_create'),
            'method' => 'POST',
        ));

        

        return $form;
    }

    /**
     * Displays a form to create a new ProductSection entity.
     *
     */
    public function newAction() {
        $entity = new ProductSection();
        $form = $this->createCreateForm($entity);

        return $this->render('ZeteqMarketBundle:ProductSection:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ProductSection entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZeteqMarketBundle:ProductSection')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductSection entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ZeteqMarketBundle:ProductSection:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),));
    }

    /**
     * Displays a form to edit an existing ProductSection entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZeteqMarketBundle:ProductSection')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductSection entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ZeteqMarketBundle:ProductSection:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a ProductSection entity.
     *
     * @param ProductSection $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(ProductSection $entity) {
        $form = $this->createForm(new ProductSectionType(), $entity, array(
            'action' => $this->generateUrl('productsection_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

      

        return $form;
    }

    /**
     * Edits an existing ProductSection entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZeteqMarketBundle:ProductSection')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductSection entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('productsection_edit', array('id' => $id)));
        }

        return $this->render('ZeteqMarketBundle:ProductSection:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ProductSection entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ZeteqMarketBundle:ProductSection')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ProductSection entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('productsection'));
    }

    /**
     * Creates a form to delete a ProductSection entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('productsection_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm()
        ;
    }

}
