<?php

declare(strict_types=1);


namespace Mitra\Clients\Application;

use Mitra\Clients\Domain\Dto\CreatorClientDto;

final class CreatorClientCommand
{
    public function __construct(
        private CreatorClientDto $creatorClientDto,
    ) {
    }

    /**
     * @return CreatorClientDto
     */
    public function getCreatorClientDto(): CreatorClientDto
    {
        return $this->creatorClientDto;
    }
}