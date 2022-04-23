<?php

declare(strict_types=1);


namespace Mitra\Client\Domain\Interfaces;

use Mitra\Client\Domain\Dto\CreatorClientDto;
use Mitra\Shared\Domain\ValueObject\Uuid;

interface FindClientRepository
{
    public function find(Uuid $uuid) : ?CreatorClientDto;
}