<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AlumnosBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MateriaRestControllerTest extends WebTestCase {
    
    
    
    public function testDelete()
    {
        // Create a new client to browse the application
        $client = static::createClient();

        // Create a new entry in the database
        $crawler = $client->request('DELETE', '/api/v1/materia/1');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for DELETE /api/v1/materia/");
        
    }
    
    public function testPost()
    {
        // Create a new client to browse the application
        $client = static::createClient();

        $client->request(
                'POST', '/api/v1/materia', 
                array(), 
                array(), 
                array('CONTENT_TYPE' => 'application/json'), 
                '{materia: {"nombre":"nombre_test","codigo":"codigo_test"}}'
        );
        
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for POST /api/v1/materia/");
        
    }
    
    public function testJsonPostPageAction() 
    {
        $this->client = static::createClient();
        $this->client->request(
                'POST', '/api/v1/materia/', 
                array(), 
                array(), 
                array('CONTENT_TYPE' => 'application/json'), 
                '{"nombre":"nombre_test","codigo":"codigo_test"}'
        );
        
    }

}
