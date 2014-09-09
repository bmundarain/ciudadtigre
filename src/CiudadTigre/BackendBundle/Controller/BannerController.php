<?php

namespace CiudadTigre\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

use CiudadTigre\AnuncianteBundle\Entity\Banner;
use CiudadTigre\BackendBundle\Form\BannerType;

/**
 * Banner controller.
 *
 */
class BannerController extends Controller
{

    /**
     * Lists all Banner entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CiudadTigreAnuncianteBundle:Banner')->findAll();

        return $this->render('CiudadTigreBackendBundle:Banner:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Banner entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Banner();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            
            //$directorioFotos = $this->container->getParameter('directorio.imagenes.banner');
            $entity->subirFoto();
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('banner_show', array('id' => $entity->getId())));
        }

        return $this->render('CiudadTigreBackendBundle:Banner:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Banner entity.
     *
     * @param Banner $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Banner $entity)
    {
        $form = $this->createForm(new BannerType(), $entity, array(
            'action' => $this->generateUrl('banner_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Banner entity.
     *
     */
    public function newAction()
    {
        $entity = new Banner();
        $form   = $this->createCreateForm($entity);

        return $this->render('CiudadTigreBackendBundle:Banner:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Banner entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CiudadTigreAnuncianteBundle:Banner')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Banner entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CiudadTigreBackendBundle:Banner:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Banner entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CiudadTigreAnuncianteBundle:Banner')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Banner entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CiudadTigreBackendBundle:Banner:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Banner entity.
    *
    * @param Banner $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Banner $entity)
    {
        $form = $this->createForm(new BannerType(), $entity, array(
            'action' => $this->generateUrl('banner_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Banner entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CiudadTigreAnuncianteBundle:Banner')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Banner entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $rutaFotoOriginal = $editForm->getData()->getRuta();
        $editForm->handleRequest($request);
        
        if ($editForm->isValid()) {
            
            if (null == $entity->getFoto()) {
                // La foto original no se modifica, recuperar su ruta
                $entity->setRuta($rutaFotoOriginal);
            } else {
                // La foto de la oferta se ha modificado
                $directorioFotos = $this->container->getParameter('directorio.imagenes.banner');
                
                $entity->subirFoto();
                // Borrar la foto anterior
                if (!empty($rutaFotoOriginal)) {
                    $fs = new Filesystem();
                    try {
                        $fs->remove($directorioFotos.$rutaFotoOriginal);
                    } catch (IOExceptionInterface $e) {
                        echo "Ocurrió un error actualizando la imagen en ".$e->getPath();
                    }
                }
            }
            
            $em->flush();

            return $this->redirect($this->generateUrl('banner_edit', array('id' => $id)));
        }
        
        return $this->render('CiudadTigreBackendBundle:Banner:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Banner entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CiudadTigreAnuncianteBundle:Banner')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Banner entity.');
            }
            
            $directorioFotos = $this->container->getParameter('directorio.imagenes.banner');

            $em->remove($entity);
            $em->flush();
            
            // Borrar la foto
            $fs = new Filesystem();
            try {
                $fs->remove($directorioFotos.$entity->getRuta());
            } catch (IOExceptionInterface $e) {
                echo "Ocurrió un error borrando la imagen en ".$e->getPath();
            }
        }

        return $this->redirect($this->generateUrl('banner'));
    }

    /**
     * Creates a form to delete a Banner entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('banner_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
