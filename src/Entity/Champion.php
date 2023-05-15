<?php

namespace App\Entity;

use App\Repository\ChampionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection; 

#[ORM\Entity(repositoryClass: ChampionRepository::class)]
class Champion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $histoire = null;

    #[ORM\Column(length: 100)]
    private ?string $image = null;

    #[ORM\ManyToMany(targetEntity: Implant::class, inversedBy: 'champion')]
    #[ORM\JoinTable(name: 'asso_champion_implant')]
    #[ORM\JoinColumn(name: 'id_champion', referencedColumnName: 'id')]
    #[ORM\InverseJoinColumn(name: 'id_implant', referencedColumnName: 'id')]
    private Collection $implant;


    /*
     * Contructeur 
     */

     public function __construct(){
        $this->implant = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getImplant(): Collection
    {
        return $this->implant;
    }
}
