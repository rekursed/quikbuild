<?php

namespace Zeteq\MarketBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StoreType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('store_name')
                ->add('store_category')
                ->add('short_description')
                ->add('email','email')
                ->add('phone')
                ->add('web_address')
                ->add('facebook_page')
                ->add('twitter')
                ->add('google_plus')
                ->add('address')
                
                ->add('about_us')
                ->add('payments', 'ckeditor')
                ->add('shipping', 'ckeditor')
                ->add('returns_refunds', 'ckeditor')
                ->add('additional_policies', 'ckeditor')
                
                ->add('profile_image', 'file', array(
                    'required' => false,
                    'data_class' => null
                ))
                ->add('coverphoto_image', 'file', array(
                    'required' => false,
                    'data_class' => null
                ))


        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Zeteq\MarketBundle\Entity\Store'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'zeteq_marketbundle_store';
    }

}
