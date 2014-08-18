<?php

namespace CiudadTigre\AnuncianteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->get('doctrine.orm.entity_manager');
        
        //$categorias = $em->getRepository('CiudadTigreAnuncianteBundle:Categoria')->findCategorias();
        $categorias = $em->getRepository('CiudadTigreAnuncianteBundle:Categoria')->findAll();
        
        return $this->render(
                    'CiudadTigreAnuncianteBundle:Default:index.html.twig', array(
                    'categorias' => $categorias
        ));
    }
    
    public function mostrarSubcategoriaAction($id)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        
        $subcategorias = $em->getRepository('CiudadTigreAnuncianteBundle:Subcategoria')->findByCategoria($id);
        
        return $this->render(
                    'CiudadTigreAnuncianteBundle:Default:subcategoria.html.twig', array(
                    'subcategorias' => $subcategorias
        ));
    }
    
    public function mostrarAnuncianteAction($id)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        
        $anunciantes = $em->getRepository('CiudadTigreAnuncianteBundle:Anunciante')->findBySubcategoria($id);
        
        return $this->render(
                    'CiudadTigreAnuncianteBundle:Default:anunciantes.html.twig', array(
                    'anunciantes' => $anunciantes
        ));
    }
    
    public function detalleAnuncianteAction($id)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        
        $anunciante = $em->getRepository('CiudadTigreAnuncianteBundle:Anunciante')->findOneById($id);
        
        return $this->render(
                    'CiudadTigreAnuncianteBundle:Default:detalle_anunciante.html.twig', array(
                    'anunciante' => $anunciante
        ));
    }
    
    public function buscarAnuncianteAction()
    {
        $peticion = $this->getRequest();
        $em = $this->get('doctrine.orm.entity_manager');

        $anunciantes = $em->getRepository('CiudadTigreAnuncianteBundle:Anunciante')->getAnunciantesByNombre($peticion->get("buscar"));
        
        return $this->render(
                    'CiudadTigreAnuncianteBundle:Default:anunciantes.html.twig', array(
                    'anunciantes' => $anunciantes
        ));
        
    }
    
    public function buscarLetraAction($letter)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        
        $categorias = $em->getRepository('CiudadTigreAnuncianteBundle:Categoria')->getCategoriasLetraInicial($letter);
        $anunciantes = $em->getRepository('CiudadTigreAnuncianteBundle:Anunciante')->getAnunciantesLetraInicial($letter);
        
        return $this->render(
                    'CiudadTigreAnuncianteBundle:Default:listado_letrainicial.html.twig', array(
                    'categorias' => $categorias,
                    'anunciantes' => $anunciantes,
        ));
    }
}
