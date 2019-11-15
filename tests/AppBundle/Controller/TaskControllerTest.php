<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use AppBundle\DataFixtures\ORM\TaskFixtures;
use AppBundle\DataFixtures\ORM\UserFixtures;

class TaskControllerTest extends WebTestCase
{
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
    public function testListAction()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'admin1',
            'PHP_AUTH_PW'   => 'password',
        ]);
        $crawler = $client->request('GET', '/tasks');
        
        $this->assertEquals(200,$client->getResponse()->getStatusCode());
        $this->assertLessThan(
            1,
            $crawler->filter('html:contains("no records found")')->count()
        );
        $this->assertgreaterThan(
            0,
            $crawler->filter('html:contains("Task1")')->count()
        );
    }
    
    public function testCreateAction(){
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'admin1',
            'PHP_AUTH_PW'   => 'password',
        ]);

        $crawler = $client->request('GET', '/tasks/create');
        
        $form = $crawler->selectButton('Ajouter')->form();

        $form['task[title]'] = 'titleTest';
        $form['task[content]'] = 'contentTest';

        $crawler = $client->submit($form);
        
        $crawler = $client->followRedirect();

        $this->assertEquals(200,$client->getResponse()->getStatusCode());
        
        $this->assertgreaterThan(
            0,
            $crawler->filter('html:contains("titleTest")')->count()
        );
    }
    
    public function testEditAction(){
        
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'admin1',
            'PHP_AUTH_PW'   => 'password',
        ]);
        
        $crawler = $client->request('GET', '/tasks/3/edit');
        
        $form = $crawler->selectButton('Modifier')->form();

        $form['task[title]'] = 'titleTestEdit';
        $form['task[content]'] = 'contentTestEdit';

        $crawler = $client->submit($form);
        
        $crawler = $client->followRedirect();

        $this->assertEquals(200,$client->getResponse()->getStatusCode());
        $this->assertgreaterThan(
            0,
            $crawler->filter('html:contains("titleTestEdit")')->count()
        );
    }
    
    public function testDeleteAction(){
        
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'admin1',
            'PHP_AUTH_PW'   => 'password',
        ]);
        
        $crawler = $client->request('GET', '/tasks/2/delete');
        
        $crawler = $client->followRedirect();

        $this->assertEquals(200,$client->getResponse()->getStatusCode());
        $this->assertlessThan(
            1,
            $crawler->filter('html:contains("Task2")')->count()
        );
    }
}
