<?php

declare(strict_types=1);


namespace Mitra\Client\Domain\Interfaces;

use Mitra\Client\Domain\ClientNotFoundException;
use Mitra\Client\Domain\Dto\ClientDto;
use Mitra\Shared\Domain\ValueObject\Uuid;

interface FindClientRepository
{
    /**
     * @throws ClientNotFoundException
     */
    public function find(Uuid $uuid) : ?ClientDto;
}