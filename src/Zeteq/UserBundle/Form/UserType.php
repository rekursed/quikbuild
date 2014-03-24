<?php

namespace Zeteq\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
      //      ->add('username')
     //       ->add('salt')
            ->add('email')
            ->add('salt','hidden')
            ->add('password','password')
           
            ->add('isActive')
            ->add('roles','genemu_jqueryselect2_entity', array(
                    'class' => 'ZeteqUserBundle:Role',
                    'property' => 'name',
                    'multiple' => true,
                ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Zeteq\UserBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'zeteq_userbundle_user';
    }
}
