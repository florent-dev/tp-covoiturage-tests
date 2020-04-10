<?php

namespace App\Tests\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
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

    public function testInscription()
    {
        $this->client->request('GET', '/inscription');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    public function testInscriptionForm()
    {
        $crawler = $this->client->request('GET', '/inscription');

        $form = $crawler->selectButton("S'inscrire")->form();
        $form['registration_form[username]'] = 'UserTest';
        $form['registration_form[nom]'] = 'TestNom';
        $form['registration_form[prenom]'] = 'TestPrenom';
        $form['registration_form[email]'] = 'test@test.com';
        $form['registration_form[password]'] = 'test';
        $crawler = $this->client->submit($form);

        /** @var EntityManagerInterface $em */
        $em = $this->bootKernel()->getContainer()->get('doctrine')->getManager();

        /** @var User $registrationUser */
        $registrationUser = $em->getRepository(User::class)->findOneBy(['username' => 'UserTest']);

        // On vérifie que notre user a bien été sauvegardé.
        $this->assertSame('TestPrenom', $registrationUser->getPrenom());

        // Notre page nous retourne le succès de l'opération.
        $this->assertSelectorExists('.flash-success');

        // On supprime notre user test.
        $em->remove($registrationUser);
        $em->flush();
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