<?php

declare(strict_types=1);


namespace Mitra\Client\Domain;

use Exception;

final class ClientNotFoundException extends Exception
{

    protected $message = 'Client <%s> not found.';
    protected $code = 404;

    /**
     * @param string $uuid
     */
    public function __construct(string $uuid)
    {
        $this->message = sprintf($this->message, $uuid);
        parent::__construct($this->message, $this->code);
    }
}