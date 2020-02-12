<?php

use App\Entity\Lieu;
use App\Entity\Trajet;
use PHPUnit\Framework\TestCase;

class TrajetTest extends TestCase
{
    protected $trajet;

    public function setUp(): void {
        $this->trajet = new Trajet();
    }

    public function testNewTrajet() {
        $this->assertInstanceOf(Trajet::class, $this->trajet);
        $this->assertNull($this->trajet->getId());
    }

    public function testTrajetPlaces() {
        $this->trajet->setPlaces(2);
        $this->assertEquals(2, $this->trajet->getPlaces());
    }

    public function testTrajetDatetime() {
        $date = new \DateTime();
        $this->trajet->setDatetime($date);
        $this->assertEquals($date, $this->trajet->getDatetime());
    }

    public function testTrajetLieuDepart() {
        $lieu = new Lieu();
        $lieu->addDepartTrajet($this->trajet);
        $this->trajet->setLieuDepart($lieu);
        $this->assertEquals($lieu, $this->trajet->getLieuDepart());
        $this->assertContains($this->trajet, $lieu->getDepartTrajets());
    }

    public function testTrajetLieuArrivee() {
        $lieu = new Lieu();
        $lieu->addArriveeTrajet($this->trajet);
        $this->trajet->setLieuArrivee($lieu);
        $this->assertEquals($lieu, $this->trajet->getLieuArrivee());
        $this->assertContains($this->trajet, $lieu->getArriveeTrajets());
    }
}