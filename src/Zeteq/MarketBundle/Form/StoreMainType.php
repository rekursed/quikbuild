<?php

namespace Zeteq\MarketBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StoreMainType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                     
                  ->add('store_name')
                 ->add('slug') 
                 ->add('user','genemu_jqueryselect2_entity', array(
                    'class' => 'ZeteqUserBundle:User',
                    'property' => 'email',
                    'multiple' => false,
                ))
                ->add('web_address')
                 ->add('facebook_page')
                 ->add('twitter')
                 ->add('google_plus')
                ->add('email')
                ->add('phone')
                ->add('address')
                ->add('short_description')
                ->add('description','ckeditor')
                
                ->add('store_category', 'genemu_jqueryselect2_entity', array(
                    'class' => 'ZeteqMarketBundle:StoreCategory',
                    'property' => 'name',
                    'multiple' => false,
                ))
                ->add('use_store_layout')
                ->add('use_site_layout')
                ->add('approved')    
                ->add('enabled')
          ->add('profile_image', 'file', array(
            'required'=>false,
            'data_class' => null
        ))
                
           ->add('coverphoto_image', 'file', array(
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
            'data_class' => 'Zeteq\MarketBundle\Entity\Store'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'zeteq_marketbundle_store';
    }
}
