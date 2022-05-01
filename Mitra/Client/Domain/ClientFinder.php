<?php

declare(strict_types=1);

namespace Mitra\Client\Domain;

use Mitra\Client\Domain\Dto\ClientDto;
use Mitra\Shared\Domain\ValueObject\ClientId;

class ClientFinder
{

    public function __construct(private FindClientRepository $clientRepository)
    {
    }

    /**
     * @throws ClientNotFoundException
     */
    public function __invoke(ClientId $id): ClientDto
    {
        $clientDto = $this->clientRepository->find($id);

        if (null === $clientDto) {
            throw new ClientNotFoundException($id->value());
        }

        return $clientDto;
    }
}