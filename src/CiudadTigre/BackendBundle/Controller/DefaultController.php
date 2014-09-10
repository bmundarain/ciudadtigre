<?php

namespace CiudadTigre\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{   
    public function indexAction()
    {
        return $this->render('CiudadTigreBackendBundle:Default:index.html.twig');
    }
}
