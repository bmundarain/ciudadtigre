<?php

namespace CiudadTigre\AnuncianteBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * CategoriaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CategoriaRepository extends EntityRepository
{
    public function findCategorias()
    {
        $em = $this->getEntityManager();
        
        $consulta = $em->createQuery('
                SELECT c, s
                  FROM CiudadTigreAnuncianteBundle:Subcategoria c
                  JOIN c.categoria s');
        
        return $consulta->getResult();
    }
    
    public function getCategoriasLetraInicial($letra)
    {
        $em = $this->getEntityManager();
        
        $consulta = $em->createQuery('
            SELECT a
              FROM CiudadTigreAnuncianteBundle:Categoria a
             WHERE a.nombre LIKE :nombre');
        
        $consulta->setParameter('nombre', $letra.'%');
        
        return $consulta->getResult();
    }
}
