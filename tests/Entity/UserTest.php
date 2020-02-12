﻿<?php

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testNewUser() {
        $user = new User();
        $this->assertInstanceOf(User::class, $user);
        $this->assertNull($user->getId());
    }

    public function testUserNom() {
        $user = new User();
        $user->setNom('Martin');
        $this->assertEquals("Martin", $user->getNom());
    }
}