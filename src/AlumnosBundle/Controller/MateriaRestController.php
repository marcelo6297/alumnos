<?php

/* 
 * Controlador para la api de la aplicacion
 */

namespace AlumnosBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\Controller\Annotations\QueryParam;

use AlumnosBundle\Entity\Materia;

/**
 *@RouteResource("api/v1/materia", pluralize=false)
 */
class MateriaRestController extends FOSRestController {
    
    
      
    
    /**
     * @QueryParam(name="page",  requirements="\d+", default="1", description="La pagina visitada")
     * @QueryParam(name="limit", requirements="\d+", default="5", description="El limite para la pagina")
     * @QueryParam(name="order", requirements="-?(id|nombre|codigo)", default="id", description="El campo para ordenar")
     * @ 
     */
    public function cgetAction(ParamFetcher $params) {
        //$this->getQuery()
                
        $em = $this->getDoctrine()->getManager();

        //Retorna un objeto paginador
        $paginator = $em->getRepository('AlumnosBundle:Materia')->getAllMaterias($params->get('page'), $params->get('limit'), $params->get('order'));
        $result = array();
        foreach($paginator as $page) {
             $result[] = $page;
        }
        
        $initData = array (
            'totalCount' => $paginator->count(),
            'records' => $result
            );
        
        $view = $this->view($initData, 200)
            ->setTemplate("AlumnosBundle:api:index.html.twig")
            ->setTemplateData(array('initData' => $initData))
        ;

        return $this->handleView($view);
        
        
    }
    
    
    public function newAction(Request $request) {
        
        $materium = new Materia();
        $form = $this->createForm('AlumnosBundle\Form\MateriaType', $materium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $view = $this->view($form, 200)
            ->setTemplate("AlumnosBundle:api:newMateria.html.twig")
            ->setTemplateData(array('form' => $form->createView()));
            
            return $this->handleView($view);
        }
        
        $view = $this->view($form, 200)
            ->setTemplate("AlumnosBundle:api:newMateria.html.twig")
            ->setTemplateData(array('form' => $form->createView()));
            
        return $this->handleView($view);


    }
    
    public function cputAction() {
        
    }
    
    /**
     * Crear una entidad desde la linea
     */    
    public function postAction(Request $request) {
        
        
        $materium = new Materia();
        $form = $this->createForm('AlumnosBundle\Form\MateriaType', $materium);
        $form->submit($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            $materium = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($materium);
            $em->flush();
             
            $view = $this->view($materium, Response::HTTP_OK)
            ->setTemplate("AlumnosBundle:api:newMateria.html.twig")
            ->setTemplateData(array('form' => $form));
            
            return $this->handleView($view);
        }
        
        $view = $this->view($form, Response::HTTP_BAD_REQUEST)
            ->setTemplate("AlumnosBundle:api:newMateria.html.twig")
            ->setTemplateData(array('form' => $form));
            return $this->handleView($view);
        
        
        
    }
    
    /**
     * 
     * @param type $slug
     */
    public function deleteAction(Request $request , $slug) {
        //si el slug existe
        $initData = array('deleted' => 'ok' );
         
        $parameters = $request->request->all();
         foreach ($parameters as $param) {
             $param;
         }
        $em = $this->getDoctrine()->getManager();
        $em->remove($materium);
        $em->flush();

        $view = $this->view($parameters, Response::HTTP_NO_CONTENT)
            ->setTemplate("AlumnosBundle:api:index.html.twig")
            ->setTemplateData(array('initData' => $initData))
            ;
        return $this->handleView($view);

    }
    
    /**
     * Recibe un array con todos los IDS que se deberia borrar
     * luego borra todos los IDS
     * 
     * Retorna Response::HTTP_NO_CONTENT si se borraron todos
     * 
     * @param Request $request
     * @return type 204 NO_CONTENT & 400 BAD_REQUEST
     */
    public function postRemoveallAction(Request $request)
    {
        //algunos chequeos deben realizarce, por ejemplo el rol
        //tampoco esta internacionalizado los mensajes de error
        $parameters = $request->request->all();
        $em = $this->getDoctrine()->getManager();
        
        $results = $em->getRepository('AlumnosBundle:Materia')->removeAllByIds($parameters['ids']);       
        
//        si el resultado fue mayor a cero algunos items tuvieron problemas
        if (count($results) == 0) 
        {
            $view = $this->view(array(), Response::HTTP_NO_CONTENT)
                ->setTemplate("AlumnosBundle:api:index.html.twig")
                ->setTemplateData(array('parameters' => $parameters));
        }
        else 
        {
            $view = $this->view($results, Response::HTTP_BAD_REQUEST)
                ->setTemplate("AlumnosBundle:api:error.html.twig")
                ->setTemplateData(array('parameters' => $parameters));
        }
        return $this->handleView($view);
         
    }
   
    
     private function createDeleteForm(Materia $materium)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('materia_delete', array('id' => $materium->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    
    
    
}