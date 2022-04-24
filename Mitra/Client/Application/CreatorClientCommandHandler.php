<?php

declare(strict_types=1);

namespace Mitra\Client\Application;

use Mitra\Client\Domain\ClientExistException;
use Mitra\Client\Domain\ClientNotFoundException;
use Mitra\Client\Domain\CreatorClientRepository;
use Mitra\Client\Domain\FindClientRepository;
use Mitra\Shared\Domain\ValueObject\ClientId;

final class CreatorClientCommandHandler
{
    public function __construct(
        private CreatorClientRepository $creatorClient,
        private FindClientRepository $findClient
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
            if ($this->findClient->find($idClient) !== null) {
                throw new ClientExistException($idClient->value());
            }
        } catch (ClientNotFoundException) {
            return true;
        }
    }


}