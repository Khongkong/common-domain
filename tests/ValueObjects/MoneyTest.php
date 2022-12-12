<?php

namespace Tests\ValueObjects;

use KhongKong\Domain\Common\Exceptions\DomainException;
use KhongKong\Domain\Common\ValueObjects\Money;
use Tests\TestCase;

class MoneyTest extends TestCase
{
    /**
     * @test
     * @dataProvider nonNegativeProvider
     */
    public function canBeCreatedFromNonNegativeInteger(int $expectedValue): void
    {
        $money = new Money($expectedValue);
        $this->assertSame($expectedValue, $money->value());
    }

    public function nonNegativeProvider(): array
    {
        return [
            'zero' => [0],
            'positive' => [1],
        ];
    }

    /**
     * @test
     */
    public function shouldEncounterExceptionWhenTheValueIsLessThanZero(): void
    {
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('Money amount must be greater than zero');
        new Money(-1);
    }

    /**
     * @test
     */
    public function canAddToAnotherMoney(): void
    {
        $money = new Money(10);
        $anotherMoney = new Money(20);
        $expectedMoney = $money->add($anotherMoney);

        // the add method should create a new money
        $this->assertNotSame($expectedMoney, $money);
        $this->assertSame($expectedMoney->value(), $money->value() + $anotherMoney->value());
    }

    /**
     * @test
     */
    public function canAddALotOfMoney(): void
    {
        $moneyBatch = [
            new Money(10),
            new Money(20),
            new Money(30),
        ];
        $moneyBatchSum = 10 + 20 + 30;
        $originalValue = 777;
        $originalMoney = new Money($originalValue);
        $this->assertSame(
            $originalValue + $moneyBatchSum,
            $originalMoney->addBatch($moneyBatch)->value()
        );
    }

    /**
     * @test
     */
    public function canSubtractToAnotherMoney(): void
    {
        $money = new Money(30);
        $anotherMoney = new Money(20);
        $expectedMoney = $money->subtract($anotherMoney);

        // the subtract method should create a new money
        $this->assertNotSame($expectedMoney, $money);
        $this->assertSame($expectedMoney->value(), $money->value() - $anotherMoney->value());
    }

    /**
     * @test
     */
    public function canMultiplyWithPositiveMultiplier(): void
    {
        $money = new Money(10);
        $multiplier = 3;
        $this->assertSame($money->multiply($multiplier)->value(), $money->value() * $multiplier);
    }

    /**
     * @test
     * @dataProvider multiplierProvider
     */
    public function shouldEncounterExceptionWhenTheMultiplierIsNotPositive(int $multiplier): void
    {
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('The multiplier is expected to be greater than zero');
        (new Money(10))->multiply($multiplier);
    }

    public function multiplierProvider(): array
    {
        return [
            'zero' => [0],
            'negative' => [-1],
        ];
    }

    /**
     * @test
     */
    public function shouldEncounterExceptionWhenMinuendIsLessThanSubtrahend(): void
    {
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('Money amount must be greater than zero');
        (new Money(3))->subtract(new Money(5));
    }

    /**
     * @test
     */
    public function shouldExpectZeroValue(): void
    {
        $this->assertSame(Money::zero()->value(), 0);
    }
}
