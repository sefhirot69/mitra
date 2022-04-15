<?php

declare(strict_types=1);

namespace Mitra\Clients\Application;

use Mitra\Clients\Domain\Interfaces\CreatorClientRepository;
use Mitra\Clients\Domain\Interfaces\FindClientRepository;

final class CreatorClientCommandHandler
{
    public function __construct(
        private CreatorClientRepository $creatorClient,
        private FindClientRepository $findClient
    ) {
    }

    public function __invoke(CreatorClientCommand $clientCommand) : bool {

        if($this->findClient->find($clientCommand->getCreatorClientDto()->getUuid()) === null) {
            return $this->creatorClient->save($clientCommand->getCreatorClientDto());
        }
        return false;
    }
}