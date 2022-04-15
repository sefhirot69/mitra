<?php

declare(strict_types=1);


namespace App\Tests\Unit\Mitra\Shared\Domain;

use Faker\Factory;
use Faker\Generator;

final class MotherCreator
{
    private static $faker;

    public static function random(): Generator
    {

        return self::$faker = self::$faker ?: Factory::create('es_ES');
    }
}