<?php

declare(strict_types=1);

namespace Mitra\Client\Application;

use Mitra\Client\Domain\ClientExistException;
use Mitra\Client\Domain\ClientFinder;
use Mitra\Client\Domain\ClientNotFoundException;
use Mitra\Client\Domain\CreatorClientRepository;
use Mitra\Shared\Domain\ValueObject\ClientId;

final class CreatorClientCommandHandler
{
    public function __construct(
        private CreatorClientRepository $creatorClient,
        private ClientFinder $clientFinder,
    ) {
    }

    /**
     * @throws ClientExistException
     */
    public function __invoke(CreatorClientCommand $clientCommand): bool
    {
        $creatorClientDto = $clientCommand->mapToDto();
        $idClient = $creatorClientDto->getUuid();
        if ($this->assertNotExistClient($idClient)) {
            return $this->creatorClient->save($creatorClientDto);
        }

        return false;
    }

    /**
     * @param ClientId $idClient
     * @return bool
     * @throws ClientExistException
     */
    private function assertNotExistClient(ClientId $idClient): bool
    {
        try {
            $this->clientFinder->__invoke($idClient);
            throw new ClientExistException($idClient->value());
        } catch (ClientNotFoundException) {
            return true;
        }
    }


}