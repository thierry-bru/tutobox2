<?php

namespace App\Entity;

use App\Repository\ModaliteActiviteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModaliteActiviteRepository::class)]
class ModaliteActivite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $intitule = null;

    #[ORM\ManyToMany(targetEntity: ActiviteSeance::class, mappedBy: 'modalites')]
    private Collection $activiteSeances;

    public function __construct()
    {
        $this->activiteSeances = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, ActiviteSeance>
     */
    public function getActiviteSeances(): Collection
    {
        return $this->activiteSeances;
    }

    public function addActiviteSeance(ActiviteSeance $activiteSeance): static
    {
        if (!$this->activiteSeances->contains($activiteSeance)) {
            $this->activiteSeances->add($activiteSeance);
            $activiteSeance->addModalite($this);
        }

        return $this;
    }

    public function removeActiviteSeance(ActiviteSeance $activiteSeance): static
    {
        if ($this->activiteSeances->removeElement($activiteSeance)) {
            $activiteSeance->removeModalite($this);
        }

        return $this;
    }


}
