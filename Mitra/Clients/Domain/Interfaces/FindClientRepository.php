<?php

declare(strict_types=1);


namespace Mitra\Clients\Domain\Interfaces;

use Mitra\Shared\Domain\ValueObject\Uuid;

interface FindClientRepository
{
    public function find(Uuid $uuid) : ?ClientDto;
}