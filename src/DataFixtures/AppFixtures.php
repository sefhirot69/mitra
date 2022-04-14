<?php

namespace App\DataFixtures;

use App\Factory\AddressDoctrineFactory;
use App\Factory\ClientDoctrineFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        ClientDoctrineFactory::createMany(10);
        AddressDoctrineFactory::createMany(20);
        $manager->flush();
    }
}
