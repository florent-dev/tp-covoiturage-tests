<?php

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

}