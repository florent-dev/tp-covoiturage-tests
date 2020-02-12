<?php

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testNewUser() {
        $this->assertInstanceOf(User::class, new User());
    }
}