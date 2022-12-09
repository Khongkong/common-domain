<?php

namespace Tests\ValueObjects;

use KhongKong\Domain\Common\Exceptions\DomainException;
use KhongKong\Domain\Common\ValueObjects\MongoDbObjectId;
use Tests\TestCase;

class MongoDbObjectIdTest extends TestCase
{
    /**
     * @test
     */
    public function canCreateIdSuccessfully(): void
    {
        $expectedValue = '6392fc1ded20afd180eba2ef';
        $this->assertSame($expectedValue, (new MongoDbObjectId($expectedValue))->value());
    }

    /**
     * @test
     */
    public function shouldEncounterExceptionWhenInvalidStringIsGiven(): void
    {
        $this->expectException(DomainException::class);
        new MongoDbObjectId('OBAMA?');
    }
}
