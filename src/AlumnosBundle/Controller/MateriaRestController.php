<?php

/* 
 * Controlador para la api de la aplicacion
 */

namespace AlumnosBundle\Controller;

use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\Controller\Annotations\QueryParam;

/**
 *@RouteResource("api/v1/materia", pluralize=false)
 */
class MateriaRestController extends FOSRestController {
    
    
    public function getAction($slug) {
        
    }
    
    
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
            ->setTemplateVar('result')
            ->setTemplateData(array('result' => $result))
        ;

        return $this->handleView($view);
        
        
    }
    
    
    public function newAction() {
        
    }
    
    public function cputAction() {
        
    }
   
    
 
    
    
    
}