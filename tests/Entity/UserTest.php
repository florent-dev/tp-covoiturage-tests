<?php

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    protected $user;

    public function setUp(){
        $this->user = new User();
    }
    public function testNewUser() {
        $this->assertInstanceOf(User::class, $this->user);
        $this->assertNull($this->user->getId());
    }

    public function testUserNom() {
        $this->user->setNom('Martin');
        $this->assertEquals("Martin", $this->user->getNom());
    }

    public function testUserPrenom(){
        $this->user->setPrenom("Jean-Pierre");
        $this->assertEquals("Jean-Pierre", $this->user->getPrenom());
    }

    public function testUserPassword(){
        $this->user->setPassword("kiwiparty");
        $this->assertEquals("kiwiparty", $this->user->getPassword());
    }

    public function testUserEmail(){
        $this->user->setEmail("floflo@gentil.fr");
        $this->assertEquals("floflo@gentil.fr", $this->user->getEmail());
    }

}