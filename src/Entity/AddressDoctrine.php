<?php

namespace App\Entity;

use App\Repository\AddressRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'Address')]
#[ORM\Entity(repositoryClass: AddressRepository::class)]
class AddressDoctrine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'uuid')]
    private $id;

    #[ORM\ManyToOne(targetEntity: ClientDoctrine::class, inversedBy: 'address')]
    #[ORM\JoinColumn(name:'id_client', nullable: false)]
    private $client;

    #[ORM\Column(name: 'postal_code', type: 'integer')]
    private $postalCode;

    #[ORM\Column(type: 'string', length: 255)]
    private $address;

    #[ORM\Column(type: 'string', length: 100)]
    private $city;

    #[ORM\Column(type: 'string', length: 100)]
    private $province;

    #[ORM\Column(name: 'is_active', type: 'boolean')]
    private $isActive;

    #[ORM\Column(type: 'datetime_immutable')]
    private $createdAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClient(): ?ClientDoctrine
    {
        return $this->client;
    }

    public function setClient(?ClientDoctrine $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getPostalCode(): ?int
    {
        return $this->postalCode;
    }

    public function setPostalCode(int $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

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

    public function getProvince(): ?string
    {
        return $this->province;
    }

    public function setProvince(string $province): self
    {
        $this->province = $province;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
