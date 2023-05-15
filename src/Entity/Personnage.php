<?php

namespace App\Entity;

use App\Repository\PersonnageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PersonnageRepository::class)]
class Personnage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $type = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $histoire = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $event = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\ManyToOne(targetEntity: SousZone::class, inversedBy: 'personnage')]
    #[ORM\JoinColumn(name: 'id_sousZone', nullable: false)]
    #[Assert\NotNull]
    #[Assert\Valid]
    private ?SousZone $sousZone;

    #[ORM\Column(length: 255)]
    private ?string $image = null;



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

    public function getHistoire(): ?string
    {
        return $this->histoire;
    }

    public function setHistoire(string $histoire): self
    {
        $this->histoire = $histoire;

        return $this;
    }

    public function getEvent(): ?string
    {
        return $this->event;
    }

    public function setEvent(string $event): self
    {
        $this->event = $event;

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

    public function getSousZone(): ?SousZone
    {
        return $this->sousZone;
    }

    public function getType(): ?string
    {
        return $this->type;
    }
    public function getImage(): ?string
    {
        return $this->image;
    }
}
