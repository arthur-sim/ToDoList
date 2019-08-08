<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use AppBundle\DataFixtures\ORM\UserFixtures;

class UserControllerTest extends WebTestCase
{   
    
    public function testListAction()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/users');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextNotContains('td', 'no records found');
        $this->assertSelectorTextContains('html', 'admin1');
    }
    
    public function testCreateAction(){
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'admin1',
            'PHP_AUTH_PW'   => 'password',
        ]);

        $crawler = $client->request('GET', '/users/create');
        
        $form = $crawler->selectButton('submit')->form();

        $form['username'] = 'testUsername';
        $form['password'] = 'testPassword';
        $form['email'] = 'test@email.com';
        $form['roles'] = ['ROLE_USER'];

        $crawler = $client->submit($form);
        
        $client->followRedirect();

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('html', 'testUsername');
    }
    
    public function testEditAction(){
        
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'admin1',
            'PHP_AUTH_PW'   => 'password',
        ]);
        
        $crawler = $client->request('GET', '/users/1/edit');
        
        $form = $crawler->selectButton('submit')->form();
        
        $form = $crawler->selectButton('Update')->form(
            [
                'username' => 'testEditUsername',
            ]
        );

        $crawler = $client->submit($form);
        
        $client->followRedirect();

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('html', 'testEditUsername');
    }
}