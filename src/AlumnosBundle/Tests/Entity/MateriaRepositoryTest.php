<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AlumnosBundle\Test\Entity ;

use AlumnosBundle\Entity\CampoOrden;
use AlumnosBundle\Entity\MateriaRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class MateriaRepositoryTest extends KernelTestCase {
    
     private $em;
     
     /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        self::bootKernel();

        $this->em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }
    
    public function testNombreCampo() {
        
        
        $campo = 'id';
        $materiaRepository = $this->em->getRepository('AlumnosBundle:Materia');
        
        $campoOrden = $materiaRepository->getCampoOrden($campo);
        $this->assertEquals('id', $campoOrden->getCampo(), "Probando id");
        $this->assertEquals('ASC', $campoOrden->getOrden(), "Probando orden");
        
        $campo = '-id';
        $campoOrden = $materiaRepository->getCampoOrden($campo);
        $this->assertEquals('id', $campoOrden->getCampo(), "Probando -id");
        $this->assertEquals('DESC', $campoOrden->getOrden());
        
        $campo = '-holacomoestas';
        $campoOrden = $materiaRepository->getCampoOrden($campo);
        $this->assertEquals('holacomoestas', $campoOrden->getCampo(), "Probando -hola");
        $this->assertEquals('DESC', $campoOrden->getOrden());
    }
    
    
    public function testOrden() 
    {
        $materiaRepository = $this->em->getRepository('AlumnosBundle:Materia');
        $orderAsc = $materiaRepository->getAllMaterias ($page = 1, $limit=10, $campo = 'id');
        $orderDesc = $materiaRepository->getAllMaterias ($page = 1, $limit=10, $campo = '-id');
        
        
        $materia1 = $orderAsc->getIterator()->current();
        $materia2 = $orderDesc->getIterator()->current();
        
        $this->assertNotEquals($materia1->getId(), $materia2->getId());        
        $this->assertEquals($materia1->getId(), 1);        
        $this->assertEquals(30, $materia2->getId());        
        
    }
    
    /**
     * Debe remover todos los ids que se le pasa
     */
    public function testRemoveAllOk() {
        $ids = array(29,30);
        $materiaRepository = $this->em->getRepository('AlumnosBundle:Materia');
        $array = $materiaRepository->removeAllByIds($ids);
        //que valor debo esperar
        
        $this->assertEquals( 0, count($array));
        
    }
    
    /*
     * No debe remover los ids que se le pasa
     */
    public function testRemoveAllNoOk() {
        $ids = array(4,6);
        $materiaRepository = $this->em->getRepository('AlumnosBundle:Materia');
        $array = $materiaRepository->removeAllByIds($ids);
        
        $this->assertEquals(  2 , count($array) );
        $this->assertEquals(  4 , $array[0]);
        $this->assertEquals(  6 , $array[1]);
    }
    
    /*
     * El resultado es que tire un error al recibir datos nulos 
     */
    public function testRemoveNull() {
        $ids = null;
        $materiaRepository = $this->em->getRepository('AlumnosBundle:Materia');
        //no acepta null como argumento
        $array = $materiaRepository->removeAllByIds($ids);
        $this->assertEquals( 0, count($array)  );
        
    }
    
    /*
     * Prueba para remover una lista vacia
     * El resultado esperado es que se ejecute y devuelva 0
     */
    public function testRemoveEmpty() {
        $ids = array();
        $materiaRepository = $this->em->getRepository('AlumnosBundle:Materia');
        $array = $materiaRepository->removeAllByIds($ids);
        
        $this->assertEquals( 0 , count($array));
    }

        protected function tearDown()
    {
        parent::tearDown();

        $this->em->close();
        $this->em = null; // avoid memory leaks
    }
}