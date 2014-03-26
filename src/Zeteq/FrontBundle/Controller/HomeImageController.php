<?php

namespace Zeteq\FrontBundle\Controller;

 
use Symfony\Component\HttpFoundation\Request;
use APY\DataGridBundle\Grid\Source\Entity;
use APY\DataGridBundle\Grid\Export\ExcelExport;
use APY\DataGridBundle\Grid\Action\RowAction;
use APY\DataGridBundle\Grid\Action\MassAction;
use APY\DataGridBundle\Grid\Action\DeleteMassAction;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Zeteq\FrontBundle\Entity\HomeImage;
use Zeteq\FrontBundle\Form\HomeImageType;

/**
 * HomeImage controller.
 *
 */
class HomeImageController extends Controller
{

    /**
     * Lists all HomeImage entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

     $source = new Entity('ZeteqFrontBundle:HomeImage');
 

         $grid = $this->get('grid');
        $grid->setSource($source);
        $grid->setLimits(array(10,25,50,100,1000));
        $title= "excel";
        $fileName = "pages.xls";
        $grid->addExport(new ExcelExport($title, $fileName));

        
        $rowActionDelete = new RowAction('delete', 'homeimage_delete',true);   
        $rowAction = new RowAction('edit', 'homeimage_edit');

 
        $grid->addRowAction($rowAction);    
        $grid->addRowAction($rowActionDelete);    

        $callback = 'ZeteqFrontBundle\HomeImageController::delete';


        $grid->addMassAction(new DeleteMassAction());
    $grid->hideColumns(array(
        
    'id'));





        $grid->isReadyForRedirect();
        
        




return $grid->getGridResponse('ZeteqFrontBundle:HomeImage:index.html.twig');
    }
    /**
     * Creates a new HomeImage entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new HomeImage();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('homeimage_edit', array('id' => $entity->getId())));
        }

        return $this->render('ZeteqFrontBundle:HomeImage:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a HomeImage entity.
    *
    * @param HomeImage $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(HomeImage $entity)
    {
        $form = $this->createForm(new HomeImageType(), $entity, array(
            'action' => $this->generateUrl('homeimage_create'),
            'method' => 'POST',
        ));

         

        return $form;
    }

    /**
     * Displays a form to create a new HomeImage entity.
     *
     */
    public function newAction()
    {
        $entity = new HomeImage();
        $form   = $this->createCreateForm($entity);

        return $this->render('ZeteqFrontBundle:HomeImage:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a HomeImage entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZeteqFrontBundle:HomeImage')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find HomeImage entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ZeteqFrontBundle:HomeImage:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing HomeImage entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZeteqFrontBundle:HomeImage')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find HomeImage entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ZeteqFrontBundle:HomeImage:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a HomeImage entity.
    *
    * @param HomeImage $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(HomeImage $entity)
    {
        $form = $this->createForm(new HomeImageType(), $entity, array(
            'action' => $this->generateUrl('homeimage_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

    

        return $form;
    }
    /**
     * Edits an existing HomeImage entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZeteqFrontBundle:HomeImage')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find HomeImage entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('homeimage_edit', array('id' => $id)));
        }

        return $this->render('ZeteqFrontBundle:HomeImage:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a HomeImage entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
 
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ZeteqFrontBundle:HomeImage')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find HomeImage entity.');
            }

            $em->remove($entity);
            $em->flush();
  

        return $this->redirect($this->generateUrl('homeimage'));
    }

    /**
     * Creates a form to delete a HomeImage entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('homeimage_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
