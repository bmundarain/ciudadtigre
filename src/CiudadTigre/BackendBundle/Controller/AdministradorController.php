<?php

namespace CiudadTigre\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use CiudadTigre\AnuncianteBundle\Entity\Administrador;
use CiudadTigre\BackendBundle\Form\AdministradorType;

/**
 * Administrador controller.
 *
 */
class AdministradorController extends Controller
{

    /**
     * Lists all Administrador entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CiudadTigreAnuncianteBundle:Administrador')->findAdministrador();

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Administrador entity.');
        }
        
        return $this->redirect($this->generateUrl('administrador_show', array('id' => $entity->getId())));
        
        /*$em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CiudadTigreAnuncianteBundle:Administrador')->findAll();

        return $this->render('CiudadTigreBackendBundle:Administrador:index.html.twig', array(
            'entities' => $entities,
        ));*/
    }
    /**
     * Creates a new Administrador entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Administrador();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('administrador_show', array('id' => $entity->getId())));
        }

        return $this->render('CiudadTigreBackendBundle:Administrador:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Administrador entity.
     *
     * @param Administrador $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Administrador $entity)
    {
        $form = $this->createForm(new AdministradorType(), $entity, array(
            'action' => $this->generateUrl('administrador_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Administrador entity.
     *
     */
    public function newAction()
    {
        $entity = new Administrador();
        $form   = $this->createCreateForm($entity);

        return $this->render('CiudadTigreBackendBundle:Administrador:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Administrador entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CiudadTigreAnuncianteBundle:Administrador')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Administrador entity.');
        }

        //$deleteForm = $this->createDeleteForm($id);

        return $this->render('CiudadTigreBackendBundle:Administrador:show.html.twig', array(
            'entity'      => $entity,
            //'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Administrador entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CiudadTigreAnuncianteBundle:Administrador')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Administrador entity.');
        }

        $editForm = $this->createEditForm($entity);
        //$deleteForm = $this->createDeleteForm($id);

        return $this->render('CiudadTigreBackendBundle:Administrador:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            //'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Administrador entity.
    *
    * @param Administrador $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Administrador $entity)
    {
        $form = $this->createForm(new AdministradorType(), $entity, array(
            'action' => $this->generateUrl('administrador_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Guardar'));

        return $form;
    }
    /**
     * Edits an existing Administrador entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CiudadTigreAnuncianteBundle:Administrador')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Administrador entity.');
        }

        //$deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            
            $entity->setSalt(md5(time()));

            $encoder = $this->get('security.encoder_factory')->getEncoder($entity);
            $passwordCodificado = $encoder->encodePassword(
                $entity->getPassword(),
                $entity->getSalt()
            );
            $entity->setPassword($passwordCodificado);

            $em->flush();
            
            $this->get('session')->getFlashBag()->add('notice', 'Password actualizado!');

            return $this->redirect($this->generateUrl('administrador_edit', array('id' => $id)));
        }

        return $this->render('CiudadTigreBackendBundle:Administrador:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            //'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Administrador entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CiudadTigreAnuncianteBundle:Administrador')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Administrador entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('administrador'));
    }

    /**
     * Creates a form to delete a Administrador entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('administrador_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
