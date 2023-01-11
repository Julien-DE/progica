<?php

namespace App\Entity;

use App\Repository\ServiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServiceRepository::class)]
class Service
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'service_id', targetEntity: ServiceGite::class)]
    private Collection $serviceGites;

    public function __construct()
    {
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
            $serviceGite->setServiceId($this);
        }

        return $this;
    }

    public function removeServiceGite(ServiceGite $serviceGite): self
    {
        if ($this->serviceGites->removeElement($serviceGite)) {
            // set the owning side to null (unless already changed)
            if ($serviceGite->getServiceId() === $this) {
                $serviceGite->setServiceId(null);
            }
        }

        return $this;
    }
}
