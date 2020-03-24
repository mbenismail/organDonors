<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MatchingTestRepository")
 */
class MatchingTest
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Patient", inversedBy="matchingTests")
     */
    private $patient;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Donor", inversedBy="matchingTests")
     */
    private $donor;

    /**
     * @ORM\Column(type="datetime")
     */
    private $OperationDateTime;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getOperationDateTime(): ?\DateTimeInterface
    {
        return $this->OperationDateTime;
    }

    public function setOperationDateTime(\DateTimeInterface $OperationDateTime): self
    {
        $this->OperationDateTime = $OperationDateTime;

        return $this;
    }
}
