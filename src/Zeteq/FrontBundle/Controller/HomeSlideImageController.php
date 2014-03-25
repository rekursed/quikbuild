<?php

namespace Zeteq\FrontBundle\Controller;

 
use Symfony\Component\HttpFoundation\Request;
use APY\DataGridBundle\Grid\Source\Entity;
use APY\DataGridBundle\Grid\Export\ExcelExport;
use APY\DataGridBundle\Grid\Action\RowAction;
use APY\DataGridBundle\Grid\Action\MassAction;
use APY\DataGridBundle\Grid\Action\DeleteMassAction;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Zeteq\FrontBundle\Entity\HomeSlideImage;
use Zeteq\FrontBundle\Form\HomeSlideImageType;

/**
 * HomeSlideImage controller.
 *
 */
class HomeSlideImageController extends Controller
{

    /**
     * Lists all HomeSlideImage entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

     $source = new Entity('ZeteqFrontBundle:HomeSlideImage');
 

         $grid = $this->get('grid');
        $grid->setSource($source);
        $grid->setLimits(array(10,25,50,100,1000));
        $title= "excel";
        $fileName = "pages.xls";
        $grid->addExport(new ExcelExport($title, $fileName));

        
        $rowActionDelete = new RowAction('delete', 'homeslideimage_delete',true);   
        $rowAction = new RowAction('edit', 'homeslideimage_edit');

 
        $grid->addRowAction($rowAction);    
        $grid->addRowAction($rowActionDelete);    

        $callback = 'ZeteqFrontBundle\HomeSlideImageController::delete';


        $grid->addMassAction(new DeleteMassAction());
    $grid->hideColumns(array(
        
    'id'));





        $grid->isReadyForRedirect();
        
        




return $grid->getGridResponse('ZeteqFrontBundle:HomeSlideImage:index.html.twig');
    }
    /**
     * Creates a new HomeSlideImage entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new HomeSlideImage();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('homeslideimage_edit', array('id' => $entity->getId())));
        }

        return $this->render('ZeteqFrontBundle:HomeSlideImage:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a HomeSlideImage entity.
    *
    * @param HomeSlideImage $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(HomeSlideImage $entity)
    {
        $form = $this->createForm(new HomeSlideImageType(), $entity, array(
            'action' => $this->generateUrl('homeslideimage_create'),
            'method' => 'POST',
        ));

         

        return $form;
    }

    /**
     * Displays a form to create a new HomeSlideImage entity.
     *
     */
    public function newAction()
    {
        $entity = new HomeSlideImage();
        $form   = $this->createCreateForm($entity);

        return $this->render('ZeteqFrontBundle:HomeSlideImage:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a HomeSlideImage entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZeteqFrontBundle:HomeSlideImage')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find HomeSlideImage entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ZeteqFrontBundle:HomeSlideImage:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing HomeSlideImage entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZeteqFrontBundle:HomeSlideImage')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find HomeSlideImage entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ZeteqFrontBundle:HomeSlideImage:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a HomeSlideImage entity.
    *
    * @param HomeSlideImage $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(HomeSlideImage $entity)
    {
        $form = $this->createForm(new HomeSlideImageType(), $entity, array(
            'action' => $this->generateUrl('homeslideimage_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

    

        return $form;
    }
    /**
     * Edits an existing HomeSlideImage entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZeteqFrontBundle:HomeSlideImage')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find HomeSlideImage entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('homeslideimage_edit', array('id' => $id)));
        }

        return $this->render('ZeteqFrontBundle:HomeSlideImage:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a HomeSlideImage entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
 
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ZeteqFrontBundle:HomeSlideImage')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find HomeSlideImage entity.');
            }

            $em->remove($entity);
            $em->flush();
  

        return $this->redirect($this->generateUrl('homeslideimage'));
    }

    /**
     * Creates a form to delete a HomeSlideImage entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('homeslideimage_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
