<?php

namespace Zeteq\FrontBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class HomeSlideImageType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('sort')
            ->add('enabled')
            ->add('body','ckeditor')
            ->add('image_path')
            ->add('image')
            ->add('galleries')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Zeteq\FrontBundle\Entity\HomeSlideImage'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'zeteq_frontbundle_homeslideimage';
    }
}
