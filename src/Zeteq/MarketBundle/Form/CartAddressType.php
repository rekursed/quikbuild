<?php

namespace Zeteq\MarketBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CartAddressType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           ->add('billing_first_name','text',array('label'=>'First Name','required'=>true,'error_bubbling'=>true,'attr'=>array('oninvalid'=>"setCustomValidity('Please enter your first name!')")))
            ->add('billing_last_name','text',array('label'=>'Last Name','required'=>true))
            ->add('billing_email','email',array('label'=>'Email','required'=>true))
           ->add('billing_address','text',array('label'=>'Address','required'=>true))
            ->add('billing_city','text',array('label'=>'City','required'=>true))
            ->add('billing_state','text',array('label'=>'State','required'=>true))
            ->add('billing_postalcode','text',array('label'=>'Postal Code','required'=>true))

           //      ->add('billing_country', 'genemu_jqueryselect2_country')
                
            ->add('billing_phone','text',array('label'=>'Phone','required'=>true))
            ->add('shipping_first_name','text',array('label'=>'First Name','required'=>true))
            ->add('shipping_last_name','text',array('label'=>'Last Name','required'=>true))
            ->add('shipping_email','email',array('label'=>'Email','required'=>true))
            ->add('shipping_address','text',array('label'=>'Address','required'=>true))
            ->add('shipping_city','text',array('label'=>'City','required'=>true))
            ->add('shipping_state','text',array('label'=>'State','required'=>true))
            ->add('shipping_postalcode','text',array('label'=>'Postal Code','required'=>true))
                
                
          //  ->add('shipping_country','country',array('label'=>'Country','required'=>true))
            
                      
       //                         ->add('shipping_country', 'genemu_jqueryselect2_country')
                ->add('shipping_phone','text',array('label'=>'Phone','required'=>true))
            ->add('shipping_billing_same','checkbox',array('label'=>'Ship to the billing address','required'=>false))
            ->add('payment_method')
                ->add('shipping_method')

        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Zeteq\MarketBundle\Entity\Cart'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'zeteq_marketbundle_cart_address';
    }
}
