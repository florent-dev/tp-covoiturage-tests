<?php

namespace App\Tests\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    protected $client;

    protected function setUp(): void
    {
        $this->ensureKernelShutdown();
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
}