<?php

declare(strict_types=1);


namespace Mitra\Client\Domain\ValueObject;

use Mitra\Shared\Domain\ValueObject\StringValueObject;

final class ClientName extends StringValueObject
{

    public function __construct(string $surname)
    {
        parent::__construct($surname);
        $this->checkLength(3, 50);
    }
}