<?php

namespace App\Factory;

use App\Entity\AddressDoctrine;
use App\Repository\AddressRepository;
use Ramsey\Uuid\Uuid;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<AddressDoctrine>
 *
 * @method static AddressDoctrine|Proxy createOne(array $attributes = [])
 * @method static AddressDoctrine[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static AddressDoctrine|Proxy find(object|array|mixed $criteria)
 * @method static AddressDoctrine|Proxy findOrCreate(array $attributes)
 * @method static AddressDoctrine|Proxy first(string $sortedField = 'id')
 * @method static AddressDoctrine|Proxy last(string $sortedField = 'id')
 * @method static AddressDoctrine|Proxy random(array $attributes = [])
 * @method static AddressDoctrine|Proxy randomOrCreate(array $attributes = [])
 * @method static AddressDoctrine[]|Proxy[] all()
 * @method static AddressDoctrine[]|Proxy[] findBy(array $attributes)
 * @method static AddressDoctrine[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static AddressDoctrine[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static AddressRepository|RepositoryProxy repository()
 * @method AddressDoctrine|Proxy create(array|callable $attributes = [])
 */
final class AddressDoctrineFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            'id' => Uuid::fromString(self::faker()->uuid()),
            'postalCode' => self::faker()->postcode(),
            'address' => self::faker()->address(),
            'city' => self::faker()->city(),
            'province' => self::faker()->city(),
            'isActive' => self::faker()->boolean(),
            'client' => ClientDoctrineFactory::new()
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(AddressDoctrine $addressDoctrine): void {})
        ;
    }

    protected static function getClass(): string
    {
        return AddressDoctrine::class;
    }
}
