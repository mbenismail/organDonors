<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DoctorRequestRepository")
 */
class DoctorRequest
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
    private $QuestionText;

    /**
     * @ORM\Column(type="datetime")
     */
    private $QuestionDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\donor", inversedBy="doctorRequests")
     */
    private $donor;

    public function __construct()
    {
        $this->QuestionDate = new \DateTime() ;

    }

    public function getId(): ?int
    {
        return $this->id;
    }



    public function getQuestionText(): ?string
    {
        return $this->QuestionText;
    }

    public function setQuestionText(string $QuestionText): self
    {
        $this->QuestionText = $QuestionText;

        return $this;
    }

    public function getQuestionDate(): ?\DateTimeInterface
    {
        return $this->QuestionDate;
    }

    public function setQuestionDate(\DateTimeInterface $QuestionDate): self
    {
        $this->QuestionDate = $QuestionDate;

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
