<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use AppBundle\DataFixtures\ORM\UserFixtures;

class UserControllerTest extends WebTestCase
{   
    
    public function testListAction()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'admin1',
            'PHP_AUTH_PW'   => 'password',
        ]);
        $crawler = $client->request('GET', '/users');
        
        $this->assertEquals(200,$client->getResponse()->getStatusCode());
        $this->assertLessThan(
            1,
            $crawler->filter('html:contains("no records found")')->count()
        );
        $this->assertgreaterThan(
            0,
            $crawler->filter('html:contains("admin1")')->count()
        );
    }
    
    public function testCreateAction(){
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'admin1',
            'PHP_AUTH_PW'   => 'password',
        ]);

        $crawler = $client->request('GET', '/users/create');
        
        $form = $crawler->selectButton('Ajouter')->form();

        $form['user[username]'] = 'testUsername';
        $form['user[plainPassword][first]'] = 'testPassword';
        $form['user[plainPassword][second]'] = 'testPassword';
        $form['user[email]'] = 'test@email.com';
        $form['user[roles]'] = ['ROLE_USER'];

        $crawler = $client->submit($form);
        
        $crawler = $client->followRedirect();

        $this->assertEquals(200,$client->getResponse()->getStatusCode());
        
        $this->assertgreaterThan(
            0,
            $crawler->filter('html:contains("testUsername")')->count()
        );
    }
    
    public function testEditAction(){
        
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'admin1',
            'PHP_AUTH_PW'   => 'password',
        ]);
        
        $crawler = $client->request('GET', '/users/36/edit');
        
        $form = $crawler->selectButton('Modifier')->form();

        $form['user[username]'] = 'testEditUsername';
        $form['user[plainPassword][first]'] = 'testEditPassword';
        $form['user[plainPassword][second]'] = 'testEditPassword';
        $form['user[email]'] = 'testedit@email.com';
        $form['user[roles]'] = ['ROLE_USER'];

        $crawler = $client->submit($form);
        
        $crawler = $client->followRedirect();

        $this->assertEquals(200,$client->getResponse()->getStatusCode());
        $this->assertlessThan(
            1,
            $crawler->filter('html:contains("testEditUsername")')->count()
        );
    }
}