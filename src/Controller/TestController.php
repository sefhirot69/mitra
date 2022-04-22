<?php

namespace App\Controller;

use App\Entity\AddressDoctrine;
use App\Entity\ClientDoctrine;
use App\Message\SmsNotification;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{

    public function __construct(private EntityManagerInterface $manager, private MessageBusInterface $bus)
    {
    }

    #[Route('/test', name: 'app_test')]
    public function index(): Response
    {
//        $repository = $this->manager->getRepository(ClientDoctrine::class);
//        $uuid = ClientId::random();
//        $uuid2 = ClientId::random();
////        $client = $this->manager->getRepository(ClientDoctrine::class)->find('f78f957c-bbcd-11ec-bf56-0242ac1c0003');
//
//        $clientDoctrine = ClientDoctrine::create(
//            Uuid::fromString($uuid->value()),
//            'Test',
//            'Test',
//            new \DateTimeImmutable(),
//        );
//        $addressDoctrine = new AddressDoctrine(
//            Uuid::fromString($uuid2->value()),
//            $clientDoctrine,
//            29650,
//            '',
//            '',
//            '',
//            true,
//            new \DateTimeImmutable()
//        );
//        $clientDoctrine->addAddress($addressDoctrine);
//        $this->manager->persist($clientDoctrine);
//        $this->manager->flush($clientDoctrine);

        $this->bus->dispatch(new SmsNotification('Hi!'));

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/TestController.php',
        ]);
    }
}
