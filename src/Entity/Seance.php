<?php

namespace App\Entity;

use App\Repository\SeanceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SeanceRepository::class)]
class Seance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $intitule = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $objectifs = null;

    #[ORM\ManyToOne(inversedBy: 'seances')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Sequence $sequence = null;

    #[ORM\OneToMany(mappedBy: 'seance', targetEntity: ActiviteSeance::class)]
    private Collection $activites;

    #[ORM\Column]
    private ?bool $estComplete = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $ordre = null;

    #[ORM\OneToMany(mappedBy: 'seance', targetEntity: Exercice::class)]
    private Collection $exercices;

    public function __construct()
    {
        $this->activites = new ArrayCollection();
        $this->exercices = new ArrayCollection();
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

    public function getObjectifs(): ?string
    {
        return $this->objectifs;
    }

    public function setObjectifs(string $objectifs): static
    {
        $this->objectifs = $objectifs;

        return $this;
    }

    public function getSequence(): ?Sequence
    {
        return $this->sequence;
    }

    public function setSequence(?Sequence $sequence): static
    {
        $this->sequence = $sequence;

        return $this;
    }

    /**
     * @return Collection<int, ActiviteSeance>
     */
    public function getActivites(): Collection
    {
        return $this->activites;
    }

    public function addActivite(ActiviteSeance $activite): static
    {
        if (!$this->activites->contains($activite)) {
            $this->activites->add($activite);
            $activite->setSeance($this);
        }

        return $this;
    }

    public function removeActivite(ActiviteSeance $activite): static
    {
        if ($this->activites->removeElement($activite)) {
            // set the owning side to null (unless already changed)
            if ($activite->getSeance() === $this) {
                $activite->setSeance(null);
            }
        }

        return $this;
    }

    public function isEstComplete(): ?bool
    {
        return $this->estComplete;
    }

    public function setEstComplete(bool $estComplete): static
    {
        $this->estComplete = $estComplete;

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

    /**
     * @return Collection<int, Exercice>
     */
    public function getExercices(): Collection
    {
        return $this->exercices;
    }

    public function addExercice(Exercice $exercice): static
    {
        if (!$this->exercices->contains($exercice)) {
            $this->exercices->add($exercice);
            $exercice->setSeance($this);
        }

        return $this;
    }

    public function removeExercice(Exercice $exercice): static
    {
        if ($this->exercices->removeElement($exercice)) {
            // set the owning side to null (unless already changed)
            if ($exercice->getSeance() === $this) {
                $exercice->setSeance(null);
            }
        }

        return $this;
    }

}
