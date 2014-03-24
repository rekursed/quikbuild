<?php

namespace Zeteq\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegisterUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

                  ->add('email')

            ->add('salt','hidden')
            ->add('password','password')
//                ->add('groups')
          


                
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Zeteq\UserBundle\Entity\User'
        ));
    }

    public function getName()
    {
        return 'Zeteq_userbundle_registerusertype';
    }
}
