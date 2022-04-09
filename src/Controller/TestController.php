<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Mitra\Clients\Domain\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{

    public function __construct(private EntityManagerInterface $manager)
    {
    }

    #[Route('/test', name: 'app_test')]
    public function index(): Response
    {
        $result = $this->manager->getRepository(Client::class)->find('feb21714-b84a-11ec-82de-0242ac1f0002');
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/TestController.php',
        ]);
    }
}
