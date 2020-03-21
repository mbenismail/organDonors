<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MedicineRequestRepository")
 */
class MedicineRequest
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Donor", inversedBy="medicineRequests")
     */
    private $donor;

    /**
     * @ORM\Column(type="datetime")
     */
    private $RequestDate;

    public function __construct()
    {
        $this->donor = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Donor[]
     */
    public function getDonor(): Collection
    {
        return $this->donor;
    }

    public function addDonor(Donor $donor): self
    {
        if (!$this->donor->contains($donor)) {
            $this->donor[] = $donor;
        }

        return $this;
    }

    public function removeDonor(Donor $donor): self
    {
        if ($this->donor->contains($donor)) {
            $this->donor->removeElement($donor);
        }

        return $this;
    }

    public function getRequestDate(): ?\DateTimeInterface
    {
        return $this->RequestDate;
    }

    public function setRequestDate(\DateTimeInterface $RequestDate): self
    {
        $this->RequestDate = $RequestDate;

        return $this;
    }
}
