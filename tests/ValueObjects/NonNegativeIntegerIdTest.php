<?php

namespace Tests\ValueObjects;

use KhongKong\Domain\Common\Exceptions\DomainException;
use KhongKong\Domain\Common\ValueObjects\NonNegativeIntegerId;
use Tests\TestCase;

class NonNegativeIntegerIdTest extends TestCase
{
    /**
     * @test
     * @dataProvider validIdProvider
     */
    public function canCreateIdSuccessfully(int $expectedValue): void
    {
        $this->assertSame($expectedValue, (new NonNegativeIntegerId($expectedValue))->value());
    }

    public function validIdProvider(): array
    {
        return [
            [0],
            [11666],
        ];
    }

    /**
     * @test
     */
    public function shouldEncounterExceptionWhenInvalidIntegerIsGiven(): void
    {
        $this->expectException(DomainException::class);
        new NonNegativeIntegerId(-1);
    }
}
