<?php

namespace Tests\ValueObjects;

use KhongKong\Domain\Common\Exceptions\DomainException;
use KhongKong\Domain\Common\ValueObjects\Quantity;
use Tests\TestCase;

class QuantityTest extends TestCase
{
    /**
     * @test
     * @dataProvider nonNegativeProvider
     */
    public function canBeCreatedFromNonNegativeInteger(int $expectedValue): void
    {
        $quantity = new Quantity($expectedValue);
        $this->assertSame($expectedValue, $quantity->value());
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
        $this->expectExceptionMessage('Quantity must be greater than zero');
        new Quantity(-1);
    }

    /**
     * @test
     */
    public function canAddToAnotherQuantity(): void
    {
        $quantity = new Quantity(10);
        $anotherQuantity = new Quantity(20);
        $expectedQuantity = $quantity->add($anotherQuantity);

        // the add method should create a new quantity
        $this->assertNotSame($expectedQuantity, $quantity);
        $this->assertSame($expectedQuantity->value(), $quantity->value() + $anotherQuantity->value());
    }

    /**
     * @test
     */
    public function canSubtractToAnotherQuantity(): void
    {
        $quantity = new Quantity(30);
        $anotherQuantity = new Quantity(20);
        $expectedQuantity = $quantity->subtract($anotherQuantity);

        // the subtract method should create a new quantity
        $this->assertNotSame($expectedQuantity, $quantity);
        $this->assertSame($expectedQuantity->value(), $quantity->value() - $anotherQuantity->value());
    }

    /**
     * @test
     */
    public function shouldEncounterExceptionWhenMinuendIsLessThanSubtrahend(): void
    {
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('Quantity must be greater than zero');
        (new Quantity(3))->subtract(new Quantity(5));
    }

    /**
     * @test
     */
    public function shouldExpectZeroValue(): void
    {
        $this->assertSame(Quantity::zero()->value(), 0);
    }
}
