<?php

namespace Zeteq\MarketBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Zeteq\MarketBundle\Entity\Store;
use Zeteq\MarketBundle\Entity\StoreProductCategory;
use Zeteq\MarketBundle\Form\StoreProductCategoryType;

/**
 * StoreProductCategory controller.
 *
 */
class StoreProductCategoryController extends Controller
{

    /**
     * Lists all StoreProductCategory entities.
     *
     */
    public function indexAction($store_id)
    {
        $em = $this->getDoctrine()->getManager();

        $store = $em->getRepository('ZeteqMarketBundle:Store')->find($store_id);
        
        $repository = $em->getRepository('ZeteqMarketBundle:StoreProductCategory');
        $query = $repository->createQueryBuilder('p')
                    ->where('p.store =:store')
                    ->setParameter('store', $store)
                    ->getQuery();

        $entities = $query->getResult();

       
        return $this->render('ZeteqMarketBundle:StoreProductCategory:index.html.twig', array(
            'entities' => $entities,
            'store_id'=>$store_id,
            'store'=>$store
        ));
    }
    /**
     * Creates a new StoreProductCategory entity.
     *
     */
    public function createAction(Request $request,$store_id)
    {
        $entity = new StoreProductCategory();
        $form = $this->createCreateForm($entity,$store_id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $store = $em->getRepository('ZeteqMarketBundle:Store')->find($store_id);
            $entity->setStore($store);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('storeproductcategory_edit', array('store_id'=>$store_id,'id' => $entity->getId())));
        }

        return $this->render('ZeteqMarketBundle:StoreProductCategory:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a StoreProductCategory entity.
    *
    * @param StoreProductCategory $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(StoreProductCategory $entity,$store_id)
    {
        $form = $this->createForm(new StoreProductCategoryType(), $entity, array(
            'action' => $this->generateUrl('storeproductcategory_create',array('store_id'=>$store_id)),
            'method' => 'POST',
        ));

      
        return $form;
    }

    /**
     * Displays a form to create a new StoreProductCategory entity.
     *
     */
    public function newAction($store_id)
    {
        $entity = new StoreProductCategory();
        $form   = $this->createCreateForm($entity,$store_id);
        
                $em = $this->getDoctrine()->getManager();
        $store = $em->getRepository('ZeteqMarketBundle:Store')->find($store_id);

        return $this->render('ZeteqMarketBundle:StoreProductCategory:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
                'store_id' => $store_id,
              'store' =>$store
        ));
    }

    /**
     * Finds and displays a StoreProductCategory entity.
     *
     */


    /**
     * Displays a form to edit an existing StoreProductCategory entity.
     *
     */
    public function editAction($id,$store_id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZeteqMarketBundle:StoreProductCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find StoreProductCategory entity.');
        }

                  $user = $this->get('security.context')->getToken()->getUser();
                if($entity->getStore()->getUser() != $user)
        {
              throw $this->createNotFoundException('You don\'t have access to this');
        }
        
        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ZeteqMarketBundle:StoreProductCategory:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'store_id'=>$store_id,
            'store'=>$entity->getStore(),
        ));
    }

    /**
    * Creates a form to edit a StoreProductCategory entity.
    *
    * @param StoreProductCategory $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(StoreProductCategory $entity)
    {
        $form = $this->createForm(new StoreProductCategoryType(), $entity, array(
            'action' => $this->generateUrl('storeproductcategory_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

       

        return $form;
    }
    /**
     * Edits an existing StoreProductCategory entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZeteqMarketBundle:StoreProductCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find StoreProductCategory entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('storeproductcategory_edit', array('store_id'=>$entity->getStore()->getId(), 'id' => $id)));
        }

        return $this->render('ZeteqMarketBundle:StoreProductCategory:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a StoreProductCategory entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
 
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ZeteqMarketBundle:StoreProductCategory')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find StoreProductCategory entity.');
            }

            $sid = $entity->getStore()->getId();
            $em->remove($entity);
            $em->flush();


        return $this->redirect($this->generateUrl('storeproductcategory',array('store_id'=>$sid) ));
    }

    /**
     * Creates a form to delete a StoreProductCategory entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('storeproductcategory_delete', array('id' => $id)))
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
      $p = $em->getRepository('ZeteqMarketBundle:StoreProductCategory')->find($c);
      $store_id= $p->getStore()->getId();
      $em->remove($p);
      $em->flush();

            
}

       return $this->redirect($this->generateUrl('storeproductcategory',array('store_id'=>$store_id)));
  }
}
