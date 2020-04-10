<?php
namespace App\Tests\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    /** @var User $user */
    static $user;

    protected $client;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        /** @var EntityManagerInterface $em */
        $em = self::bootKernel()->getContainer()->get('doctrine')->getManager();
        self::$user = new User();
        self::$user->setEmail('jean.dupont@test.com');
        self::$user->setNom('Dupont');
        self::$user->setPrenom('Jean');
        self::$user->setPassword('mdp');
        self::$user->setUsername('jdupont');
        $em->persist(self::$user);
        $em->flush();
        self::ensureKernelShutdown();
    }

    protected function setUp(): void
    {
        $this->client = self::createClient();
    }

    public function testLogin()
    {
        $this->client->request('GET', '/login');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
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

    public function testLogout()
    {
        $this->client->followRedirects();
        $this->client->request('GET', '/logout');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();
        /** @var EntityManagerInterface $em */
        $em = self::bootKernel()->getContainer()->get('doctrine')->getManager();
        $users = $em->getRepository(User::class)->findBy(['email' => 'jean.dupont@test.com']);
        foreach ($users as $user) $em->remove($user);
        $em->flush();
        $em->close();
    }

}