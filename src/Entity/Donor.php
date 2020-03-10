<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert ;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DonorRepository")
 */
class Donor
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
    private $Fullname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email()
     */
    private $Email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="10" , max="10")
     */
    private $Phone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $TypeDonation;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $BloodType;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Appointement", mappedBy="donor")
     */
    private $appointements;

    public function __construct()
    {
        $this->appointements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFullname(): ?string
    {
        return $this->Fullname;
    }

    public function setFullname(string $Fullname): self
    {
        $this->Fullname = $Fullname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->Phone;
    }

    public function setPhone(string $Phone): self
    {
        $this->Phone = $Phone;

        return $this;
    }

    public function getTypeDonation(): ?string
    {
        return $this->TypeDonation;
    }

    public function setTypeDonation(string $TypeDonation): self
    {
        $this->TypeDonation = $TypeDonation;

        return $this;
    }

    public function getBloodType(): ?string
    {
        return $this->BloodType;
    }

    public function setBloodType(string $BloodType): self
    {
        $this->BloodType = $BloodType;

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

    /**
     * @return Collection|Appointement[]
     */
    public function getAppointements(): Collection
    {
        return $this->appointements;
    }

    public function addAppointement(Appointement $appointement): self
    {
        if (!$this->appointements->contains($appointement)) {
            $this->appointements[] = $appointement;
            $appointement->setDonor($this);
        }

        return $this;
    }

    public function removeAppointement(Appointement $appointement): self
    {
        if ($this->appointements->contains($appointement)) {
            $this->appointements->removeElement($appointement);
            // set the owning side to null (unless already changed)
            if ($appointement->getDonor() === $this) {
                $appointement->setDonor(null);
            }
        }

        return $this;
    }
}
