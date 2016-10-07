<?php

namespace AlumnosBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AlumnosBundle\Entity\Materia;
use AlumnosBundle\Form\MateriaType;

/**
 * Materia controller.
 *
 */
class MateriaController extends Controller
{
    /**
     * Lists all Materia entities.
     * Probar la paginacion con DoctrinePaginator
     */
    public function indexAction()
    {
        
        
        $materium = new Materia();
        $form = $this->createForm('AlumnosBundle\Form\MateriaType', $materium);
        
        $em = $this->getDoctrine()->getManager();
        
        
        //Retorna un objeto paginador
        $paginator = $em->getRepository('AlumnosBundle:Materia')->getAllMaterias();
        $result = array();
        foreach($paginator as $page) {
             $result[] = $page;
            
        }
        
        
        $serializer = $this->container->get('serializer');
//        $datosJson = $serializer->serialize($result, 'json');
        
        
        
        $initData = array (
            'totalCount' => $paginator->count(),
            'recordsCount' => $paginator->getIterator()->count(),
            'records' => $result
            );
        

        return $this->render('materia/index.html.twig', array(
            'materias' => $paginator,
            'initData' => $serializer->serialize($initData, 'json'),
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a new Materia entity.
     *
     */
    public function newAction(Request $request)
    {
        $materium = new Materia();
        $form = $this->createForm('AlumnosBundle\Form\MateriaType', $materium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($materium);
            $em->flush();

            return $this->redirectToRoute('materia_show', array('id' => $materium->getId()));
        }

        return $this->render('materia/new.html.twig', array(
            'materium' => $materium,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Materia entity.
     *
     */
    public function showAction(Materia $materia)
    {
        $deleteForm = $this->createDeleteForm($materia);

        return $this->render('materia/show.html.twig', array(
            'materia' => $materia,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Materia entity.
     *
     */
    public function editAction(Request $request, Materia $materium)
    {
        $deleteForm = $this->createDeleteForm($materium);
        $editForm = $this->createForm('AlumnosBundle\Form\MateriaType', $materium);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($materium);
            $em->flush();

            return $this->redirectToRoute('materia_edit', array('id' => $materium->getId()));
        }

        return $this->render('materia/edit.html.twig', array(
            'materium' => $materium,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Materia entity.
     *
     */
    public function deleteAction(Request $request, Materia $materium)
    {
        $form = $this->createDeleteForm($materium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($materium);
            $em->flush();
        }

        return $this->redirectToRoute('materia_index');
    }

    /**
     * Creates a form to delete a Materia entity.
     *
     * @param Materia $materium The Materia entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Materia $materium)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('materia_delete', array('id' => $materium->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
