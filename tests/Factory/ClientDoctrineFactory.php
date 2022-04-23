<?php

namespace App\Tests\Factory;

use App\Entity\ClientDoctrine;
use App\Repository\ClientDoctrineRepository;
use Ramsey\Uuid\Uuid;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<ClientDoctrine>
 *
 * @method static             ClientDoctrine|Proxy createOne(array $attributes = [])
 * @method static             ClientDoctrine[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static             ClientDoctrine|Proxy find(object|array|mixed $criteria)
 * @method static             ClientDoctrine|Proxy findOrCreate(array $attributes)
 * @method static             ClientDoctrine|Proxy first(string $sortedField = 'id')
 * @method static             ClientDoctrine|Proxy last(string $sortedField = 'id')
 * @method static             ClientDoctrine|Proxy random(array $attributes = [])
 * @method static             ClientDoctrine|Proxy randomOrCreate(array $attributes = [])
 * @method static             ClientDoctrine[]|Proxy[] all()
 * @method static             ClientDoctrine[]|Proxy[] findBy(array $attributes)
 * @method static             ClientDoctrine[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static             ClientDoctrine[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static             ClientDoctrineRepository|RepositoryProxy repository()
 * @method ClientDoctrine|Proxy create(array|callable $attributes = [])
 */
final class ClientDoctrineFactory extends ModelFactory
{

    protected function getDefaults(): array
    {
        return [
            'id' => Uuid::fromString(self::faker()->uuid()),
            'name' => self::faker()->firstName(),
            'surname' => self::faker()->lastName(),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
//            ->afterInstantiate(function(ClientDoctrine $clientDoctrine): void {
//                $clientDoctrine->addAddress(AddressDoctrineFactory::createMany(2));
//            });
            ;
    }

    protected static function getClass(): string
    {
        return ClientDoctrine::class;
    }
}
