<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use AppBundle\DataFixtures\ORM\UserFixtures;

class SecurityControllerTest extends WebTestCase
{   
    
    public function testLog(){

        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'admin1',
            'PHP_AUTH_PW'   => 'password',
        ]);
        $crawler = $client->request('GET', '/login');
        
        $form = $crawler->selectButton('Se connecter')->form();

        $form['_username'] = 'admin1';
        $form['_password'] = 'password';

        $crawler = $client->submit($form);
        
        $crawler = $client->followRedirect();

        $this->assertEquals(200,$client->getResponse()->getStatusCode());
        
        $this->assertgreaterThan(
            0,
            $crawler->filter('html:contains("Se déconnecter")')->count()
        );
    }
    
//    public function testLogout(){
//
//        $client = static::createClient([], [
//            'PHP_AUTH_USER' => 'admin1',
//            'PHP_AUTH_PW'   => 'password',
//        ]);
//        $crawler = $client->request('GET', '/');
//        
//        $client->click('<a class="nav-link" href="/Todolist/web/app_dev.php/logout">Se déconnecter</a>');
//        
//        $this->assertEquals(200,$client->getResponse()->getStatusCode());
//        
//        $this->assertgreaterThan(
//            0,
//            $crawler->filter('html:contains("Se connecter")')->count()
//        );
//    }
}