<?php

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use CiudadTigre\AnuncianteBundle\Entity\Categoria;
use CiudadTigre\AnuncianteBundle\Entity\Subcategoria;
use CiudadTigre\AnuncianteBundle\Entity\Anunciante;

/**
 *
 * $ php app/console doctrine:fixtures:load --fixtures=app/Resources
 * 
 */
class Basico implements FixtureInterface, ContainerAwareInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
    
    public function load(ObjectManager $manager)
    {
        $categorias = array(
            array('nombre' => 'Alimentos', 'rutafoto' => 'bt-dir-alimentos.png'),
            array('nombre' => 'Computadoras', 'rutafoto' => 'bt-dir-computadoras.png'),
            array('nombre' => 'Mobiliario', 'rutafoto' => 'bt-dir-moviliarios.png'),
            array('nombre' => 'Animales y Plantas', 'rutafoto' => 'bt-dir-animalesplantas.png'),
            array('nombre' => 'Construcción', 'rutafoto' => 'bt-dir-construccion.png'),
            array('nombre' => 'Deportes', 'rutafoto' => 'bt-dir-deportes.png'),
        );
        foreach ($categorias as $categoria) {
            $entidad = new Categoria();
            $entidad->setNombre($categoria['nombre']);
            $entidad->setRutafoto($categoria['rutafoto']);

            $manager->persist($entidad);
        }

        $manager->flush();
        
        // Crear 3 subcategorias en cada categoria
        $categorias = $manager->getRepository('CiudadTigreAnuncianteBundle:Categoria')->findAll();
        $numSub = 0;
        foreach ($categorias as $categoria) {
            for ($i=1; $i<=3; $i++) {
                $numSub++;
                $subcategoria = new Subcategoria();
                $subcategoria->setNombre('Subcategoria #'.$numSub);
                $subcategoria->setCategoria($categoria);
    
                $manager->persist($subcategoria);
            }
        }
        $manager->flush();
        
        // Crear 10 anunciantes en cada categoria
        $categorias = $manager->getRepository('CiudadTigreAnuncianteBundle:Categoria')->findAll();
        $numAnunciante = 0;
        foreach ($categorias as $categoria) {
            $subcategorias = $manager->getRepository('CiudadTigreAnuncianteBundle:Subcategoria')->findByCategoria(
                $categoria->getId()
            );

            for ($i=1; $i<=20; $i++) {
                $numAnunciante++;
                
                $anunciante = new Anunciante();
                
                $anunciante->setNombre('Anunciante #'.$numAnunciante.' lorem ipsum dolor sit amet');
                $anunciante->setRif('J400999999');
                $anunciante->setDescripcion(
                    "Lorem ipsum dolor sit amet, consectetur adipisicing.\n"
                    ."Elit, sed do eiusmod tempor incididunt.\n"
                    ."Ut labore et dolore magna aliqua.\n"
                    ."Nostrud exercitation ullamco laboris nisi ut"
                );
                $anunciante->setDireccion(
                    "Avenida Libertador, entre 5ta carrera Sur Bis y Calle 17 Sur."
                );
                
                $anunciante->setEmail('anunciante'.$numAnunciante.'@localhost.com');
                $anunciante->setTelefono1('02129997766');
                $anunciante->setWeb('http://www.anunciante'.$numAnunciante.'.com');
                $anunciante->setTwitter('@anunciante'.$numAnunciante);
                $anunciante->setFacebook('anunciante'.$numAnunciante);
                $anunciante->setHits(0);
                $anunciante->setHorario(
                    "Lorem ipsum dolor sit amet, consectetur adipisicing.\n"
                    ."Elit, sed do eiusmod tempor incididunt.\n"
                    ."Ut labore et dolore magna aliqua.\n"
                    ."Nostrud exercitation ullamco laboris nisi ut"
                );
                $anunciante->setRutaimg1('foto.jpg');
                                
                // Seleccionar aleatoriamente una subcategoria que pertenezca a la categoria
                $anunciante->setSubcategoria($subcategorias[array_rand($subcategorias)]);
                
                $manager->persist($anunciante);
            }
        }
        $manager->flush();
    }
}