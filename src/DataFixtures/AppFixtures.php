<?php

namespace App\DataFixtures;

use App\Factory\AddressDoctrineFactory;
use App\Factory\ClientDoctrineFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Mitra\Shared\Domain\ValueObject\ClientId;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $id = new ClientId('feb21714-b84a-11ec-82de-0242ac1f0002');
        ClientDoctrineFactory::createOne(['id' => $id]);
        ClientDoctrineFactory::createMany(10);
//        AddressDoctrineFactory::createMany(20);
        $manager->flush();
    }
}
