<?php

namespace App\Entity;

use App\Repository\SequenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SequenceRepository::class)]
class Sequence
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\ManyToOne(inversedBy: 'sequences')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Module $module = null;

    #[ORM\Column(length: 255, nullable:true)]
    private ?string $video = null;

    #[ORM\OneToMany(mappedBy: 'sequence', targetEntity: ExerciceHTML::class)]
    private Collection $exerciceHTMLs;

    #[ORM\OneToMany(mappedBy: 'sequence', targetEntity: Seance::class)]
    private Collection $seances;

    #[ORM\OneToMany(mappedBy: 'sequence', targetEntity: FicheRevision::class)]
    private Collection $ficheRevisions;


    public function __construct()
    {
        $this->exerciceHTMLs = new ArrayCollection();
        $this->seances = new ArrayCollection();
        $this->ficheRevisions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getModule(): ?Module
    {
        return $this->module;
    }

    public function setModule(?Module $module): static
    {
        $this->module = $module;

        return $this;
    }

    public function getVideo(): ?string
    {
        return $this->video;
    }

    public function setVideo(string $video): static
    {
        $this->video = $video;

        return $this;
    }

    /**
     * @return Collection<int, ExerciceHTML>
     */
    public function getExerciceHTMLs(): Collection
    {
        return $this->exerciceHTMLs;
    }
    public function hasExerciceHTMLs(): bool
    {
        return (count($this->exerciceHTMLs)>0);
    }

    public function addExerciceHTML(ExerciceHTML $exerciceHTML): static
    {
        if (!$this->exerciceHTMLs->contains($exerciceHTML)) {
            $this->exerciceHTMLs->add($exerciceHTML);
            $exerciceHTML->setSequence($this);
        }

        return $this;
    }

    public function removeExerciceHTML(ExerciceHTML $exerciceHTML): static
    {
        if ($this->exerciceHTMLs->removeElement($exerciceHTML)) {
            // set the owning side to null (unless already changed)
            if ($exerciceHTML->getSequence() === $this) {
                $exerciceHTML->setSequence(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Seance>
     */
    public function getSeances(): Collection
    {
        return $this->seances;
    }

    public function addSeance(Seance $seance): static
    {
        if (!$this->seances->contains($seance)) {
            $this->seances->add($seance);
            $seance->setSequence($this);
        }

        return $this;
    }

    public function removeSeance(Seance $seance): static
    {
        if ($this->seances->removeElement($seance)) {
            // set the owning side to null (unless already changed)
            if ($seance->getSequence() === $this) {
                $seance->setSequence(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, FicheRevision>
     */
    public function getFicheRevisions(): Collection
    {
        return $this->ficheRevisions;
    }

    public function addFicheRevision(FicheRevision $ficheRevision): static
    {
        if (!$this->ficheRevisions->contains($ficheRevision)) {
            $this->ficheRevisions->add($ficheRevision);
            $ficheRevision->setSequence($this);
        }

        return $this;
    }

    public function removeFicheRevision(FicheRevision $ficheRevision): static
    {
        if ($this->ficheRevisions->removeElement($ficheRevision)) {
            // set the owning side to null (unless already changed)
            if ($ficheRevision->getSequence() === $this) {
                $ficheRevision->setSequence(null);
            }
        }

        return $this;
    }

 
}
