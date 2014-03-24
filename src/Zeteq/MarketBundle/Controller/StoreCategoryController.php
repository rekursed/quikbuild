<?php

namespace Zeteq\MarketBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Zeteq\MarketBundle\Entity\StoreCategory;
use Zeteq\MarketBundle\Form\StoreCategoryType;

use APY\DataGridBundle\Grid\Source\Entity;
use APY\DataGridBundle\Grid\Export\ExcelExport;
use APY\DataGridBundle\Grid\Action\RowAction;
use APY\DataGridBundle\Grid\Action\MassAction;
use APY\DataGridBundle\Grid\Action\DeleteMassAction;

/**
 * StoreCategory controller.
 *
 */
class StoreCategoryController extends Controller
{
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $source = new Entity('ZeteqMarketBundle:StoreCategory');
        $grid = $this->get('grid');
        $grid->setSource($source);
        $grid->setLimits(array(10, 25, 50, 100, 1000));
        $title = "excel";
        $fileName = "StoreCategories.xls";
        $grid->addExport(new ExcelExport($title, $fileName));


        $rowActionDelete = new RowAction('delete', 'storecategory_delete', true);
        $rowAction = new RowAction('edit', 'storecategory_edit');




        $grid->addRowAction($rowAction);
        $grid->addRowAction($rowActionDelete);

        $callback = 'ZeteqMarketBundle\StoreCategoryController::delete';
        $grid->addMassAction(new DeleteMassAction());
        $grid->hideColumns(array(
            
        ));





        $grid->isReadyForRedirect();


        return $grid->getGridResponse('ZeteqMarketBundle:StoreCategory:indexapy.html.twig');
    }
    
    /**
     * Lists all StoreCategory entities.
     *
     */
    public function index1Action()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ZeteqMarketBundle:StoreCategory')->findAll();

        return $this->render('ZeteqMarketBundle:StoreCategory:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new StoreCategory entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new StoreCategory();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('storecategory_edit', array('id' => $entity->getId())));
        }

        return $this->render('ZeteqMarketBundle:StoreCategory:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a StoreCategory entity.
    *
    * @param StoreCategory $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(StoreCategory $entity)
    {
        $form = $this->createForm(new StoreCategoryType(), $entity, array(
            'action' => $this->generateUrl('storecategory_create'),
            'method' => 'POST',
        ));
      

        return $form;
    }

    /**
     * Displays a form to create a new StoreCategory entity.
     *
     */
    public function newAction()
    {
        $entity = new StoreCategory();
        $form   = $this->createCreateForm($entity);

        return $this->render('ZeteqMarketBundle:StoreCategory:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }



    /**
     * Displays a form to edit an existing StoreCategory entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZeteqMarketBundle:StoreCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find StoreCategory entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ZeteqMarketBundle:StoreCategory:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a StoreCategory entity.
    *
    * @param StoreCategory $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(StoreCategory $entity)
    {
        $form = $this->createForm(new StoreCategoryType(), $entity, array(
            'action' => $this->generateUrl('storecategory_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

    

        return $form;
    }
    /**
     * Edits an existing StoreCategory entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZeteqMarketBundle:StoreCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find StoreCategory entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('storecategory_edit', array('id' => $id)));
        }

        return $this->render('ZeteqMarketBundle:StoreCategory:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a StoreCategory entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ZeteqMarketBundle:StoreCategory')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find StoreCategory entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('storecategory'));
    }

    /**
     * Creates a form to delete a StoreCategory entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('storecategory_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
