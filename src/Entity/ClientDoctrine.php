<?php

namespace App\Entity;

use App\Repository\ClientDoctrineRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Mitra\Shared\Domain\Aggregate\AggregateRoot;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\UuidInterface;

#[ORM\Table(name: 'Client')]
#[ORM\Entity(repositoryClass: ClientDoctrineRepository::class)]
class ClientDoctrine extends AggregateRoot
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class:UuidGenerator::class)]
    #[ORM\Column(type: 'uuid')]
    private UuidInterface $id;

    #[ORM\Column(type: 'string', length: 150)]
    private string $name;

    #[ORM\Column(type: 'string', length: 150)]
    private string $surname;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable $createdAt;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: AddressDoctrine::class, cascade: ['persist'], fetch: 'EAGER', orphanRemoval: true)]
    private Collection $address;

    /**
     * @param UuidInterface $uuid
     * @param string $name
     * @param string $surname
     */
    public function __construct(
        UuidInterface $uuid,
        string $name,
        string $surname,
    ) {
        $this->id = $uuid;
        $this->name = $name;
        $this->surname = $surname;
        $this->createdAt = new DateTimeImmutable();
        $this->address = new ArrayCollection();
    }


    public static function create(
        UuidInterface $uuid,
        string $name,
        string $surname,
    ): self {
        return new self($uuid, $name, $surname);
    }

    public function getId(): ?string
    {
        return $this->id->toString();
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

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return AddressDoctrine[]
     */
    public function getAddress(): array
    {
        return $this->address->getValues();
    }

    public function addAddress(AddressDoctrine $address): self
    {
        if (!$this->address->contains($address)) {
            $this->address[] = $address;
            $address->setClient($this);
        }

        return $this;
    }

    public function removeAddress(AddressDoctrine $address): self
    {
        if ($this->address->removeElement($address)) {
            // set the owning side to null (unless already changed)
            if ($address->getClient() === $this) {
                $address->setClient(null);
            }
        }

        return $this;
    }
}
