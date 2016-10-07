<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AlumnosBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class MateriaRepository extends EntityRepository{
    
    protected $asc = 'ASC';
    protected $desc = 'DESC';
    protected $alias = 'mat';
    
    /**
     * 
     * @param type $page
     * @param type $limit
     * @param type $campo el campo por el cual se debe ordenar los resultados, si comienza por '-' el orden es descendente
     * @return type Paginador
     */
    public function getAllMaterias ($page = 1, $limit=5, $campo = 'id') 
    {
        
        $campoOrden = $this->getCampoOrden($campo);
        $query = $this->createQueryBuilder($this->alias)
                        ->orderBy($this->alias.'.'.$campoOrden->getCampo(), $campoOrden->getOrden())
                        ->getQuery();
                return $this->paginate($query, $page, $limit);
    }
    
    /**
     * Retorna un paginador
     * @param type $dql
     * @param type $page
     * @param type $limit
     * @return Paginator
     */
    public function paginate($dql, $page = 1, $limit = 5) 
    {
        $paginator = new Paginator($dql);
        
        $paginator->getQuery()
                ->setFirstResult($limit * ($page - 1)) // Offset
                ->setMaxResults($limit); // Limit

        return $paginator;
    }
    
    /**
     * Retorna una structura de campo y nombre
     * @param type $campo
     */
    public function getCampoOrden($campo) 
    {
        
        if (substr($campo, 0, 1) == "-") 
        {
            $_campo = substr($campo, 1, strlen($campo));      
            $result = new CampoOrden($_campo, $this->desc)  ;
        }
        else 
        {
            $_campo = $campo;      
            $result = new CampoOrden($_campo, $this->asc)  ;
        }
        return $result;
    }
    
    /**
     * Recibe una array con los ids y borra todas las materias de la DDBB
     * @param array $ids
     * @return $mixed Lista de los ids no borrados; vacia si borro todo;
     */
    public function removeAllByIds(array $ids) 
    {
        $result = array();
        $batchSize = 20;
        $i = 0;
        $em = $this->getEntityManager();
        
        $materias = $this->findBy(array('id' => $ids));
        
        foreach($materias as $materia) 
        {  
                $cursos = $materia->getCursos();
                if ($cursos->count() > 0)
                {
                    $result[] = $materia->getId();
                    continue;
                }
                $em->remove($materia);
                if (( $i % $batchSize ) === 0) 
                {
                    $em->flush(); //Execute delete
                }
                $i++;
        }
        $em->flush();
        return $result;
    }
    
    

}

class CampoOrden {
    protected $campo;
    protected $orden;
    
    function __construct($campo, $orden) {
        $this->campo = $campo;
        $this->orden = $orden;
    }

    function getCampo() {
        return $this->campo;
    }

    function getOrden() {
        return $this->orden;
    }

    function setCampo($campo) {
        $this->campo = $campo;
    }

    function setOrden($orden) {
        $this->orden = $orden;
    }


    
    
}