<?php

namespace App\Entity;

use App\Repository\SupportActiviteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SupportActiviteRepository::class)]
class SupportActivite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $fileName = null;

    #[ORM\ManyToOne(inversedBy: 'supports')]
    private ?ActiviteSeance $activiteSeance = null;

    #[ORM\Column(length: 255)]
    private ?string $filename = null;

    #[ORM\ManyToOne(inversedBy: 'supportActivites')]
    private ?ActiviteSeance $activite = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function setFileName(string $fileName): static
    {
        $this->fileName = $fileName;

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

    public function getActivite(): ?ActiviteSeance
    {
        return $this->activite;
    }

    public function setActivite(?ActiviteSeance $activite): static
    {
        $this->activite = $activite;

        return $this;
    }


}
