<?php

declare(strict_types=1);


namespace Mitra\Client\Domain;

use Mitra\Client\Domain\Dto\CreatorClientDto;

interface CreatorClientRepository
{
    public function save(CreatorClientDto $creatorClientDto) : Client;
}