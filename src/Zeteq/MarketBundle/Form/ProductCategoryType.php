<?php

namespace Zeteq\MarketBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductCategoryType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name')
                ->add('slug')
                ->add('enabled')
                ->add('description', 'ckeditor')
                ->add('is_parent')
                ->add('parent', 'genemu_jqueryselect2_entity', array(
                    'class' => 'ZeteqMarketBundle:ProductCategory',
                    'property' => 'name',
                    'multiple' => false,
                    'required' => false
                ))
                ->add('image')
                ->add('image_path')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Zeteq\MarketBundle\Entity\ProductCategory'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'zeteq_marketbundle_productcategory';
    }

}
