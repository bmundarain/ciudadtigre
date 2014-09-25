<?php
namespace CiudadTigre\BackendBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use CiudadTigre\AnuncianteBundle\Entity\Administrador;

class Usuarios extends AbstractFixture implements OrderedFixtureInterface,ContainerAwareInterface
{
    public function getOrder()
    {
        return 20;
    }
    
    private $container;
    
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
    
    public function load(ObjectManager $manager)
    {
        $usuario = new Administrador();
        $usuario->setNombre('Administrador');
        $usuario->setLogin('admin');
        $usuario->setSalt(md5(time()));
        $encoder = $this->container->get('security.encoder_factory')->getEncoder($usuario);

        $passwordEnClaro = 'qwerty';
        $passwordCodificado = $encoder->encodePassword(
            $passwordEnClaro,
            $usuario->getSalt()
        );
        
        $usuario->setPassword($passwordCodificado);

        $manager->persist($usuario);
        
        $manager->flush();
    }

}