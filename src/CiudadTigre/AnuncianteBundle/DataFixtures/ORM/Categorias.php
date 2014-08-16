<?php
namespace CiudadTigre\AnuncianteBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CiudadTigre\AnuncianteBundle\Entity\Categoria;

class Categorias implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $categorias = array(
            array('nombre' => 'Alimentos', 'rutafoto' => 'bt-dir-alimentos.png'),
            array('nombre' => 'Computadoras', 'rutafoto' => 'bt-dir-computadoras.png'),
            array('nombre' => 'Mobiliario', 'rutafoto' => 'bt-dir-moviliarios.png'),
        );
        foreach ($categorias as $categoria) {
            $entidad = new Categoria();
            $entidad->setNombre($categoria['nombre']);
            $entidad->setRutafoto($categoria['rutafoto']);
            $entidad->setCreatedAt('2014-08-20 00:00:00');
            $entidad->setUpdatedAt('2014-08-20 00:00:00');

            $manager->persist($entidad);
        }
        
        $manager->flush();
    }

}