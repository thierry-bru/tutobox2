<?php

namespace App\Entity;

use App\Repository\ExerciceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExerciceRepository::class)]
class Exercice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $intitule = null;

    #[ORM\Column(length: 255)]
    private ?string $instructions = null;

    #[ORM\Column(length: 255, nullable:true)]
    private ?string $fichierSupport = null;

    #[ORM\Column(length: 255, nullable:true)]
    private ?string $fichierCorrection = null;

    #[ORM\ManyToOne(inversedBy: 'exercices')]
    private ?TypeExercice $type = null;

    #[ORM\ManyToOne(inversedBy: 'exercices')]
    private ?Seance $seance = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getInstructions(): ?string
    {
        return $this->instructions;
    }

    public function setInstructions(string $instructions): static
    {
        $this->instructions = $instructions;

        return $this;
    }

    public function getFichierSupport(): ?string
    {
        return $this->fichierSupport;
    }

    public function setFichierSupport(string $fichierSupport): static
    {
        $this->fichierSupport = $fichierSupport;

        return $this;
    }

    public function getFichierCorrection(): ?string
    {
        return $this->fichierCorrection;
    }

    public function setFichierCorrection(string $fichierCorrection): static
    {
        $this->fichierCorrection = $fichierCorrection;

        return $this;
    }

    public function getType(): ?TypeExercice
    {
        return $this->type;
    }

    public function setType(?TypeExercice $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getSeance(): ?Seance
    {
        return $this->seance;
    }

    public function setSeance(?Seance $seance): static
    {
        $this->seance = $seance;

        return $this;
    }
}
