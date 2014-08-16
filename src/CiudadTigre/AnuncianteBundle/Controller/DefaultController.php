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
}
