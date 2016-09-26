<?php 

//namespace AlumnosBundle\Tests\Controller;
////
//use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
////
//class InscriptosControllerTest extends WebTestCase
//{
////    
////    public function testCompleteScenario() {
////        $jsDate = "Wed Sep 14 2016 00:00:00 GMT-0400 (Paraguay Standard Time)";
////        $phpDate = strtotime($jsDate);
////        
//        
//                
////    }
//    
////    /*
//    public function testCompleteScenario()
//    {
//        // Create a new client to browse the application
//        $client = static::createClient();
//
//        // Create a new entry in the database
//        $crawler = $client->request('GET', '/inscriptos/');
//        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /inscriptos/");
//        $crawler = $client->click($crawler->selectLink('Create a new entry')->link());
//
//        // Fill in the form and submit it
//        $form = $crawler->selectButton('Create')->form(array(
//            'alumnosbundle_inscriptos[field_name]'  => 'Test',
//            // ... other fields to fill
//        ));
//
//        $client->submit($form);
//        $crawler = $client->followRedirect();
//
//        // Check data in the show view
//        $this->assertGreaterThan(0, $crawler->filter('td:contains("Test")')->count(), 'Missing element td:contains("Test")');
//
//        // Edit the entity
//        $crawler = $client->click($crawler->selectLink('Edit')->link());
//
//        $form = $crawler->selectButton('Update')->form(array(
//            'alumnosbundle_inscriptos[field_name]'  => 'Foo',
//            // ... other fields to fill
//        ));
//
//        $client->submit($form);
//        $crawler = $client->followRedirect();
//
//        // Check the element contains an attribute with value equals "Foo"
//        $this->assertGreaterThan(0, $crawler->filter('[value="Foo"]')->count(), 'Missing element [value="Foo"]');
//
//        // Delete the entity
//        $client->submit($crawler->selectButton('Delete')->form());
//        $crawler = $client->followRedirect();
//
//        // Check the entity has been delete on the list
//        $this->assertNotRegExp('/Foo/', $client->getResponse()->getContent());
//      
//    }
//
//    
//}
