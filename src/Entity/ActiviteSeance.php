<?php

namespace App\Entity;

use App\Repository\ActiviteSeanceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActiviteSeanceRepository::class)]
class ActiviteSeance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titreActivite = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $consignes = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?SerieExercices $exercices = null;

    #[ORM\OneToMany(mappedBy: 'activiteSeance', targetEntity: SupportActivite::class)]
    private Collection $supports;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?EtudeCasActivite $etudeDeCas = null;

    #[ORM\ManyToMany(targetEntity: ModaliteActivite::class, inversedBy: 'activiteSeances')]
    private Collection $modalites;

    #[ORM\ManyToMany(targetEntity: Materiel::class, inversedBy: 'activiteSeances')]
    private Collection $materiels;

    #[ORM\Column]
    private ?int $duree = null;

    #[ORM\ManyToOne(inversedBy: 'activites')]
    private ?Seance $seance = null;

    #[ORM\Column]
    private ?bool $estComplete = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $ordre = null;

    #[ORM\OneToMany(mappedBy: 'activite', targetEntity: EtapeFormateurActivite::class)]
    private Collection $etapeFormateurActivites;

    #[ORM\OneToMany(mappedBy: 'activite', targetEntity: EtapeStagiaireActivite::class)]
    private Collection $etapeStagiaireActivites;

    #[ORM\OneToMany(mappedBy: 'activite', targetEntity: SupportActivite::class)]
    private Collection $supportActivites;


    public function __construct()
    {
        $this->supports = new ArrayCollection();
        $this->modalites = new ArrayCollection();
        $this->materiels = new ArrayCollection();
        $this->etapeFormateurActivites = new ArrayCollection();
        $this->etapeStagiaireActivites = new ArrayCollection();
        $this->supportActivites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreActivite(): ?string
    {
        return $this->titreActivite;
    }

    public function setTitreActivite(string $titreActivite): static
    {
        $this->titreActivite = $titreActivite;

        return $this;
    }

    public function getConsignes(): ?string
    {
        return $this->consignes;
    }

    public function setConsignes(string $consignes): static
    {
        $this->consignes = $consignes;

        return $this;
    }

    public function getExercices(): ?SerieExercices
    {
        return $this->exercices;
    }

    public function setExercices(?SerieExercices $exercices): static
    {
        $this->exercices = $exercices;

        return $this;
    }

    /**
     * @return Collection<int, SupportActivite>
     */
    public function getSupports(): Collection
    {
        return $this->supports;
    }

    public function addSupport(SupportActivite $support): static
    {
        if (!$this->supports->contains($support)) {
            $this->supports->add($support);
            $support->setActiviteSeance($this);
        }

        return $this;
    }

    public function removeSupport(SupportActivite $support): static
    {
        if ($this->supports->removeElement($support)) {
            // set the owning side to null (unless already changed)
            if ($support->getActiviteSeance() === $this) {
                $support->setActiviteSeance(null);
            }
        }

        return $this;
    }

    public function getEtudeDeCas(): ?EtudeCasActivite
    {
        return $this->etudeDeCas;
    }

    public function setEtudeDeCas(?EtudeCasActivite $etudeDeCas): static
    {
        $this->etudeDeCas = $etudeDeCas;

        return $this;
    }

    /**
     * @return Collection<int, ModaliteActivite>
     */
    public function getModalites(): Collection
    {
        return $this->modalites;
    }

    public function addModalite(ModaliteActivite $modalite): static
    {
        if (!$this->modalites->contains($modalite)) {
            $this->modalites->add($modalite);
        }

        return $this;
    }

    public function removeModalite(ModaliteActivite $modalite): static
    {
        $this->modalites->removeElement($modalite);

        return $this;
    }

    /**
     * @return Collection<int, Materiel>
     */
    public function getMateriels(): Collection
    {
        return $this->materiels;
    }

    public function addMateriel(Materiel $materiel): static
    {
        if (!$this->materiels->contains($materiel)) {
            $this->materiels->add($materiel);
        }

        return $this;
    }

    public function removeMateriel(Materiel $materiel): static
    {
        $this->materiels->removeElement($materiel);

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): static
    {
        $this->duree = $duree;

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
     * @return Collection<int, EtapeFormateurActivite>
     */
    public function getEtapeFormateurActivites(): Collection
    {
        return $this->etapeFormateurActivites;
    }

    public function addEtapeFormateurActivite(EtapeFormateurActivite $etapeFormateurActivite): static
    {
        if (!$this->etapeFormateurActivites->contains($etapeFormateurActivite)) {
            $this->etapeFormateurActivites->add($etapeFormateurActivite);
            $etapeFormateurActivite->setActivite($this);
        }

        return $this;
    }

    public function removeEtapeFormateurActivite(EtapeFormateurActivite $etapeFormateurActivite): static
    {
        if ($this->etapeFormateurActivites->removeElement($etapeFormateurActivite)) {
            // set the owning side to null (unless already changed)
            if ($etapeFormateurActivite->getActivite() === $this) {
                $etapeFormateurActivite->setActivite(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, EtapeStagiaireActivite>
     */
    public function getEtapeStagiaireActivites(): Collection
    {
        return $this->etapeStagiaireActivites;
    }

    public function addEtapeStagiaireActivite(EtapeStagiaireActivite $etapeStagiaireActivite): static
    {
        if (!$this->etapeStagiaireActivites->contains($etapeStagiaireActivite)) {
            $this->etapeStagiaireActivites->add($etapeStagiaireActivite);
            $etapeStagiaireActivite->setActivite($this);
        }

        return $this;
    }

    public function removeEtapeStagiaireActivite(EtapeStagiaireActivite $etapeStagiaireActivite): static
    {
        if ($this->etapeStagiaireActivites->removeElement($etapeStagiaireActivite)) {
            // set the owning side to null (unless already changed)
            if ($etapeStagiaireActivite->getActivite() === $this) {
                $etapeStagiaireActivite->setActivite(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, SupportActivite>
     */
    public function getSupportActivites(): Collection
    {
        return $this->supportActivites;
    }

    public function addSupportActivite(SupportActivite $supportActivite): static
    {
        if (!$this->supportActivites->contains($supportActivite)) {
            $this->supportActivites->add($supportActivite);
            $supportActivite->setActivite($this);
        }

        return $this;
    }

    public function removeSupportActivite(SupportActivite $supportActivite): static
    {
        if ($this->supportActivites->removeElement($supportActivite)) {
            // set the owning side to null (unless already changed)
            if ($supportActivite->getActivite() === $this) {
                $supportActivite->setActivite(null);
            }
        }

        return $this;
    }


}
