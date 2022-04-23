<?php

declare(strict_types=1);


namespace Mitra\Client\Domain\Interfaces;

use Mitra\Client\Domain\Dto\CreatorClientDto;

interface CreatorClientRepository
{
    public function save(CreatorClientDto $creatorClientDto) : bool;
}