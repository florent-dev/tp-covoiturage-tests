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
        $user = new User();
        $this->assertInstanceOf(User::class, $user);
        $this->assertNull($this->user->getId());
    }

    public function testUserNom() {
        $user = new User();
        $user->setNom('Martin');
        $this->assertEquals("Martin", $this->user->getNom());
    }

    public function testUserPrenom(){
        $this->user->setPrenom();
        $this->assertEquals("Jean-Pierre", $this->user->getPrenom());
    }
}