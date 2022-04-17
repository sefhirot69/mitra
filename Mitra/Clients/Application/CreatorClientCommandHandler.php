<?php

declare(strict_types=1);

namespace Mitra\Clients\Application;

use Mitra\Clients\Domain\Exception\ClientExistException;
use Mitra\Clients\Domain\Interfaces\CreatorClientRepository;
use Mitra\Clients\Domain\Interfaces\FindClientRepository;
use Mitra\Clients\Domain\ValueObject\ClientId;

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