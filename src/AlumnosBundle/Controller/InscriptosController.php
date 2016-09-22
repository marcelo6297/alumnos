<?php

namespace AlumnosBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AlumnosBundle\Entity\Inscriptos;
use AlumnosBundle\Form\InscriptosType;

/**
 * Inscriptos controller.
 *
 */
class InscriptosController extends Controller
{
    /**
     * Lists all Inscriptos entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $inscriptos = $em->getRepository('AlumnosBundle:Inscriptos')->findAll();
        
         $jsDate = "Wed Sep 14 2016 00:00:00 GMT-0400 (Paraguay Standard Time)";
        $phpDate = strtotime($jsDate);
        
        if ($phpDate !== false) 
            $phpFullDate = date('y-M-d', $phpDate);
        else {
            $phpFullDate = "No es una fecha valida";
        }
        

        return $this->render('inscriptos/index.html.twig', array(
            'inscriptos'  => $inscriptos,
            'phpFullDate' => $phpFullDate 
        ));
    }

    /**
     * Creates a new Inscriptos entity.
     *
     */
    public function newAction(Request $request)
    {
        $inscripto = new Inscriptos();
        $form = $this->createForm('AlumnosBundle\Form\InscriptosType', $inscripto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($inscripto);
            $em->flush();

            return $this->redirectToRoute('inscriptos_show', array('id' => $inscripto->getId()));
        }

        return $this->render('inscriptos/new.html.twig', array(
            'inscripto' => $inscripto,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Inscriptos entity.
     *
     */
    public function showAction(Inscriptos $inscripto)
    {
        $deleteForm = $this->createDeleteForm($inscripto);

        return $this->render('inscriptos/show.html.twig', array(
            'inscripto' => $inscripto,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Inscriptos entity.
     *
     */
    public function editAction(Request $request, Inscriptos $inscripto)
    {
        $deleteForm = $this->createDeleteForm($inscripto);
        $editForm = $this->createForm('AlumnosBundle\Form\InscriptosType', $inscripto);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($inscripto);
            $em->flush();

            return $this->redirectToRoute('inscriptos_edit', array('id' => $inscripto->getId()));
        }

        return $this->render('inscriptos/edit.html.twig', array(
            'inscripto' => $inscripto,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Inscriptos entity.
     *
     */
    public function deleteAction(Request $request, Inscriptos $inscripto)
    {
        $form = $this->createDeleteForm($inscripto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($inscripto);
            $em->flush();
        }

        return $this->redirectToRoute('inscriptos_index');
    }

    /**
     * Creates a form to delete a Inscriptos entity.
     *
     * @param Inscriptos $inscripto The Inscriptos entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Inscriptos $inscripto)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('inscriptos_delete', array('id' => $inscripto->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
