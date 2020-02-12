<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="LieuRepository")
 */
class Lieu
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="float")
     */
    private $latitude;

    /**
     * @ORM\Column(type="float")
     */
    private $longitude;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Trajet", mappedBy="lieuDepart")
     */
    private $departTrajets;

    public function __construct()
    {
        $this->departTrajets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * @return Collection|Trajet[]
     */
    public function getDepartTrajets(): Collection
    {
        return $this->departTrajets;
    }

    public function addDepartTrajet(Trajet $departTrajet): self
    {
        if (!$this->departTrajets->contains($departTrajet)) {
            $this->departTrajets[] = $departTrajet;
            $departTrajet->setLieuDepart($this);
        }

        return $this;
    }

    public function removeDepartTrajet(Trajet $departTrajet): self
    {
        if ($this->departTrajets->contains($departTrajet)) {
            $this->departTrajets->removeElement($departTrajet);
            // set the owning side to null (unless already changed)
            if ($departTrajet->getLieuDepart() === $this) {
                $departTrajet->setLieuDepart(null);
            }
        }

        return $this;
    }
}
