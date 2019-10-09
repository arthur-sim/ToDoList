<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use AppBundle\DataFixtures\ORM\TaskFixtures;
use AppBundle\DataFixtures\ORM\UserFixtures;

class xTaskControllerTest extends WebTestCase
{    
    
//    public function testListAction()
//    {
//        $client = static::createClient();
//
//        $crawler = $client->request('GET', '/tasks');
//        
//        $this->assertgreaterThan(
//            0,
//            $crawler->filter('html:contains("Task1")')->count()
//        );
//        $this->assertgreaterThan(
//            0,
//            $crawler->filter('html:contains("Task3")')->count()
//        );
//
//    }
////    
//    public function testCreateAction(){
//            
//        $client = static::createClient([], [
//            'PHP_AUTH_USER' => 'admin1',
//            'PHP_AUTH_PW'   => 'password',
//        ]);
//        
//        $crawler = $client->request('GET', '/tasks/create');
//        
//        $form = $crawler->selectButton('submit')->form();
//        
//        $form['user_id'] = '1';// user a prendre
//        $form['title'] = 'TestCreateTitle';
//        $form['content'] = 'TestCreateContent';
//
//        $crawler = $client->submit($form);
//        
//        $client->followRedirect();
//
//        $this->assertResponseIsSuccessful();
//        $this->assertgreaterThan(
//            0,
//            $crawler->filter('html:contains("TestCreateTitle")')->count()
//        );
//    }
////    
//    public function testEditAction(){
//        
//        $client = static::createClient([], [
//            'PHP_AUTH_USER' => 'admin1',
//            'PHP_AUTH_PW'   => 'password',
//        ]);
//        
//        $crawler = $client->request('GET', '/tasks/1/edit');
//        
//        $form = $crawler->selectButton('submit')->form();
//        
//        $form = $crawler->selectButton('Update')->form(
//            [
//                'title' => 'TestEditTitle',
//            ]
//        );
//
//        $crawler = $client->submit($form);
//        
//        $client->followRedirect();
//        
//        $this->assertResponseIsSuccessful();
//        $this->assertgreaterThan(
//            0,
//            $crawler->filter('html:contains("TestEditTitle")')->count()
//        );
//        
//    }
////    
////    public function testToggleAction(){
////        $client = static::createClient();
////        $crawler = $client->request('GET', '/tasks/3/toggle');
////
////        $form = $crawler->selectButton('Delete')->form();
////
////        $client->submit($form);
////
////        $client->followRedirect();
////
////        $this->assertResponseIsSuccessful();
////        $this->assertSelectorTextNotContains('td', 'Task2');
////    }
////    
//    public function testDeleteAction() {
//        $client = static::createClient();
//        $crawler = $client->request('GET', '/tasks/2/delete');
//
//        $form = $crawler->selectButton('Delete')->form();
//
//        $client->submit($form);
//
//        $client->followRedirect();
// 
//        $this->assertLessThan(
//            1,
//            $crawler->filter('html:contains("Task2")')->count()
//        );
//        
//    }
}
