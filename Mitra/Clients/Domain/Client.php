<?php

declare(strict_types=1);


namespace Mitra\Clients\Domain;

use DateTime;
use DateTimeImmutable;
use Mitra\Shared\Domain\Clients\ClientId;

final class Client
{

    /**
     * @param ClientId $id
     * @param string $name
     * @param string $surname
     * @param DateTime $createdAt
     */
    public function __construct(private ClientId $id, private string $name, private string $surname, private DateTime $createdAt)
    {
    }

    /**
     * @return ClientId
     */
    public function getId() : ClientId
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }


}