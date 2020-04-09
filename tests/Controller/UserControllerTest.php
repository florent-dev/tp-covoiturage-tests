<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testInscription()
    {
        $client = self::createClient();
        $client->request('GET', '/inscription');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}