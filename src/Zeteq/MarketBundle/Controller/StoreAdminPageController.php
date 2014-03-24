<?php

namespace Zeteq\MarketBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Zeteq\MarketBundle\Entity\Store;
use Zeteq\MarketBundle\Entity\Page;
use Zeteq\MarketBundle\Form\PageType;

/**
 * Page controller.
 *
 */
class StoreAdminPageController extends Controller
{

    /**
     * Lists all Page entities.
     *
     */
    public function indexAction($store_id)
    {
        $em = $this->getDoctrine()->getManager();

       $store = $em->getRepository('ZeteqMarketBundle:Store')->find($store_id);

        
        
            $repository = $em->getRepository('ZeteqMarketBundle:Page');
            $query = $repository->createQueryBuilder('p')
                    ->where('p.store =:store_id')
                    ->setParameter('store_id', $store_id)
                    ->getQuery();

            
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query, $this->get('request')->query->get('page', 1)/* page number */, 5/* limit per page */
        );
        
        
        
        
        
        return $this->render('ZeteqMarketBundle:StoreAdminPage:index.html.twig', array(
            'pagination' => $pagination,
            'store_id' =>$store_id,
            'store'=>$store,
        ));
    }
    /**
     * Creates a new Page entity.
     *
     */
    public function createAction(Request $request,$store_id)
    {
        $entity = new Page();
        $form = $this->createCreateForm($entity,$store_id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $store  = $em->getRepository('ZeteqMarketBundle:Store')->find($store_id);
            $entity->setStore($store);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('storeadmin_page_edit', array('store_id'=>$store_id, 'id' => $entity->getId())));
        }

        return $this->render('ZeteqMarketBundle:Page:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Page entity.
    *
    * @param Page $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Page $entity,$store_id)
    {
        $form = $this->createForm(new PageType(), $entity, array(
            'action' => $this->generateUrl('storeadmin_page_create',array('store_id'=>$store_id)),
            'method' => 'POST',
        ));

     

        return $form;
    }

    /**
     * Displays a form to create a new Page entity.
     *
     */
    public function newAction($store_id)
    {
        $entity = new Page();
        $entity->setStoreId($store_id);
        $form   = $this->createCreateForm($entity,$store_id);
        $em = $this->getDoctrine()->getManager();
        $store = $em->getRepository('ZeteqMarketBundle:Store')->find($store_id);
        return $this->render('ZeteqMarketBundle:StoreAdminPage:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'store_id'=>$store_id,
            'store' =>$store
        ));
    }

    /**
     * Finds and displays a Page entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZeteqMarketBundle:Page')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Page entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ZeteqMarketBundle:Page:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Page entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZeteqMarketBundle:Page')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Page entity.');
        }
        
                  $user = $this->get('security.context')->getToken()->getUser();
                if($entity->getStore()->getUser() != $user)
        {
              throw $this->createNotFoundException('You don\'t have access to this');
        }
        
        

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ZeteqMarketBundle:StoreAdminPage:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'store_id'=> $entity->getStore()->getId(),
                  'store' =>$entity->getStore()
        ));
    }

    /**
    * Creates a form to edit a Page entity.
    *
    * @param Page $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Page $entity)
    {
        $form = $this->createForm(new PageType(), $entity, array(
            'action' => $this->generateUrl('storeadmin_page_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

       

        return $form;
    }
    /**
     * Edits an existing Page entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZeteqMarketBundle:Page')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Page entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('storeadmin_page_edit', array('store_id'=>$entity->getId(), 'id' => $id)));
        }

        return $this->render('ZeteqMarketBundle:Page:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Page entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
 
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ZeteqMarketBundle:Page')->find($id);
$store_id = $entity->getStore()->getId();
            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Page entity.');
            }

            $em->remove($entity);
            $em->flush();
 

        return $this->redirect($this->generateUrl('storeadmin_page',array('store_id'=>$store_id)) );
    }

    /**
     * Creates a form to delete a Page entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('storeadmin_page_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
    
    
    public function batch_deleteAction(Request $request)
  {

       $em = $this->getDoctrine()->getManager();
        $chks =  $request->request->get('prod');
        $store_id=1;
        foreach($chks as $c){
      $p = $em->getRepository('ZeteqMarketBundle:Page')->find($c);
      $store_id= $p->getStore()->getId();
      $em->remove($p);
      $em->flush();

            
}

       return $this->redirect($this->generateUrl('storeadmin_page',array('store_id'=>$store_id)));
  }
  
  
}
