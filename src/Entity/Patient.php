<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert ;


/**
 * @ORM\Entity(repositoryClass="App\Repository\PatientRepository")
 */
class Patient
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\Email()
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Fullname;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $Phone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Address;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $BloodType;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Hospital", inversedBy="patients")
     */
    private $hospital;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MatchingTest", mappedBy="patient")
     */
    private $matchingTests;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Appointement", mappedBy="patient")
     */
    private $appointements;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isurgent;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $organDonation;

    public function __construct()
    {
        $this->matchingTests = new ArrayCollection();
        $this->appointements = new ArrayCollection();
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

    public function getFullname(): ?string
    {
        return $this->Fullname;
    }

    public function setFullname(string $Fullname): self
    {
        $this->Fullname = $Fullname;

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

    public function getAddress(): ?string
    {
        return $this->Address;
    }

    public function setAddress(string $Address): self
    {
        $this->Address = $Address;

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

    public function getHospital(): ?Hospital
    {
        return $this->hospital;
    }

    public function setHospital(?Hospital $hospital): self
    {
        $this->hospital = $hospital;

        return $this;
    }

    /**
     * @return Collection|MatchingTest[]
     */
    public function getMatchingTests(): Collection
    {
        return $this->matchingTests;
    }

    public function addMatchingTest(MatchingTest $matchingTest): self
    {
        if (!$this->matchingTests->contains($matchingTest)) {
            $this->matchingTests[] = $matchingTest;
            $matchingTest->setPatient($this);
        }

        return $this;
    }

    public function removeMatchingTest(MatchingTest $matchingTest): self
    {
        if ($this->matchingTests->contains($matchingTest)) {
            $this->matchingTests->removeElement($matchingTest);
            // set the owning side to null (unless already changed)
            if ($matchingTest->getPatient() === $this) {
                $matchingTest->setPatient(null);
            }
        }

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
            $appointement->setPatient($this);
        }

        return $this;
    }

    public function removeAppointement(Appointement $appointement): self
    {
        if ($this->appointements->contains($appointement)) {
            $this->appointements->removeElement($appointement);
            // set the owning side to null (unless already changed)
            if ($appointement->getPatient() === $this) {
                $appointement->setPatient(null);
            }
        }

        return $this;
    }

    public function getIsurgent(): ?bool
    {
        return $this->isurgent;
    }

    public function setIsurgent(bool $isurgent): self
    {
        $this->isurgent = $isurgent;

        return $this;
    }

    public function getOrganDonation(): ?string
    {
        return $this->organDonation;
    }

    public function setOrganDonation(string $organDonation): self
    {
        $this->organDonation = $organDonation;

        return $this;
    }
}
