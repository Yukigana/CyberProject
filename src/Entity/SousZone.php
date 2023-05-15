<?php

namespace App\Entity;

use App\Repository\SousZoneRepository;
use App\Repository\PersonnageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: SousZoneRepository::class)]
class SousZone
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 200)]
    private ?string $Name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $histoire = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $acces = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\ManyToOne(targetEntity: MainZone::class, inversedBy: 'sousZone')]
    #[ORM\JoinColumn(name: 'id_mainZone', nullable: false)]
    #[Assert\NotNull]
    #[Assert\Valid]
    private ?MainZone $mainZone;

    #[ORM\OneToMany(mappedBy: 'sousZone', targetEntity: Personnage::class)]
    #[Assert\Valid]
    private Collection $personnage;

    #[ORM\OneToMany(mappedBy: 'sousZone', targetEntity: Implant::class)]
    #[Assert\Valid]
    private Collection $implant;

    /*
     * Contructeur 
     */

    public function __construct(){
        $this->personnage = new ArrayCollection();
        $this->implant = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getHistoire(): ?string
    {
        return $this->histoire;
    }

    public function setHistoire(string $histoire): self
    {
        $this->histoire = $histoire;

        return $this;
    }

    public function getAcces(): ?string
    {
        return $this->acces;
    }

    public function setAcces(string $acces): self
    {
        $this->acces = $acces;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getMainZone(): ?MainZone
    {
        return $this->mainZone;
    }

    public function getPersonnage(): Collection
    {
        return $personnage;
    }
}
