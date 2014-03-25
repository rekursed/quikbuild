<?php

namespace Zeteq\MarketBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Zeteq\MarketBundle\Entity\Store;
use Zeteq\MarketBundle\Entity\Product;
use Zeteq\MarketBundle\Form\ProductType;
use \Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Product controller.
 *
 */
class StoreAdminProductController extends Controller {

    /**
     * Deletes a Product entity.
     *
     */
    public function rating_deleteAction(Request $request, $id) {



        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('ZeteqMarketBundle:ProductRating')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Product Rating entity.');
        }
       
        $em->remove($entity);
        $em->flush();


        return new JsonResponse(array('val' => 1));
    }
    
    /**
     * Edits an existing Product entity.
     *
     */
    public function rating_approveAction( $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZeteqMarketBundle:ProductRating')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }
        
        $entity->setEnabled(true);
       $em->flush();

      return new JsonResponse(array('val' => 1));
    }

    /**
     * Lists all Product entities.
     *
     */
    public function ratingIndexAction($store_id) {
        $em = $this->getDoctrine()->getManager();

        $store = $em->getRepository('ZeteqMarketBundle:Store')->find($store_id);

        $repository = $em->getRepository('ZeteqMarketBundle:Product');
        $query = $repository->createQueryBuilder('p')
                ->where('p.store =:store')
                ->add('orderBy', 'p.created ASC')
                ->setParameter('store', $store)
                ->getQuery();

        $products = $query->getResult();

        $ratings = array();
        foreach ($products as $p) {

            foreach ($p->getProductRatings() as $rate) {


                if ($rate->getEnabled() == FALSE) {
                    $ratings[] = $rate;
                }
            }
        }

        return $this->render('ZeteqMarketBundle:StoreAdminProduct:rating.html.twig', array(
                    'entities' => $products,
                    'store' => $store,
                    'ratings' => $ratings,
        ));
    }

    public function read_excelAction(Request $request, $store_id) {

        $em = $this->getDoctrine()->getManager();

        $store = $em->getRepository('ZeteqMarketBundle:Store')->find($store_id);
        $cat = $em->getRepository('ZeteqMarketBundle:ProductCategory')->find(3);
        $scat = $em->getRepository('ZeteqMarketBundle:StoreProductCategory')->find(5);

        $target_path = $this->get('kernel')->getRootDir() . '/../public_html/upload/product/';
        $target_path = $target_path . basename($_FILES['uploadedfile']['name']);
        if (move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {


            $row = 1;
            if (($handle = fopen($target_path, "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    $num = count($data);
                    $product = new Product();
                    $row++;
                    $ar = array();
                    for ($c = 0; $c < $num; $c++) {

                        $ar[$c] = $data[$c];
                    }
                    $product->setName($ar[0]);
                    $product->setPrice($ar[1]);
                    $product->setDescription($ar[2]);
                    $product->setImagePath($ar[3]);
                    $product->setStore($store);
                    //      $product->addCategorie($cat);
                    //     $product->addStoreProductCategorie($scat);


                    $em->persist($product);
                    $em->flush();
                }
                fclose($handle);
                unlink($target_path);
            }
        }

        return $this->redirect($this->generateUrl('storeadmin_product', array('store_id' => $store_id)));
    }

    public function batch_deleteAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $chks = $request->request->get('prod');
        $store_id = 1;
        foreach ($chks as $c) {
            $p = $em->getRepository('ZeteqMarketBundle:Product')->find($c);
            $store_id = $p->getStore()->getId();
            $em->remove($p);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('storeadmin_product', array('store_id' => $store_id)));
    }

    /**
     * Lists all Product entities.
     *
     */
    public function indexAction($store_id) {
        $em = $this->getDoctrine()->getManager();

        $store = $em->getRepository('ZeteqMarketBundle:Store')->find($store_id);

        $repository = $em->getRepository('ZeteqMarketBundle:Product');
        $query = $repository->createQueryBuilder('p')
                ->where('p.store =:store')
                ->add('orderBy', 'p.created ASC')
                ->setParameter('store', $store)
                ->getQuery();

        $products = $query->getResult();

        return $this->render('ZeteqMarketBundle:StoreAdminProduct:index.html.twig', array(
                    'entities' => $products,
                    'store' => $store,
        ));
    }

    /**
     * Creates a new Product entity.
     *
     */
    public function createAction(Request $request, $store_id) {
        $entity = new Product();
        $form = $this->createCreateForm($entity, $store_id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $store = $em->getRepository('ZeteqMarketBundle:Store')->find($store_id);
            $entity->setStore($store);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('storeadmin_product_edit', array('store_id' => $store_id, 'id' => $entity->getId())));
        }

        return $this->render('ZeteqMarketBundle:StoreAdminProduct:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Product entity.
     *
     * @param Product $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Product $entity, $store_id) {
        $form = $this->createForm(new ProductType($store_id), $entity, array(
            'action' => $this->generateUrl('storeadmin_product_create', array('store_id' => $store_id)),
            'method' => 'POST',
        ));



        return $form;
    }

    /**
     * Displays a form to create a new Product entity.
     *
     */
    public function newAction($store_id) {
        $entity = new Product();
        $entity->setEnabled(true);
        $form = $this->createCreateForm($entity, $store_id);
        $em = $this->getDoctrine()->getManager();
        $store = $em->getRepository('ZeteqMarketBundle:Store')->find($store_id);

        return $this->render('ZeteqMarketBundle:StoreAdminProduct:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
                    'store_id' => $store_id,
                    'store' => $store
        ));
    }

    /**
     * Finds and displays a Product entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZeteqMarketBundle:Product')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ZeteqMarketBundle:StoreAdminProduct:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),));
    }

    /**
     * Displays a form to edit an existing Product entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZeteqMarketBundle:Product')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }
        $user = $this->get('security.context')->getToken()->getUser();
        if ($entity->getStore()->getUser() != $user) {
            throw $this->createNotFoundException('You don\'t have access to this');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ZeteqMarketBundle:StoreAdminProduct:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
                    'store_id' => $entity->getStore()->getId(),
                    'store' => $entity->getStore()
        ));
    }

    /**
     * Creates a form to edit a Product entity.
     *
     * @param Product $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Product $entity) {
        $form = $this->createForm(new ProductType($entity->getStore()->getId()), $entity, array(
            'action' => $this->generateUrl('storeadmin_product_update', array('store_id' => $entity->getStore()->getId(), 'id' => $entity->getId())),
            'method' => 'PUT',
        ));



        return $form;
    }

    /**
     * Edits an existing Product entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZeteqMarketBundle:Product')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('storeadmin_product_edit', array('store_id' => $entity->getStore()->getId(), 'id' => $id)));
        }

        return $this->render('ZeteqMarketBundle:Product:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Product entity.
     *
     */
    public function deleteAction(Request $request, $id) {



        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('ZeteqMarketBundle:Product')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }
        $sid = $entity->getStore()->getId();
        $em->remove($entity);
        $em->flush();


        return $this->redirect($this->generateUrl('storeadmin_product', array('store_id' => $sid)));
    }

    /**
     * Creates a form to delete a Product entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('product_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm()
        ;
    }

}
