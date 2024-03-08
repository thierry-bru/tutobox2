<?php

namespace App\Entity;

use App\Repository\SerieExercicesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SerieExercicesRepository::class)]
class SerieExercices
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $fileName = null;

    #[ORM\Column(length: 255)]
    private ?string $intitule = null;

    #[ORM\ManyToOne(inversedBy: 'exercices')]
    private ?ActiviteSeance $activiteSeance = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function setFileName(?string $fileName): static
    {
        $this->fileName = $fileName;

        return $this;
    }

    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function setIntitule(string $intitule): static
    {
        $this->intitule = $intitule;

        return $this;
    }

    public function getActiviteSeance(): ?ActiviteSeance
    {
        return $this->activiteSeance;
    }

    public function setActiviteSeance(?ActiviteSeance $activiteSeance): static
    {
        $this->activiteSeance = $activiteSeance;

        return $this;
    }
}
