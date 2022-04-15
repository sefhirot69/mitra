<?php

declare(strict_types=1);


namespace Mitra\Clients\Domain\Interfaces;

use Mitra\Clients\Domain\Dto\CreatorClientDto;

interface CreatorClientRepository
{
    public function save(CreatorClientDto $creatorClientDto) : bool;
}