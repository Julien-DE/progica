<?php

namespace App\Entity;

use App\Repository\ServiceGiteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServiceGiteRepository::class)]
class ServiceGite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'serviceGites')]
    private ?Service $service_id = null;

    #[ORM\ManyToOne(inversedBy: 'serviceGites')]
    private ?Gite $gite_id = null;

    #[ORM\Column]
    private ?float $price = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getServiceId(): ?Service
    {
        return $this->service_id;
    }

    public function setServiceId(?Service $service_id): self
    {
        $this->service_id = $service_id;

        return $this;
    }

    public function getGiteId(): ?Gite
    {
        return $this->gite_id;
    }

    public function setGiteId(?Gite $gite_id): self
    {
        $this->gite_id = $gite_id;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }
}
