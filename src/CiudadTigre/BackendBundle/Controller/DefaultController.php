<?php

namespace CiudadTigre\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

class DefaultController extends Controller
{   
    public function indexAction()
    {
        return $this->render('CiudadTigreBackendBundle:Default:index.html.twig');
    }
    
    public function loginAction(Request $peticion)
    {
        $sesion = $peticion->getSession();
        
        $error = $peticion->attributes->get(
            SecurityContext::AUTHENTICATION_ERROR,
            $sesion->get(SecurityContext::AUTHENTICATION_ERROR)
        );
        
        return $this->render('CiudadTigreBackendBundle:Default:login.html.twig', array(
            'last_username' => $sesion->get(SecurityContext::LAST_USERNAME),
            'error' => $error
        ));
        
    }
}
