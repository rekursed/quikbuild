<?php

namespace Zeteq\MarketBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductMainType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
                   ->add('slug')
                   ->add('price')
                   ->add('clearance')
                   ->add('clearance_price')
                ->add('store', 'genemu_jqueryselect2_entity', array(
                    'class' => 'ZeteqMarketBundle:Store',
                    'property' => 'store_name',
                    'multiple' => false,
                ))
                ->add('enabled')
               ->add('approved')
                ->add('description','ckeditor')
                ->add('additional_info','ckeditor')
                ->add('related_products', 'genemu_jqueryselect2_entity', array(
                    'class' => 'ZeteqMarketBundle:Product',
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
                    'property' => 'name',
                    'multiple' => true,
                ))
   
                ->add('image', 'file', array(
            'required'=>false,
            'data_class' => null
        ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Zeteq\MarketBundle\Entity\Product'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'zeteq_marketbundle_product_main';
    }

}
