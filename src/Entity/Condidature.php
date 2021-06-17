<?php

namespace App\Entity;

use App\Repository\CondidatureRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CondidatureRepository::class)
 */
class Condidature
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cv;

    /**
     * @ORM\ManyToOne(targetEntity=Offer::class, inversedBy="condidatures")
     */
    private $idOffer;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="condidatures")
     */
    private $idUser;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $etat;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $lettremotivation;

    /**
     * @ORM\OneToOne(targetEntity=RendezVous::class, mappedBy="condidature", cascade={"persist", "remove"})
     */
    private $rendezvous;

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

    public function getCv(): ?string
    {
        return $this->cv;
    }

    public function setCv(?string $cv): self
    {
        $this->cv = $cv;

        return $this;
    }

    public function getIdOffer(): ?Offer
    {
        return $this->idOffer;
    }

    public function setIdOffer(?Offer $idOffer): self
    {
        $this->idOffer = $idOffer;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(?string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }
    public function __toString(){
        // to show the name of the Category in the select
        return $this->etat;
        // to show the id of the Category in the select
        // return $this->id;
    }

    public function getLettremotivation(): ?string
    {
        return $this->lettremotivation;
    }

    public function setLettremotivation(?string $lettremotivation): self
    {
        $this->lettremotivation = $lettremotivation;

        return $this;
    }

    public function getRendezvous(): ?RendezVous
    {
        return $this->rendezvous;
    }

    public function setRendezvous(?RendezVous $rendezvous): self
    {
        // unset the owning side of the relation if necessary
        if ($rendezvous === null && $this->rendezvous !== null) {
            $this->rendezvous->setCondidature(null);
        }

        // set the owning side of the relation if necessary
        if ($rendezvous !== null && $rendezvous->getCondidature() !== $this) {
            $rendezvous->setCondidature($this);
        }

        $this->rendezvous = $rendezvous;

        return $this;
    }
    
}
