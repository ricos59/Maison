<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TaskRepository")
 */
class Task
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
    private $title;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date;

    /**
     *  @ORM\Column(type="integer", nullable=true)
     */
    private $frequency_choice;

    /**
     *  @ORM\Column(type="integer", nullable=true)
     */
    private $frequency_int;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getFrequencyChoice(): ?int
    {
        return $this->frequency_choice;
    }

    public function setFrequencyChoice(?int $frequency_choice): self
    {
        $this->frequency_choice = $frequency_choice;

        return $this;
    }

    public function getFrequencyInt(): ?int
    {
        return $this->frequency_int;
    }

    public function setFrequencyInt(?int $frequency_int): self
    {
        $this->frequency_int = $frequency_int;

        return $this;
    }
}
