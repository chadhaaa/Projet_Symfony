<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert; 
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 * @UniqueEntity(
 * fields = {"email"},
 * message = "This email address is already used !!"
 * )
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="8", minMessage="Your password should have at least 8 letters !! ")
     */
    private $password;

    /**
     * @Assert\EqualTo(propertyPath="password", message="You didn't type the same password !! ")
     */

    public $confirm_password;

    /**
     * @ORM\OneToMany(targetEntity=Condidature::class, mappedBy="idUser")
     */
    private $condidatures;

    public function __construct()
    {
        $this->condidatures = new ArrayCollection();
    } 

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function eraseCredentials(){}

    public function getSalt(){}

    public function getRoles()
    {
        return ['ROLE_USER']; 
    }

    /**
     * @return Collection|Condidature[]
     */
    public function getCondidatures(): Collection
    {
        return $this->condidatures;
    }

    public function addCondidature(Condidature $condidature): self
    {
        if (!$this->condidatures->contains($condidature)) {
            $this->condidatures[] = $condidature;
            $condidature->setIdUser($this);
        }

        return $this;
    }

    public function removeCondidature(Condidature $condidature): self
    {
        if ($this->condidatures->removeElement($condidature)) {
            // set the owning side to null (unless already changed)
            if ($condidature->getIdUser() === $this) {
                $condidature->setIdUser(null);
            }
        }

        return $this;
    }
}
