<?php

declare(strict_types=1);


namespace Mitra\Clients\Domain;

use DateTime;
use DateTimeImmutable;

final class Client
{

    /**
     * @param string $uuid
     * @param string $name
     * @param string $surname
     * @param DateTime $createdAt
     */
    public function __construct(private string $uuid, private string $name, private string $surname, private DateTime $createdAt)
    {
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
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