<?php

namespace CiudadTigre\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

use CiudadTigre\AnuncianteBundle\Entity\Anunciante;
use CiudadTigre\BackendBundle\Form\AnuncianteType;

/**
 * Anunciante controller.
 *
 */
class AnuncianteController extends Controller
{

    /**
     * Lists all Anunciante entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $paginador = $this->get('ideup.simple_paginator');
        $paginador->setItemsPerPage(20);
        $paginador->setMaxPagerItems(5);
        
        $entities = $paginador->paginate($em->getRepository('CiudadTigreAnuncianteBundle:Anunciante')->queryTodasLosAnunciantes())->getResult();
        
        return $this->render('CiudadTigreBackendBundle:Anunciante:index.html.twig', array(
            'entities' => $entities,
            'paginador' => $paginador
        ));
        
        

//        $entities = $em->getRepository('CiudadTigreAnuncianteBundle:Anunciante')->findAll();
//
//        return $this->render('CiudadTigreBackendBundle:Anunciante:index.html.twig', array(
//            'entities' => $entities,
//        ));
    }
    /**
     * Creates a new Anunciante entity.
     *
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $entity = new Anunciante();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            
            $directorioFotos = $this->container->getParameter('directorio.imagenes.anunciante');
            $entity->subirFoto1($directorioFotos);
            $entity->subirFoto2($directorioFotos);
            $entity->subirFoto3($directorioFotos);
            
            $em->persist($entity);
            $em->flush();
            
            $this->get('session')->getFlashBag()->add('notice', 'Registro insertado!');

            return $this->redirect($this->generateUrl('anunciante_show', array('id' => $entity->getId())));
        }
        else
        {
            $this->get('session')->getFlashBag()->add('error', $form->getErrorsAsString());
        }

        return $this->render('CiudadTigreBackendBundle:Anunciante:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Anunciante entity.
     *
     * @param Anunciante $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Anunciante $entity)
    {
        $form = $this->createForm(new AnuncianteType(), $entity, array(
            'action' => $this->generateUrl('anunciante_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Guardar'));

        return $form;
    }

    /**
     * Displays a form to create a new Anunciante entity.
     *
     */
    public function newAction()
    {
        $entity = new Anunciante();
        $form   = $this->createCreateForm($entity);

        return $this->render('CiudadTigreBackendBundle:Anunciante:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Anunciante entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CiudadTigreAnuncianteBundle:Anunciante')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Anunciante entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CiudadTigreBackendBundle:Anunciante:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Anunciante entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CiudadTigreAnuncianteBundle:Anunciante')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Anunciante entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CiudadTigreBackendBundle:Anunciante:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'errors'      => '',
        ));
    }

    /**
    * Creates a form to edit a Anunciante entity.
    *
    * @param Anunciante $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Anunciante $entity)
    {
        $form = $this->createForm(new AnuncianteType(), $entity, array(
            'action' => $this->generateUrl('anunciante_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar'));

        return $form;
    }
    /**
     * Edits an existing Anunciante entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CiudadTigreAnuncianteBundle:Anunciante')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Anunciante entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $rutaFotoOriginal1 = $editForm->getData()->getRutaimg1();
        $rutaFotoOriginal2 = $editForm->getData()->getRutaimg2();
        $rutaFotoOriginal3 = $editForm->getData()->getRutaimg3();
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            
            if (null == $entity->getFoto1()) {
                // La foto original no se modifica, recuperar su ruta
                $entity->setRutaimg1($rutaFotoOriginal1);
            } else {
                // La foto de la oferta se ha modificado
                $directorioFotos = $this->container->getParameter('directorio.imagenes.anunciante');
                
                $entity->subirFoto1($directorioFotos);
                // Borrar la foto anterior
                if (!empty($rutaFotoOriginal1)) {
                    $fs = new Filesystem();
                                        
                    try {
                        $fs->remove($directorioFotos.$rutaFotoOriginal1);
                    } catch (IOExceptionInterface $e) {
                        echo "Ocurrió un error actualizando la imagen en ".$e->getPath();
                    }
                }
            }
            
            if (null == $entity->getFoto2()) {
                // La foto original no se modifica, recuperar su ruta
                $entity->setRutaimg2($rutaFotoOriginal2);
            } else {
                // La foto de la oferta se ha modificado
                $directorioFotos = $this->container->getParameter('directorio.imagenes.anunciante');
                
                $entity->subirFoto2($directorioFotos);
                // Borrar la foto anterior
                if (!empty($rutaFotoOriginal2)) {
                    $fs = new Filesystem();
                    
                    try {
                        $fs->remove($directorioFotos.$rutaFotoOriginal2);
                    } catch (IOExceptionInterface $e) {
                        echo "Ocurrió un error actualizando la imagen en ".$e->getPath();
                    }
                }
            }
            
            if (null == $entity->getFoto3()) {
                // La foto original no se modifica, recuperar su ruta
                $entity->setRutaimg3($rutaFotoOriginal3);
            } else {
                // La foto de la oferta se ha modificado
                $directorioFotos = $this->container->getParameter('directorio.imagenes.anunciante');
                
                $entity->subirFoto3($directorioFotos);
                // Borrar la foto anterior
                if (!empty($rutaFotoOriginal3)) {
                    $fs = new Filesystem();
                    
                    try {
                        $fs->remove($directorioFotos.$rutaFotoOriginal3);
                    } catch (IOExceptionInterface $e) {
                        echo "Ocurrió un error actualizando la imagen en ".$e->getPath();
                    }
                }
            }
            
            $em->flush();
            
            $this->get('session')->getFlashBag()->add('notice', 'Registro actualizado!');

            return $this->redirect($this->generateUrl('anunciante_edit', array('id' => $id)));
        }
        
        $this->get('session')->getFlashBag()->add('error', $editForm->getErrorsAsString());

        return $this->render('CiudadTigreBackendBundle:Anunciante:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Anunciante entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CiudadTigreAnuncianteBundle:Anunciante')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Anunciante entity.');
            }

            $em->remove($entity);
            $em->flush();
            
            $this->get('session')->getFlashBag()->add('notice', 'Registro borrado!');
            
            $directorioFotos = $this->container->getParameter('directorio.imagenes.anunciante');
            
            // Borrar la foto
            $fs = new Filesystem();
            try {
                $fs->remove($directorioFotos.$entity->getRutaimg1());
                $fs->remove($directorioFotos.$entity->getRutaimg2());
                $fs->remove($directorioFotos.$entity->getRutaimg3());
            } catch (IOExceptionInterface $e) {
                echo "Ocurrió un error borrando laa imágenes en ".$e->getPath();
            }
        }
        else
        {
            $this->get('session')->getFlashBag()->add('error', $form->getErrorsAsString());
        }

        return $this->redirect($this->generateUrl('anunciante'));
    }

    /**
     * Creates a form to delete a Anunciante entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('anunciante_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar'))
            ->getForm()
        ;
    }
    
    public function filtrarAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $peticion = $this->getRequest();
        
        $paginador = $this->get('ideup.simple_paginator');
        $paginador->setItemsPerPage(20);
        $paginador->setMaxPagerItems(5);
        
        $entities = $paginador->paginate($em->getRepository('CiudadTigreAnuncianteBundle:Anunciante')->queryAnunciantesByNombre($peticion->get("nombre")))->getResult();
        
        return $this->render('CiudadTigreBackendBundle:Anunciante:index.html.twig', array(
            'entities' => $entities,
            'paginador' => $paginador
        ));
        
    }
}
