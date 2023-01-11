<?php

namespace App\Entity;

use App\Repository\EquipmentExtRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquipmentExtRepository::class)]
class EquipmentExt
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Gite::class, mappedBy: 'gite_equipment_ext')]
    private Collection $gites;

    public function __construct()
    {
        $this->gites = new ArrayCollection();
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

    /**
     * @return Collection<int, Gite>
     */
    public function getGites(): Collection
    {
        return $this->gites;
    }

    public function addGite(Gite $gite): self
    {
        if (!$this->gites->contains($gite)) {
            $this->gites->add($gite);
            $gite->addGiteEquipmentExt($this);
        }

        return $this;
    }

    public function removeGite(Gite $gite): self
    {
        if ($this->gites->removeElement($gite)) {
            $gite->removeGiteEquipmentExt($this);
        }

        return $this;
    }
}
