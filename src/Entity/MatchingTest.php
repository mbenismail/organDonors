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
     * @ORM\Column(type="string", length=255)
     */
    private $DataTest;

    /**
     * @ORM\Column(type="datetime")
     */
    private $AnalysisTime;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $TestResult;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Patient", inversedBy="matchingTests")
     */
    private $patient;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDataTest(): ?string
    {
        return $this->DataTest;
    }

    public function setDataTest(string $DataTest): self
    {
        $this->DataTest = $DataTest;

        return $this;
    }

    public function getAnalysisTime(): ?\DateTimeInterface
    {
        return $this->AnalysisTime;
    }

    public function setAnalysisTime(\DateTimeInterface $AnalysisTime): self
    {
        $this->AnalysisTime = $AnalysisTime;

        return $this;
    }

    public function getTestResult(): ?string
    {
        return $this->TestResult;
    }

    public function setTestResult(string $TestResult): self
    {
        $this->TestResult = $TestResult;

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
}
