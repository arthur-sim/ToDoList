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
}