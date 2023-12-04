<?php

namespace App\Entity;

use App\Repository\DevelopersHistoryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DevelopersHistoryRepository::class)
 */
class DevelopersHistory
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $firstIn;

    /**
     * @ORM\Column(type="integer")
     */
    private $secondIn;

    /**
     * @ORM\Column(type="integer")
     */
    private $firstOut;

    /**
     * @ORM\Column(type="integer")
     */
    private $secondOut;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    // Getters and setters for each property

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstIn(): ?int
    {
        return $this->firstIn;
    }

    public function setFirstIn(int $firstIn): self
    {
        $this->firstIn = $firstIn;

        return $this;
    }
    public function setFirstOut(int $firstOut): self
    {
        $this->firstOut = $firstOut;

        return $this;
    }

    public function getSecondIn(): ?int
    {
        return $this->secondIn;
    }

    public function setSecondOut(int $secondOut): self
    {
        $this->secondOut = $secondOut;

        return $this;
    }
    public function setSecondIn(int $secondIn): self
    {
        $this->secondIn = $secondIn;

        return $this;
    }
    // Repeat similar methods for other properties...

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
    
}
