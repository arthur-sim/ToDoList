<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use AppBundle\DataFixtures\ORM\TaskFixtures;
use AppBundle\DataFixtures\ORM\UserFixtures;

class TaskControllerTest extends WebTestCase
{    
    
    public function testListAction()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/tasks');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $this->assertContains('Bienvenue sur TodoList', $crawler->filter('#container h1')->text());
    }
    
    public function testCreateAction(){
            
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'test',
            'PHP_AUTH_PW'   => 'test',
        ]);
        
        $crawler = $client->request('GET', '/tasks/create');
        
        $form = $crawler->selectButton('submit')->form();
        
        $form['user_id'] = '1';// user a prendre
        $form['title'] = 'TestCreateTitle';
        $form['content'] = 'TestCreateContent';

        $crawler = $client->submit($form);
        
        $client->followRedirect();

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('html', 'TestCreateTitle');
    }
    
    public function testEditAction(){
        
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'admin1',
            'PHP_AUTH_PW'   => 'password',
        ]);
        
        $crawler = $client->request('GET', '/tasks/1/edit');
        
        $form = $crawler->selectButton('submit')->form();
        
        $form = $crawler->selectButton('Update')->form(
            [
                'title' => 'TestEditTitle',
            ]
        );

        $crawler = $client->submit($form);
        
        $client->followRedirect();

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('html', 'TestEditTitle');
    }
    
    public function testToggleAction(){
        $client = static::createClient();
        $crawler = $client->request('GET', '/tasks/3/toggle');

        $form = $crawler->selectButton('Delete')->form();

        $client->submit($form);

        $client->followRedirect();

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextNotContains('td', 'Task2');
    }
    
    public function testDeleteAction() {
        $client = static::createClient();
        $crawler = $client->request('GET', '/tasks/2/delete');

        $form = $crawler->selectButton('Delete')->form();

        $client->submit($form);

        $client->followRedirect();

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextNotContains('td', 'Task2');
    }
}
