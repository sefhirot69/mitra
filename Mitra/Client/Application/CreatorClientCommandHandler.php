<?php

declare(strict_types=1);

namespace Mitra\Client\Application;

use Mitra\Client\Domain\Exception\ClientExistException;
use Mitra\Client\Domain\Interfaces\CreatorClientRepository;
use Mitra\Client\Domain\Interfaces\FindClientRepository;
use Mitra\Client\Domain\ValueObject\ClientId;

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
        if ($this->findClient->find($idClient) !== null) {
            throw new ClientExistException($idClient->value());
        }

        return true;
    }


}