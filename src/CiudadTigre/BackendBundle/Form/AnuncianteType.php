<?php

namespace CiudadTigre\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AnuncianteType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('rif')
            ->add('descripcion')
            ->add('direccion')
            ->add('email')
            ->add('telefono1')
            ->add('telefono2')
            ->add('web')
            ->add('facebook')
            ->add('twitter')
            ->add('hits')
            ->add('horario')
            ->add('foto1', 'file', array('required' => true))
            ->add('foto2', 'file', array('required' => false))
            ->add('foto3', 'file', array('required' => false))
//            ->add('rutaimg1')
//            ->add('rutaimg2')
//            ->add('rutaimg3')
//            ->add('createdAt')
//            ->add('updatedAt')
            ->add('mapa')
//            ->add('promocionado')
            ->add('subcategoria')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CiudadTigre\AnuncianteBundle\Entity\Anunciante'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ciudadtigre_backendbundle_anunciante';
    }
}
