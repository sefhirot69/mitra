<?php

namespace App\Entity;

use App\Repository\ClientDoctrineRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Mitra\Client\Domain\Client;
use Mitra\Client\Domain\ValueObject\ClientName;
use Mitra\Client\Domain\ValueObject\ClientSurname;
use Mitra\Shared\Domain\Aggregate\AggregateRoot;
use Mitra\Shared\Domain\ValueObject\ClientId;

#[ORM\Table(name: 'Client')]
#[ORM\Entity(repositoryClass: ClientDoctrineRepository::class)]
class ClientDoctrine extends AggregateRoot
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid')]
    private ClientId $id;

    #[ORM\Column(type: 'string', length: 150)]
    private string $name;

    #[ORM\Column(type: 'string', length: 150)]
    private string $surname;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable $createdAt;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: AddressDoctrine::class, cascade: ['persist'], fetch: 'EAGER', orphanRemoval: true)]
    private Collection $address;

    /**
     * @param ClientId $id
     * @param string $name
     * @param string $surname
     */
    public function __construct(
        ClientId $id,
        string $name,
        string $surname,
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->createdAt = new DateTimeImmutable();
        $this->address = new ArrayCollection();
    }


    public static function create(
        ClientId $id,
        string $name,
        string $surname,
    ): self {
        return new self($id, $name, $surname);
    }

    public function getId(): string
    {
        return $this->id->value();
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

    public function mapToDomain(): Client
    {
        return Client::create(
            new ClientId($this->getId()),
            new ClientName($this->getName()),
            new ClientSurname($this->getSurname()),
            $this->getCreatedAt()
        );
    }
}
