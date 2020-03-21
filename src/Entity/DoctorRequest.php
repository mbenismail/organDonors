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
     * @ORM\ManyToMany(targetEntity="App\Entity\Donor", inversedBy="doctorRequests")
     */
    private $donor;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $QuestionText;

    /**
     * @ORM\Column(type="datetime")
     */
    private $QuestionDate;

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
}
