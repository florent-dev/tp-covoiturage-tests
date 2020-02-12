<?php

use App\Entity\Lieu;
use PHPUnit\Framework\TestCase;

class LieuTest extends TestCase
{
    protected $lieu;

    public function setUp(): void {
        $this->lieu = new Lieu();
    }

    public function testNewLieu() {
        $this->assertInstanceOf(Lieu::class, $this->lieu);
        $this->assertNull($this->lieu->getId());
    }

    public function testLieuNom() {
        $this->lieu->setNom('Grenoble');
        $this->assertEquals("Grenoble", $this->lieu->getNom());
    }

    public function testLieuLatitude() {
        $this->lieu->setLatitude(0.01);
        $this->assertEquals(0.01, $this->lieu->getLatitude());
    }

    public function testLieuLongitude() {
        $this->lieu->setLongitude(0.02);
        $this->assertEquals(0.02, $this->lieu->getLongitude());
    }
}