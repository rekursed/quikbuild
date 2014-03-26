<?php

namespace Zeteq\FrontBundle\Controller;

 
use Symfony\Component\HttpFoundation\Request;
use APY\DataGridBundle\Grid\Source\Entity;
use APY\DataGridBundle\Grid\Export\ExcelExport;
use APY\DataGridBundle\Grid\Action\RowAction;
use APY\DataGridBundle\Grid\Action\MassAction;
use APY\DataGridBundle\Grid\Action\DeleteMassAction;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Zeteq\FrontBundle\Entity\HomeSlideGallery;
use Zeteq\FrontBundle\Form\HomeSlideGalleryType;

/**
 * HomeSlideGallery controller.
 *
 */
class HomeSlideGalleryController extends Controller
{

    /**
     * Lists all HomeSlideGallery entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

     $source = new Entity('ZeteqFrontBundle:HomeSlideGallery');
 

         $grid = $this->get('grid');
        $grid->setSource($source);
        $grid->setLimits(array(10,25,50,100,1000));
        $title= "excel";
        $fileName = "pages.xls";
        $grid->addExport(new ExcelExport($title, $fileName));

        
        $rowActionDelete = new RowAction('delete', 'homeslidegallery_delete',true);   
        $rowAction = new RowAction('edit', 'homeslidegallery_edit');

 
        $grid->addRowAction($rowAction);    
        $grid->addRowAction($rowActionDelete);    

        $callback = 'ZeteqFrontBundle\HomeSlideGalleryController::delete';


        $grid->addMassAction(new DeleteMassAction());
    $grid->hideColumns(array(
        
    'id'));





        $grid->isReadyForRedirect();
        
        




return $grid->getGridResponse('ZeteqFrontBundle:HomeSlideGallery:index.html.twig');
    }
    /**
     * Creates a new HomeSlideGallery entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new HomeSlideGallery();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('homeslidegallery_edit', array('id' => $entity->getId())));
        }

        return $this->render('ZeteqFrontBundle:HomeSlideGallery:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a HomeSlideGallery entity.
    *
    * @param HomeSlideGallery $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(HomeSlideGallery $entity)
    {
        $form = $this->createForm(new HomeSlideGalleryType(), $entity, array(
            'action' => $this->generateUrl('homeslidegallery_create'),
            'method' => 'POST',
        ));

         

        return $form;
    }

    /**
     * Displays a form to create a new HomeSlideGallery entity.
     *
     */
    public function newAction()
    {
        $entity = new HomeSlideGallery();
        $form   = $this->createCreateForm($entity);

        return $this->render('ZeteqFrontBundle:HomeSlideGallery:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a HomeSlideGallery entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZeteqFrontBundle:HomeSlideGallery')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find HomeSlideGallery entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ZeteqFrontBundle:HomeSlideGallery:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing HomeSlideGallery entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZeteqFrontBundle:HomeSlideGallery')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find HomeSlideGallery entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ZeteqFrontBundle:HomeSlideGallery:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a HomeSlideGallery entity.
    *
    * @param HomeSlideGallery $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(HomeSlideGallery $entity)
    {
        $form = $this->createForm(new HomeSlideGalleryType(), $entity, array(
            'action' => $this->generateUrl('homeslidegallery_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

    

        return $form;
    }
    /**
     * Edits an existing HomeSlideGallery entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZeteqFrontBundle:HomeSlideGallery')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find HomeSlideGallery entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('homeslidegallery_edit', array('id' => $id)));
        }

        return $this->render('ZeteqFrontBundle:HomeSlideGallery:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a HomeSlideGallery entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
 
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ZeteqFrontBundle:HomeSlideGallery')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find HomeSlideGallery entity.');
            }

            $em->remove($entity);
            $em->flush();
  

        return $this->redirect($this->generateUrl('homeslidegallery'));
    }

    /**
     * Creates a form to delete a HomeSlideGallery entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('homeslidegallery_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
