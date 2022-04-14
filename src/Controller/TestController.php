<?php

namespace App\Controller;

use App\Entity\ClientDoctrine;
use Doctrine\ORM\EntityManagerInterface;
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
        $result = $this->manager->getRepository(ClientDoctrine::class)->find('f78f957c-bbcd-11ec-bf56-0242ac1c0003');
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/TestController.php',
        ]);
    }
}
