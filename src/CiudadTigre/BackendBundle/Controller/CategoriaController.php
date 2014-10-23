<?php

namespace CiudadTigre\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

use CiudadTigre\AnuncianteBundle\Entity\Categoria;
use CiudadTigre\BackendBundle\Form\CategoriaType;

/**
 * Categoria controller.
 *
 */
class CategoriaController extends Controller
{

    /**
     * Lists all Categoria entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CiudadTigreAnuncianteBundle:Categoria')->findAll();

        return $this->render('CiudadTigreBackendBundle:Categoria:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Categoria entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Categoria();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            
            $entity->subirFoto();
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            
            $this->get('session')->getFlashBag()->add('notice', 'Registro insertado!');

            return $this->redirect($this->generateUrl('categoria_show', array('id' => $entity->getId())));
        }
        else
        {
            $this->get('session')->getFlashBag()->add('error', $form->getErrorsAsString());
        }

        return $this->render('CiudadTigreBackendBundle:Categoria:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Categoria entity.
     *
     * @param Categoria $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Categoria $entity)
    {
        $form = $this->createForm(new CategoriaType(), $entity, array(
            'action' => $this->generateUrl('categoria_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Guardar'));

        return $form;
    }

    /**
     * Displays a form to create a new Categoria entity.
     *
     */
    public function newAction()
    {
        $entity = new Categoria();
        $form   = $this->createCreateForm($entity);

        return $this->render('CiudadTigreBackendBundle:Categoria:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Categoria entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CiudadTigreAnuncianteBundle:Categoria')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Categoria entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CiudadTigreBackendBundle:Categoria:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Categoria entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CiudadTigreAnuncianteBundle:Categoria')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Categoria entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CiudadTigreBackendBundle:Categoria:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Categoria entity.
    *
    * @param Categoria $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Categoria $entity)
    {
        $form = $this->createForm(new CategoriaType(), $entity, array(
            'action' => $this->generateUrl('categoria_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar'));

        return $form;
    }
    /**
     * Edits an existing Categoria entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CiudadTigreAnuncianteBundle:Categoria')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Categoria entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $rutaFotoOriginal = $editForm->getData()->getRutafoto();
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            
            if (null == $entity->getFoto()) {
                // La foto original no se modifica, recuperar su ruta
                $entity->setRutafoto($rutaFotoOriginal);
            } else {
                // La foto de la categoria se ha modificado
                $directorioFotos = $this->container->getParameter('directorio.imagenes.categoria');
                
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
            
            $this->get('session')->getFlashBag()->add('notice', 'Registro actualizado!');

            return $this->redirect($this->generateUrl('categoria_edit', array('id' => $id)));
        }
        
        $this->get('session')->getFlashBag()->add('error', $editForm->getErrorsAsString());

        return $this->render('CiudadTigreBackendBundle:Categoria:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Categoria entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CiudadTigreAnuncianteBundle:Categoria')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Categoria entity.');
            }
            
            $directorioFotos = $this->container->getParameter('directorio.imagenes.categoria');
            
            try {
                $em->remove($entity);
                $em->flush();
                
            } catch (\Exception $e) {
                $this->get('session')->getFlashBag()->add('error', 'Ocurrió un error. Es posible que esté intentando borrar una Categoria que posee Subcategorias asociadas. Comuníquese con el Administrador del sistema.');
                //$e->getMessage();
                return $this->redirect($this->getRequest()->headers->get('referer'));
            }

            $this->get('session')->getFlashBag()->add('notice', 'Registro borrado!');
            
            // Borrar la foto
            $fs = new Filesystem();
            try {
                $fs->remove($directorioFotos.$entity->getRuta());
            } catch (IOExceptionInterface $e) {
                echo "Ocurrió un error borrando la imagen en ".$e->getPath();
            }
            
        } else {
            $this->get('session')->getFlashBag()->add('error', $form->getErrorsAsString());
        }

        return $this->redirect($this->generateUrl('categoria'));
    }

    /**
     * Creates a form to delete a Categoria entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('categoria_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar'))
            ->getForm()
        ;
    }
}
