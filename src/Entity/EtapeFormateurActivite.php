<?php

namespace App\Entity;

use App\Repository\EtapeFormateurActiviteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtapeFormateurActiviteRepository::class)]
class EtapeFormateurActivite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $intitule = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $ordre = null;

    #[ORM\ManyToOne(inversedBy: 'etapeFormateurActivites')]
    private ?ActiviteSeance $activite = null;

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

    public function getOrdre(): ?int
    {
        return $this->ordre;
    }

    public function setOrdre(int $ordre): static
    {
        $this->ordre = $ordre;

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
