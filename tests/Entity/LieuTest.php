<?php

use App\Entity\Lieu;
use PHPUnit\Framework\TestCase;

class LieuTest extends TestCase
{
    protected $user;

    public function setUp(){
        $this->lieu = new Lieu();
    }
    public function testNewLieu() {
        $this->assertInstanceOf(Lieu::class, $this->lieu);
        $this->assertNull($this->lieu->getId());
    }

    public function testLieuNom(){
        $this->lieu->setNom('Grenoble');
        $this->assertEquals("Grenoble", $this->lieu->getNom());
    }
}