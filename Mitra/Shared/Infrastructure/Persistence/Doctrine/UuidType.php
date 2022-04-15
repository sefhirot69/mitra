<?php

declare(strict_types=1);


namespace Mitra\Shared\Infrastructure\Persistence\Doctrine;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use Mitra\Shared\Domain\Utils;
use Mitra\Shared\Domain\ValueObject\Uuid;
use function Lambdish\Phunctional\last;

abstract class UuidType extends StringType
{
    abstract protected function typeClassName(): string;

    public static function customTypeName(): string
    {
        return Utils::toSnakeCase(str_replace('Type', '', last(explode('\\', static::class))));
    }

    public function getName(): string
    {
        return self::customTypeName();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform) : mixed
    {
        $className = $this->typeClassName();

        return new $className($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform) : string
    {
        /** @var Uuid $value */
        return $value->value();
    }
}