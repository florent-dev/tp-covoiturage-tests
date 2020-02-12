<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TrajetRepository")
 */
class Trajet
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $places;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datetime;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Lieu", inversedBy="departTrajets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $lieuDepart;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Lieu", inversedBy="trajets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $lieuArrivee;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlaces(): ?int
    {
        return $this->places;
    }

    public function setPlaces(int $places): self
    {
        $this->places = $places;

        return $this;
    }

    public function getDatetime(): ?\DateTimeInterface
    {
        return $this->datetime;
    }

    public function setDatetime(\DateTimeInterface $datetime): self
    {
        $this->datetime = $datetime;

        return $this;
    }

    public function getLieuDepart(): ?Lieu
    {
        return $this->lieuDepart;
    }

    public function setLieuDepart(?Lieu $lieuDepart): self
    {
        $this->lieuDepart = $lieuDepart;

        return $this;
    }

    public function getLieuArrivee(): ?Lieu
    {
        return $this->lieuArrivee;
    }

    public function setLieuArrivee(?Lieu $lieuArrivee): self
    {
        $this->lieuArrivee = $lieuArrivee;

        return $this;
    }
}
