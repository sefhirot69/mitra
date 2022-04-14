<?php

declare(strict_types=1);

namespace Mitra\Clients\Infrastructure\Persistence\Doctrine\Mappings;

use Mitra\Shared\Domain\Clients\ClientId;
use Mitra\Shared\Infrastructure\Persistence\Doctrine\UuidType;

final class ClientIdType extends UuidType
{

    public function getName(): string
    {
        return 'uuid';
    }

    protected function typeClassName(): string
    {
        return ClientId::class;
    }
}
