<?php

declare(strict_types=1);


namespace App\Controller\Client;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class ClientCreatorController extends AbstractController
{

    #[Route('/client', name: 'app_client_creator')]
    public function __invoke(Request $request): JsonResponse
    {
        return $this->json([],Response::HTTP_CREATED);
    }
}