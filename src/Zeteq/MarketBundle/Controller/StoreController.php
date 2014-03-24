<?php

namespace Zeteq\MarketBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Zeteq\MarketBundle\Entity\Store;
use Zeteq\MarketBundle\Form\StoreMainType;


 
use APY\DataGridBundle\Grid\Source\Entity;
use APY\DataGridBundle\Grid\Export\ExcelExport;
use APY\DataGridBundle\Grid\Action\RowAction;
use APY\DataGridBundle\Grid\Action\MassAction;
use APY\DataGridBundle\Grid\Action\DeleteMassAction;
/**
 * Store controller.
 *
 */
class StoreController extends Controller
{

            
    public function read_excelAction(Request $request){
        
              $em = $this->getDoctrine()->getManager();
 
   
        
                $target_path =  $this->get('kernel')->getRootDir(). '/../public_html/upload/store_excel/';
        $target_path = $target_path. basename( $_FILES['uploadedfile']['name']);
              if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
                  
                  
                  $row = 1;
if (($handle = fopen($target_path, "r")) !== FALSE) {
    
    
    
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
//        if($row > 1){
        
        
        $num = count($data);
$store = new Store();
        $row++;
        $ar = array();
        for ($c=0; $c < $num; $c++) {
          
$ar[$c] =             $data[$c] ;
        }
            $store->setStoreName('Demo Store '.$ar[0]) ;
            $store->setUser($this->get('security.context')->getToken()->getUser());
            $store->setEmail('info@test.com');
            $store->setPhone('23434');
                $store->setShortDescription($ar[1]);
                
                $cat = $em->getRepository('ZeteqMarketBundle:StoreCategory')->find($ar[2]);
                $store->setStoreCategory( $cat );            
                $store->setProfileImagePath('profile_'.$ar[3].'.jpg');
                $store->setCoverphotoPath('cover_'.$ar[4].'.jpg');
                

      //      $product->addCategorie($cat);
       //     $product->addStoreProductCategorie($scat);
                    
        
        $em->persist($store);
        $em->flush();
    
        
        
//}


        }
    fclose($handle);
    unlink($target_path);
}
                  
                  
              }
              
           return $this->redirect($this->generateUrl('store' ));
              
    }
  
         
       public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $source = new Entity('ZeteqMarketBundle:Store');
        $grid = $this->get('grid');
        $grid->setSource($source);
        $grid->setLimits(array(10,25,50,100,1000));
        $title= "excel";
        $fileName = "pages.xls";
        $grid->addExport(new ExcelExport($title, $fileName));

        
        $rowActionDelete = new RowAction('delete', 'store_delete',true);   
        $rowAction = new RowAction('edit', 'store_edit');



 
        $grid->addRowAction($rowAction);    
        $grid->addRowAction($rowActionDelete);    

        $callback = 'ZeteqMarketBundle\StoreController::delete';
        $grid->addMassAction(new DeleteMassAction());
    $grid->hideColumns(array(
        
    'description','slug','web_address','email','phone','address','facebook_page','twitter','google_plus',
        
        'short_description','use_store_layout','use_site_layout','profile_image_path','profile_image','coverphoto_path','coverphoto_image' ));





        $grid->isReadyForRedirect();
        
        
return $grid->getGridResponse('ZeteqMarketBundle:Store:indexapy.html.twig');
 
    }   
    /**
     * Lists all Store entities.
     *
     */
    public function index1Action()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ZeteqMarketBundle:Store')->findAll();

        return $this->render('ZeteqMarketBundle:Store:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Store entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Store();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('store_edit', array('id' => $entity->getId())));
        }

        return $this->render('ZeteqMarketBundle:Store:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Store entity.
    *
    * @param Store $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Store $entity)
    {
        $form = $this->createForm(new StoreMainType(), $entity, array(
            'action' => $this->generateUrl('store_create'),
            'method' => 'POST',
        ));
    

        return $form;
    }

    /**
     * Displays a form to create a new Store entity.
     *
     */
    public function newAction()
    {
          $user = $this->get('security.context')->getToken()->getUser();
        $entity = new Store();
        $entity->setUser($user);
        $form   = $this->createCreateForm($entity);

        return $this->render('ZeteqMarketBundle:Store:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Store entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZeteqMarketBundle:Store')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Store entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ZeteqMarketBundle:Store:show.html.twig', array(
            'store'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Store entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZeteqMarketBundle:Store')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Store entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ZeteqMarketBundle:Store:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Store entity.
    *
    * @param Store $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Store $entity)
    {
        $form = $this->createForm(new StoreMainType(), $entity, array(
            'action' => $this->generateUrl('store_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));     

        return $form;
    }
    /**
     * Edits an existing Store entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZeteqMarketBundle:Store')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Store entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('store_edit', array('id' => $id)));
        }

        return $this->render('ZeteqMarketBundle:Store:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Store entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
 
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ZeteqMarketBundle:Store')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Store entity.');
            }

            $em->remove($entity);
            $em->flush();
 

        return $this->redirect($this->generateUrl('store'));
    }

    /**
     * Creates a form to delete a Store entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('store_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
