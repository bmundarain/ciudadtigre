<?php
namespace CiudadTigre\AnuncianteBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * AnuncianteRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AnuncianteRepository extends EntityRepository
{
    public function getAnunciantesByNombre($nombre)
    {
        $em = $this->getEntityManager();
        
        $consulta = $em->createQuery('
            SELECT a
              FROM CiudadTigreAnuncianteBundle:Anunciante a
             WHERE a.nombre LIKE :nombre');
        
        $consulta->setParameter('nombre', '%'.$nombre.'%');
        
        return $consulta->getResult();
    }
    
    public function getAnunciantesLetraInicial($letra)
    {
        $em = $this->getEntityManager();
        
        $consulta = $em->createQuery('
            SELECT a
              FROM CiudadTigreAnuncianteBundle:Anunciante a
             WHERE a.nombre LIKE :nombre');
        
        $consulta->setParameter('nombre', $letra.'%');
        
        return $consulta->getResult();
    }
    
    public function queryTodasLosAnunciantes()
    {
        $em = $this->getEntityManager();
        $consulta = $em->createQuery('
                SELECT a FROM CiudadTigreAnuncianteBundle:Anunciante a
              ORDER BY a.id ASC');
        
        return $consulta;
    }
    
    public function findTodasLosAnunciantes()
    {
        return $this->queryTodasLosAnunciantes()->getResult();
    }

}
