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
        $this->assertEquals(7, $materia2->getId());        
        
    }

        protected function tearDown()
    {
        parent::tearDown();

        $this->em->close();
        $this->em = null; // avoid memory leaks
    }
}