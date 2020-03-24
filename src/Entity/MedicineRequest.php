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
     * @ORM\Column(type="datetime")
     */
    private $RequestDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Donor", inversedBy="medicineRequests")
     */
    private $donor;

    public function __construct()
    {
        $this->RequestDate = new \DateTime('now') ;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDonor(): ?Donor
    {
        return $this->donor;
    }

    public function setDonor(?Donor $donor): self
    {
        $this->donor = $donor;

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
