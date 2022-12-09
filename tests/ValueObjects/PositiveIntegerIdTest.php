<?php

namespace Tests\ValueObjects;

use KhongKong\Domain\Common\Exceptions\DomainException;
use KhongKong\Domain\Common\ValueObjects\PositiveIntegerId;
use Tests\TestCase;

class PositiveIntegerIdTest extends TestCase
{
    /**
     * @test
     */
    public function canCreateIdSuccessfully(): void
    {
        $expectedValue = 81295;
        $this->assertSame($expectedValue, (new PositiveIntegerId($expectedValue))->value());
    }

    /**
     * @test
     * @dataProvider invalidIdProvider
     */
    public function shouldEncounterExceptionWhenInvalidIntegerIsGiven(int $value): void
    {
        $this->expectException(DomainException::class);
        new PositiveIntegerId($value);
    }

    public function invalidIdProvider(): array
    {
        return [
            [0],
            [-666],
        ];
    }
}
