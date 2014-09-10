<?php

namespace CiudadTigre\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use CiudadTigre\AnuncianteBundle\Entity\Subcategoria;
use CiudadTigre\BackendBundle\Form\SubcategoriaType;

/**
 * Subcategoria controller.
 *
 */
class SubcategoriaController extends Controller
{

    /**
     * Lists all Subcategoria entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CiudadTigreAnuncianteBundle:Subcategoria')->findAll();

        return $this->render('CiudadTigreBackendBundle:Subcategoria:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Subcategoria entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Subcategoria();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('subcategoria_show', array('id' => $entity->getId())));
        }

        return $this->render('CiudadTigreBackendBundle:Subcategoria:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Subcategoria entity.
     *
     * @param Subcategoria $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Subcategoria $entity)
    {
        $form = $this->createForm(new SubcategoriaType(), $entity, array(
            'action' => $this->generateUrl('subcategoria_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Subcategoria entity.
     *
     */
    public function newAction()
    {
        $entity = new Subcategoria();
        $form   = $this->createCreateForm($entity);

        return $this->render('CiudadTigreBackendBundle:Subcategoria:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Subcategoria entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CiudadTigreAnuncianteBundle:Subcategoria')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Subcategoria entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CiudadTigreBackendBundle:Subcategoria:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Subcategoria entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CiudadTigreAnuncianteBundle:Subcategoria')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Subcategoria entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CiudadTigreBackendBundle:Subcategoria:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Subcategoria entity.
    *
    * @param Subcategoria $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Subcategoria $entity)
    {
        $form = $this->createForm(new SubcategoriaType(), $entity, array(
            'action' => $this->generateUrl('subcategoria_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Subcategoria entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CiudadTigreAnuncianteBundle:Subcategoria')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Subcategoria entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('subcategoria_edit', array('id' => $id)));
        }

        return $this->render('CiudadTigreBackendBundle:Subcategoria:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Subcategoria entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CiudadTigreAnuncianteBundle:Subcategoria')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Subcategoria entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('subcategoria'));
    }

    /**
     * Creates a form to delete a Subcategoria entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('subcategoria_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
