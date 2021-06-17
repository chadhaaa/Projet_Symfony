<?php

namespace App\Entity;

use App\Repository\OfferRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OfferRepository::class)
 */
class Offer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="integer", length=255)
     */
    private $salaire;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $disponibility;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $recruteur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $location;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity=Condidature::class, mappedBy="idOffer")
     */
    private $idUser;

    public function __construct()
    {
        $this->idUser = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSalaire(): ?string
    {
        return $this->salaire;
    }

    public function setSalaire(string $salaire): self
    {
        $this->salaire = $salaire;

        return $this;
    }

    public function getDisponibility(): ?string
    {
        return $this->disponibility;
    }

    public function setDisponibility(string $disponibility): self
    {
        $this->disponibility = $disponibility;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getRecruteur(): ?string
    {
        return $this->recruteur;
    }

    public function setRecruteur(string $recruteur): self
    {
        $this->recruteur = $recruteur;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(?string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }


    /**
     * @return Collection|Condidature[]
     */
    public function getcondidature(): Collection
    {
        return $this->condidature;
    }

    public function addcondidature(Condidature $condidature): self
    {
        if (!$this->condidature->contains($condidature)) {
            $this->condidature[] = $condidature;
            $condidature->setIdOffer($this);
        }

        return $this;
    }

    public function removecondidature(Condidature $condidature): self
    {
        if ($this->condidature->removeElement($condidature)) {
            // set the owning side to null (unless already changed)
            if ($condidature->getIdOffer() === $this) {
                $condidature->setIdOffer(null);
            }
        }

        return $this;
    }
    public function __toString(){
        // to show the name of the Category in the select
        return $this->title;
        // to show the id of the Category in the select
        // return $this->id;
    }
}



