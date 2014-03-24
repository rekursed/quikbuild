<?php

namespace Zeteq\MarketBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Zeteq\MarketBundle\Entity\ProductCategory;
use Zeteq\MarketBundle\Form\ProductCategoryType;


 
use APY\DataGridBundle\Grid\Source\Entity;
use APY\DataGridBundle\Grid\Export\ExcelExport;
use APY\DataGridBundle\Grid\Action\RowAction;
use APY\DataGridBundle\Grid\Action\MassAction;
use APY\DataGridBundle\Grid\Action\DeleteMassAction;


/**
 * ProductCategory controller.
 *
 */

class ProductCategoryController extends Controller
{
    
    
          
       public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $source = new Entity('ZeteqMarketBundle:ProductCategory');
        $grid = $this->get('grid');
        $grid->setSource($source);
        $grid->setLimits(array(10,25,50,100,1000));
        
        
        $title= "excel";
        $fileName = "pages.xls";
        $grid->addExport(new ExcelExport($title, $fileName));

        
        $rowActionDelete = new RowAction('delete', 'productcategory_delete',true);   
        $rowAction = new RowAction('edit', 'productcategory_edit');



 
        $grid->addRowAction($rowAction);    
        $grid->addRowAction($rowActionDelete);   
        
        

        $callback = 'ZeteqMarketBundle\ProductCategoryController::delete';
        $grid->addMassAction(new DeleteMassAction());
        
        
        $grid->hideColumns(array(
        
       'slug','description' ));





        $grid->isReadyForRedirect();
        
        
return $grid->getGridResponse('ZeteqMarketBundle:ProductCategory:indexapy.html.twig');
 
    }   
    

    /**
     * Lists all ProductCategory entities.
     *
     */
    public function index2Action()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ZeteqMarketBundle:ProductCategory')->findAll();

        return $this->render('ZeteqMarketBundle:ProductCategory:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new ProductCategory entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new ProductCategory();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('productcategory_edit', array('id' => $entity->getId())));
        }

        return $this->render('ZeteqMarketBundle:ProductCategory:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a ProductCategory entity.
    *
    * @param ProductCategory $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(ProductCategory $entity)
    {
        $form = $this->createForm(new ProductCategoryType(), $entity, array(
            'action' => $this->generateUrl('productcategory_create'),
            'method' => 'POST',
        ));

        

        return $form;
    }

    /**
     * Displays a form to create a new ProductCategory entity.
     *
     */
    public function newAction()
    {
        $entity = new ProductCategory();
        $form   = $this->createCreateForm($entity);

        return $this->render('ZeteqMarketBundle:ProductCategory:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ProductCategory entity.
     *
     */


    /**
     * Displays a form to edit an existing ProductCategory entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZeteqMarketBundle:ProductCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductCategory entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ZeteqMarketBundle:ProductCategory:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a ProductCategory entity.
    *
    * @param ProductCategory $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ProductCategory $entity)
    {
        $form = $this->createForm(new ProductCategoryType(), $entity, array(
            'action' => $this->generateUrl('productcategory_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing ProductCategory entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZeteqMarketBundle:ProductCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductCategory entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('productcategory_edit', array('id' => $id)));
        }

        return $this->render('ZeteqMarketBundle:ProductCategory:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a ProductCategory entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ZeteqMarketBundle:ProductCategory')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ProductCategory entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('productcategory'));
    }

    /**
     * Creates a form to delete a ProductCategory entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('productcategory_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
