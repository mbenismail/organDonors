<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AppointementRepository")
 */
class Appointement
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
    private $AppTime;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Hospital", inversedBy="appointements")
     */
    private $hospital;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Patient", inversedBy="appointements")
     */
    private $patient;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Donor", inversedBy="appointements")
     */
    private $donor;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAppTime(): ?\DateTimeInterface
    {
        return $this->AppTime;
    }

    public function setAppTime(\DateTimeInterface $AppTime): self
    {
        $this->AppTime = $AppTime;

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

    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    public function setPatient(?Patient $patient): self
    {
        $this->patient = $patient;

        return $this;
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
}
