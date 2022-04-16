<?php

declare(strict_types=1);

namespace Mitra\Clients\Application;

use Mitra\Clients\Domain\Exception\ClientExistException;
use Mitra\Clients\Domain\Interfaces\CreatorClientRepository;
use Mitra\Clients\Domain\Interfaces\FindClientRepository;
use Mitra\Clients\Domain\ValueObject\ClientId;
use Mitra\Shared\Domain\ValueObject\Uuid;

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
        $idClient = $clientCommand->getCreatorClientDto()->getUuid();
        if ($this->assertNotExistClient($idClient)) {
            return $this->creatorClient->save($clientCommand->getCreatorClientDto());
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