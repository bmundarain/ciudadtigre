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
            //->add('direccion', 'textarea', array('attr' => array('class' => 'form-control')))
            ->add('avenida', 'text', array('attr' => array('class' => 'form-control'), 'label' => 'Calle/Avenida', 'required' => true))
            ->add('local', 'text', array('attr' => array('class' => 'form-control'), 'label' => 'Local/Edificio', 'required' => true))
            ->add('sector', 'text', array('attr' => array('class' => 'form-control'), 'required' => true))
            ->add('ciudad', 'text', array('attr' => array('class' => 'form-control'), 'required' => true))
            ->add('estado', 'text', array('attr' => array('class' => 'form-control'), 'required' => true))
            ->add('email', 'email', array('attr' => array('class' => 'form-control')))
            ->add('telefono1', 'text', array('attr' => array('class' => 'form-control'), 'required' => true))
            ->add('telefono2', 'text', array('required' => false, 'attr' => array('class' => 'form-control')))
            ->add('web', 'text', array('required' => false, 'attr' => array('class' => 'form-control')))
            ->add('facebook', 'text', array('required' => false, 'attr' => array('class' => 'form-control')))
            ->add('twitter', 'text', array('required' => false, 'attr' => array('class' => 'form-control')))
            ->add('hits', 'number', array('attr' => array('class' => 'form-control')))
            ->add('horario', 'textarea', array('attr' => array('class' => 'form-control'), 'required' => false))
            ->add('foto1', 'file', array('required' => false))
            ->add('foto2', 'file', array('required' => false))
            ->add('foto3', 'file', array('required' => false))
//            ->add('rutaimg1')
//            ->add('rutaimg2')
//            ->add('rutaimg3')
//            ->add('createdAt')
//            ->add('updatedAt')
            ->add('mapa', 'textarea', array('attr' => array('class' => 'form-control'), 'required' => false))
            ->add('habilitado', 'checkbox', array('required' => false, 'label' => 'Habilitado?'))
//            ->add('promocionado')
            ->add('subcategoria', 'entity', array(
                'class'       => 'CiudadTigreAnuncianteBundle:Subcategoria',
                'property'    => 'nombre',
                'empty_value' => 'Seleccione',
                'required'    => true,
                'attr'        => array('class' => 'form-control')
                ))
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
