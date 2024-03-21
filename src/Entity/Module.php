<?php

namespace App\Entity;

use App\Repository\ModuleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModuleRepository::class)]
class Module
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\ManyToOne(inversedBy: 'modules')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Cursus $cursus = null;

    #[ORM\OneToMany(mappedBy: 'module', targetEntity: Sequence::class)]
    private Collection $sequences;

    #[ORM\Column(length: 255)]
    private ?string $acronyme = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $resume = null;

 

    public function __construct()
    {
        $this->sequences = new ArrayCollection();
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

    public function getCursus(): ?Cursus
    {
        return $this->cursus;
    }

    public function setCursus(?Cursus $cursus): static
    {
        $this->cursus = $cursus;

        return $this;
    }
    public function toString():String
    {
        return $this->title;
    }

    /**
     * @return Collection<int, Sequence>
     */
    public function getSequences(): Collection
    {
        return $this->sequences;
    }

    public function addSequence(Sequence $sequence): static
    {
        if (!$this->sequences->contains($sequence)) {
            $this->sequences->add($sequence);
            $sequence->setModule($this);
        }

        return $this;
    }

    public function removeSequence(Sequence $sequence): static
    {
        if ($this->sequences->removeElement($sequence)) {
            // set the owning side to null (unless already changed)
            if ($sequence->getModule() === $this) {
                $sequence->setModule(null);
            }
        }

        return $this;
    }

    public function getAcronyme(): ?string
    {
        return $this->acronyme;
    }

    public function setAcronyme(string $acronyme): static
    {
        $this->acronyme = $acronyme;

        return $this;
    }

    public function getResume(): ?string
    {
        return $this->resume;
    }

    public function setResume(string $resume): static
    {
        $this->resume = $resume;

        return $this;
    }
    
}
