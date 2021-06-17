<?php

namespace App\Entity;

use App\Repository\RendezVousRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RendezVousRepository::class)
 */
class RendezVous
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\OneToOne(targetEntity=Condidature::class, inversedBy="rendezvous", cascade={"persist", "remove"})
     */
    private $condidature;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $slug;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCondidature(): ?Condidature
    {
        return $this->condidature;
    }

    public function setCondidature(?Condidature $condidature): self
    {
        $this->condidature = $condidature;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
   
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
    public function __toString() {
        return $this->slug;
    }

}
