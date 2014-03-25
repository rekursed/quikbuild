<?php

namespace Zeteq\MarketBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Zeteq\MarketBundle\Entity\StoreProductCategoryRepository;
use Zeteq\MarketBundle\Entity\ProductRepository;

class ProductType extends AbstractType {

    /**
     * @var string
     */
    private $store;

    public function __construct($store) {
        $this->store = $store;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $store = $this->store;

        $builder
                ->add('name')
                ->add('price')
                ->add('enabled')
                ->add('meta_description')
                ->add('meta_keywords')
                ->add('description', 'ckeditor')
                
                ->add('additional_info','ckeditor')
  
                            
                            
                ->add('related_products', 'genemu_jqueryselect2_entity', array(
                    'class' => 'ZeteqMarketBundle:Product',
                    'query_builder' => function(ProductRepository $er) use ($store) {
                        return $er->findByStore($store);
                    },
                    'property' => 'name',
                    'multiple' => true,
                ))
                ->add('categories', 'genemu_jqueryselect2_entity', array(
                    'class' => 'ZeteqMarketBundle:ProductCategory',
                    'property' => 'name',
                    'multiple' => true,
                ))
                ->add('store_product_categories', 'genemu_jqueryselect2_entity', array(
                    'class' => 'ZeteqMarketBundle:StoreProductCategory',
                    'query_builder' => function(StoreProductCategoryRepository $er) use ($store) {
                        return $er->findByStore($store);
                    },
                    'property' => 'name',
                    'multiple' => true,
                ))
                ->add('image', 'file', array(
                    'required' => false,
                    'data_class' => null
                ))
                ->add('product_images', 'collection', array(
                    'type' => new ProductImageType(),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => false,
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Zeteq\MarketBundle\Entity\Product'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'zeteq_marketbundle_product';
    }

}
