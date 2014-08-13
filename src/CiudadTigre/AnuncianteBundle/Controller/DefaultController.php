<?php

namespace CiudadTigre\AnuncianteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CiudadTigreAnuncianteBundle:Default:index.html.twig');
    }
}
