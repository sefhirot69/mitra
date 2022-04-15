<?php

declare(strict_types=1);


namespace Mitra\Clients\Domain\Exception;

use Exception;

final class ClientExistException extends Exception
{
    protected $code = 409;
    protected $message = 'Client with id %s already exists';

    public function __construct(string $idClient)
    {
        parent::__construct(sprintf($this->message, $idClient), $this->code);
    }
}