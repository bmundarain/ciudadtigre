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
            //->add('nombre', 'text', array('attr' => array('class' => 'form-control')))
            ->add('nombre', 'text', array('attr' => array('class' => 'form-control')))
            ->add('rif', 'text', array('attr' => array('class' => 'form-control')))
            ->add('descripcion', 'textarea', array('attr' => array('class' => 'form-control')))
            ->add('direccion', 'textarea', array('attr' => array('class' => 'form-control')))
            ->add('email', 'email', array('attr' => array('class' => 'form-control')))
            ->add('telefono1', 'number', array('attr' => array('class' => 'form-control')))
            ->add('telefono2', 'number', array('required' => false, 'attr' => array('class' => 'form-control')))
            ->add('web', 'url', array('attr' => array('class' => 'form-control')))
            ->add('facebook', 'text', array('attr' => array('class' => 'form-control')))
            ->add('twitter', 'text', array('attr' => array('class' => 'form-control')))
            ->add('hits', 'number', array('attr' => array('class' => 'form-control')))
            ->add('horario', 'textarea', array('attr' => array('class' => 'form-control')))
            ->add('foto1', 'file', array('required' => true))
            ->add('foto2', 'file', array('required' => false))
            ->add('foto3', 'file', array('required' => false))
//            ->add('rutaimg1')
//            ->add('rutaimg2')
//            ->add('rutaimg3')
//            ->add('createdAt')
//            ->add('updatedAt')
            ->add('mapa', 'textarea', array('attr' => array('class' => 'form-control')))
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
