<?php

namespace App\Entity;

use App\Repository\GiteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GiteRepository::class)]
class Gite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    private ?bool $animals_allowed = null;

    #[ORM\Column(nullable: true)]
    private ?float $price_animals = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(length: 255)]
    private ?string $postal_code = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\Column(length: 255)]
    private ?string $departement = null;

    #[ORM\Column(length: 255)]
    private ?string $region = null;

    #[ORM\ManyToMany(targetEntity: EquipmentInt::class, inversedBy: 'gites')]
    private Collection $Gite_equipement_int;

    #[ORM\ManyToMany(targetEntity: EquipmentExt::class, inversedBy: 'gites')]
    private Collection $gite_equipment_ext;

    #[ORM\OneToMany(mappedBy: 'gite_id', targetEntity: ServiceGite::class)]
    private Collection $serviceGites;

    public function __construct()
    {
        $this->Gite_equipement_int = new ArrayCollection();
        $this->gite_equipment_ext = new ArrayCollection();
        $this->serviceGites = new ArrayCollection();
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

    public function isAnimalsAllowed(): ?bool
    {
        return $this->animals_allowed;
    }

    public function setAnimalsAllowed(?bool $animals_allowed): self
    {
        $this->animals_allowed = $animals_allowed;

        return $this;
    }

    public function getPriceAnimals(): ?float
    {
        return $this->price_animals;
    }

    public function setPriceAnimals(?float $price_animals): self
    {
        $this->price_animals = $price_animals;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postal_code;
    }

    public function setPostalCode(string $postal_code): self
    {
        $this->postal_code = $postal_code;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getDepartement(): ?string
    {
        return $this->departement;
    }

    public function setDepartement(string $departement): self
    {
        $this->departement = $departement;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(string $region): self
    {
        $this->region = $region;

        return $this;
    }

    /**
     * @return Collection<int, EquipmentInt>
     */
    public function getGiteEquipementInt(): Collection
    {
        return $this->Gite_equipement_int;
    }

    public function addGiteEquipementInt(EquipmentInt $giteEquipementInt): self
    {
        if (!$this->Gite_equipement_int->contains($giteEquipementInt)) {
            $this->Gite_equipement_int->add($giteEquipementInt);
        }

        return $this;
    }

    public function removeGiteEquipementInt(EquipmentInt $giteEquipementInt): self
    {
        $this->Gite_equipement_int->removeElement($giteEquipementInt);

        return $this;
    }

    /**
     * @return Collection<int, EquipmentExt>
     */
    public function getGiteEquipmentExt(): Collection
    {
        return $this->gite_equipment_ext;
    }

    public function addGiteEquipmentExt(EquipmentExt $giteEquipmentExt): self
    {
        if (!$this->gite_equipment_ext->contains($giteEquipmentExt)) {
            $this->gite_equipment_ext->add($giteEquipmentExt);
        }

        return $this;
    }

    public function removeGiteEquipmentExt(EquipmentExt $giteEquipmentExt): self
    {
        $this->gite_equipment_ext->removeElement($giteEquipmentExt);

        return $this;
    }

    /**
     * @return Collection<int, ServiceGite>
     */
    public function getServiceGites(): Collection
    {
        return $this->serviceGites;
    }

    public function addServiceGite(ServiceGite $serviceGite): self
    {
        if (!$this->serviceGites->contains($serviceGite)) {
            $this->serviceGites->add($serviceGite);
            $serviceGite->setGiteId($this);
        }

        return $this;
    }

    public function removeServiceGite(ServiceGite $serviceGite): self
    {
        if ($this->serviceGites->removeElement($serviceGite)) {
            // set the owning side to null (unless already changed)
            if ($serviceGite->getGiteId() === $this) {
                $serviceGite->setGiteId(null);
            }
        }

        return $this;
    }
}
