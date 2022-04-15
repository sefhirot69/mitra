<?php

namespace App\Entity;

use App\Repository\AddressRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\UuidInterface;

#[ORM\Table(name: 'Address')]
#[ORM\Entity(repositoryClass: AddressRepository::class)]
class AddressDoctrine
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class:UuidGenerator::class)]
    #[ORM\Column(type: 'uuid', unique: true)]
    private UuidInterface $id;

    #[ORM\ManyToOne(targetEntity: ClientDoctrine::class, inversedBy: 'address')]
    #[ORM\JoinColumn(name: 'id_client', nullable: false)]
    private ClientDoctrine $client;

    #[ORM\Column(name: 'postal_code', type: 'integer')]
    private int $postalCode;

    #[ORM\Column(type: 'string', length: 255)]
    private string $address;

    #[ORM\Column(type: 'string', length: 100)]
    private string $city;

    #[ORM\Column(type: 'string', length: 100)]
    private string $province;

    #[ORM\Column(name: 'is_active', type: 'boolean')]
    private bool $isActive;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable $createdAt;

    /**
     * @param UuidInterface $id
     * @param ClientDoctrine $client
     * @param int $postalCode
     * @param string $address
     * @param string $city
     * @param string $province
     * @param bool $isActive
     */
    public function __construct(
        UuidInterface $id,
        ClientDoctrine $client,
        int $postalCode,
        string $address,
        string $city,
        string $province,
        bool $isActive,
    ) {
        $this->id = $id;
        $this->client = $client;
        $this->postalCode = $postalCode;
        $this->address = $address;
        $this->city = $city;
        $this->province = $province;
        $this->isActive = $isActive;
        $this->createdAt = new DateTimeImmutable();
    }


    public function getId(): ?string
    {
        return $this->id->toString();
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

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }


    public function getProvince(): ?string
    {
        return $this->province;
    }


    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }


    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

}
