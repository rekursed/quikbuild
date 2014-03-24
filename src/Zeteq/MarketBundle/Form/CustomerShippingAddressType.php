<?php

namespace Zeteq\MarketBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CustomerShippingAddressType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
  
            ->add('shipping_first_name')
            ->add('shipping_last_name')
            ->add('shipping_email')
            ->add('shipping_address')
            ->add('shipping_city')
            ->add('shipping_state')
            ->add('shipping_postalcode')
            ->add('shipping_country')
            ->add('shipping_phone')
            ->add('shipping_billing_same')

        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Zeteq\MarketBundle\Entity\Customer'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'zeteq_marketbundle_customer_shipping';
    }
}
