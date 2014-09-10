<?php

namespace CiudadTigre\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SubcategoriaType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
//            ->add('rutafoto')
//            ->add('createdAt')
//            ->add('updatedAt')
            ->add('promocionado')
            ->add('categoria')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CiudadTigre\AnuncianteBundle\Entity\Subcategoria'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ciudadtigre_backendbundle_subcategoria';
    }
}
