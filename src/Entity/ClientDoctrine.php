<?php

namespace App\Entity;

use App\Repository\ClientDoctrineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name : 'Client')]
#[ORM\Entity(repositoryClass: ClientDoctrineRepository::class)]
class ClientDoctrine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'uuid')]
    private $id;

    #[ORM\Column(type: 'string', length: 150)]
    private $name;

    #[ORM\Column(type: 'string', length: 150)]
    private $surname;

    #[ORM\Column(type: 'datetime_immutable')]
    private $createdAt;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: AddressDoctrine::class, fetch: 'EAGER', orphanRemoval: true)]
    private $address;

    public function __construct()
    {
        $this->address = new ArrayCollection();
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

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

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
