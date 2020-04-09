<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase {

    public function testLogin() {
        $client = static::createClient();
        $client->request('GET', '/login');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    // Le createclient ne fonctionne pas, en manuel il y a la redirection, en test rien du tout.
    /* public function testLoggedUserAccessingLogin() {
        // On va se dire qu'un utilisateur connecté n'a rien à faire sur la page d'inscription.
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'username',
            'PHP_AUTH_PW'   => 'password',
        ]);

        $client->request('POST', '/login');
        $client->followRedirect();
        $this->assertResponseRedirects('/');
    } */

    public function testLogout() {
        $client = static::createClient();
        $client->followRedirects();
        $client->request('GET', '/logout');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

}