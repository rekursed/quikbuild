<?php

namespace Zeteq\MarketBundle\Controller;

 
use Symfony\Component\HttpFoundation\Request;
use APY\DataGridBundle\Grid\Source\Entity;
use APY\DataGridBundle\Grid\Export\ExcelExport;
use APY\DataGridBundle\Grid\Action\RowAction;
use APY\DataGridBundle\Grid\Action\MassAction;
use APY\DataGridBundle\Grid\Action\DeleteMassAction;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Zeteq\MarketBundle\Entity\ProductRating;
use Zeteq\MarketBundle\Form\ProductRatingType;

/**
 * ProductRating controller.
 *
 */
class ProductRatingController extends Controller
{

    /**
     * Lists all ProductRating entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

     $source = new Entity('ZeteqMarketBundle:ProductRating');
 

         $grid = $this->get('grid');
        $grid->setSource($source);
        $grid->setLimits(array(10,25,50,100,1000));
        $title= "excel";
        $fileName = "pages.xls";
        $grid->addExport(new ExcelExport($title, $fileName));

        
        $rowActionDelete = new RowAction('delete', 'productrating_delete',true);   
        $rowAction = new RowAction('edit', 'productrating_edit');

 
        $grid->addRowAction($rowAction);    
        $grid->addRowAction($rowActionDelete);    

        $callback = 'ZeteqMarketBundle\ProductRatingController::delete';


        $grid->addMassAction(new DeleteMassAction());
    $grid->hideColumns(array(
        
    'id'));





        $grid->isReadyForRedirect();
        
        




return $grid->getGridResponse('ZeteqMarketBundle:ProductRating:index.html.twig');
    }
    /**
     * Creates a new ProductRating entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new ProductRating();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('productrating_edit', array('id' => $entity->getId())));
        }

        return $this->render('ZeteqMarketBundle:ProductRating:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a ProductRating entity.
    *
    * @param ProductRating $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(ProductRating $entity)
    {
        $form = $this->createForm(new ProductRatingType(), $entity, array(
            'action' => $this->generateUrl('productrating_create'),
            'method' => 'POST',
        ));

         

        return $form;
    }

    /**
     * Displays a form to create a new ProductRating entity.
     *
     */
    public function newAction()
    {
        $entity = new ProductRating();
        $form   = $this->createCreateForm($entity);

        return $this->render('ZeteqMarketBundle:ProductRating:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ProductRating entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZeteqMarketBundle:ProductRating')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductRating entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ZeteqMarketBundle:ProductRating:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing ProductRating entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZeteqMarketBundle:ProductRating')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductRating entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ZeteqMarketBundle:ProductRating:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a ProductRating entity.
    *
    * @param ProductRating $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ProductRating $entity)
    {
        $form = $this->createForm(new ProductRatingType(), $entity, array(
            'action' => $this->generateUrl('productrating_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

    

        return $form;
    }
    /**
     * Edits an existing ProductRating entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZeteqMarketBundle:ProductRating')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductRating entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('productrating_edit', array('id' => $id)));
        }

        return $this->render('ZeteqMarketBundle:ProductRating:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a ProductRating entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
 
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ZeteqMarketBundle:ProductRating')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ProductRating entity.');
            }

            $em->remove($entity);
            $em->flush();
  

        return $this->redirect($this->generateUrl('productrating'));
    }

    /**
     * Creates a form to delete a ProductRating entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('productrating_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
