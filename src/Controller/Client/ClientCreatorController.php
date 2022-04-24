<?php

declare(strict_types=1);


namespace App\Controller\Client;

use Mitra\Client\Application\CreatorClientCommand;
use Mitra\Client\Application\CreatorClientCommandHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class ClientCreatorController extends AbstractController
{


    public function __construct(private CreatorClientCommandHandler $commandHandler)
    {
    }

    #[Route('/client', name: 'app_client_creator')]
    public function __invoke(Request $request): JsonResponse
    {
        try {
            ($this->commandHandler)(
                new CreatorClientCommand(
                    $request->request->get('id'),
                    $request->request->get('name'),
                    $request->request->get('surname'),
                )
            );

            return $this->json([], Response::HTTP_CREATED);
        } catch(\Exception $exception) {
            return $this->json(['error' => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
        }

    }
}