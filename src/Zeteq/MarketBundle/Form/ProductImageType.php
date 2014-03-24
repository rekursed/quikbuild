<?php

namespace Zeteq\MarketBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductImageType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
         //   ->add('name')
           // ->add('description')
         //   ->add('image_path')
            ->add('image')
          //  ->add('product')
          //  ->add('save_and_add', 'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Zeteq\MarketBundle\Entity\ProductImage'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'zeteq_marketbundle_productimage';
    }
}
