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

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $emailcode;

    /**
     * @ORM\Column(type="boolean")
     */
    private $verified;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $FirstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $LastName;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MedicineRequest", mappedBy="donor")
     */
    private $medicineRequests;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DoctorRequest", mappedBy="donor")
     */
    private $doctorRequests;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $OrganDonation;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MatchingTest", mappedBy="donor")
     */
    private $matchingTests;

    /**
     * @ORM\Column(type="integer")
     */
    private $age;

    /**
     * @ORM\Column(type="integer")
     */
    private $weight;

    public function __construct()
    {
        $this->appointements = new ArrayCollection();
        $this->medicineRequests = new ArrayCollection();
        $this->doctorRequests = new ArrayCollection();
        $this->matchingTests = new ArrayCollection();

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

    public function getEmailcode(): ?string
    {
        return $this->emailcode;
    }

    public function setEmailcode(string $emailcode): self
    {
        $this->emailcode = $emailcode;

        return $this;
    }

    public function getVerified(): ?bool
    {
        return $this->verified;
    }

    public function setVerified(bool $verified): self
    {
        $this->verified = $verified;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->FirstName;
    }

    public function setFirstName(string $FirstName): self
    {
        $this->FirstName = $FirstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->LastName;
    }

    public function setLastName(string $LastName): self
    {
        $this->LastName = $LastName;

        return $this;
    }

    /**
     * @return Collection|MedicineRequest[]
     */
    public function getMedicineRequests(): Collection
    {
        return $this->medicineRequests;
    }

    public function addMedicineRequest(MedicineRequest $medicineRequest): self
    {
        if (!$this->medicineRequests->contains($medicineRequest)) {
            $this->medicineRequests[] = $medicineRequest;
            $medicineRequest->setDonor($this);
        }

        return $this;
    }

    public function removeMedicineRequest(MedicineRequest $medicineRequest): self
    {
        if ($this->medicineRequests->contains($medicineRequest)) {
            $this->medicineRequests->removeElement($medicineRequest);
            // set the owning side to null (unless already changed)
            if ($medicineRequest->getDonor() === $this) {
                $medicineRequest->setDonor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|DoctorRequest[]
     */
    public function getDoctorRequests(): Collection
    {
        return $this->doctorRequests;
    }

    public function addDoctorRequest(DoctorRequest $doctorRequest): self
    {
        if (!$this->doctorRequests->contains($doctorRequest)) {
            $this->doctorRequests[] = $doctorRequest;
            $doctorRequest->setDonor($this);
        }

        return $this;
    }

    public function removeDoctorRequest(DoctorRequest $doctorRequest): self
    {
        if ($this->doctorRequests->contains($doctorRequest)) {
            $this->doctorRequests->removeElement($doctorRequest);
            // set the owning side to null (unless already changed)
            if ($doctorRequest->getDonor() === $this) {
                $doctorRequest->setDonor(null);
            }
        }

        return $this;
    }

    public function getOrganDonation(): ?string
    {
        return $this->OrganDonation;
    }

    public function setOrganDonation(string $OrganDonation): self
    {
        $this->OrganDonation = $OrganDonation;

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
            $matchingTest->setDonor($this);
        }

        return $this;
    }

    public function removeMatchingTest(MatchingTest $matchingTest): self
    {
        if ($this->matchingTests->contains($matchingTest)) {
            $this->matchingTests->removeElement($matchingTest);
            // set the owning side to null (unless already changed)
            if ($matchingTest->getDonor() === $this) {
                $matchingTest->setDonor(null);
            }
        }

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(int $weight): self
    {
        $this->weight = $weight;

        return $this;
    }
}
