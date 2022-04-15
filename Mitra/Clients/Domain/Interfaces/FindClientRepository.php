<?php

declare(strict_types=1);


namespace Mitra\Clients\Domain\Interfaces;

use Mitra\Clients\Domain\Dto\CreatorClientDto;
use Mitra\Shared\Domain\ValueObject\Uuid;

interface FindClientRepository
{
    public function find(Uuid $uuid) : ?CreatorClientDto;
}