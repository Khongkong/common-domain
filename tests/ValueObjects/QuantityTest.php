<?php

namespace Tests\ValueObjects;

use KhongKong\Domain\Common\Exceptions\DomainException;
use KhongKong\Domain\Common\ValueObjects\Quantity;

it('can be created from non-negative integer', function (int $value): void {
    expect((new Quantity($value))->value())->toBe($value);
})->with([
    'zero' => 0,
    'positive' => 1,
]);

it('throws exception when negative value is given', function (): void {
    new Quantity(-1);
})->throws(
    DomainException::class,
    'Quantity must be greater than zero'
);

it('can add two quantity amounts', function (int $addedValue, int $addingValue): void {
    expect((new Quantity($addedValue))->add(new Quantity($addingValue))->value())
        ->toBe($addedValue + $addingValue);
})->with([
    [random_int(0, 10000), random_int(0, 10000)],
    [random_int(0, 10000), random_int(0, 10000)],
]);

it('can add a lot of quantity', function (): void {
    $quantityBatch = [
        new Quantity(random_int(0, 10000)),
        new Quantity(random_int(0, 10000)),
        new Quantity(random_int(0, 10000)),
        new Quantity(random_int(0, 10000)),
    ];
    $originalQuantity = new Quantity(666);
    $batchExpectedValue = array_reduce($quantityBatch, static fn (int $carry, Quantity $quantity): int
    => $carry + $quantity->value(), 0);
    expect($originalQuantity->addBatch($quantityBatch)->value())
        ->toBe($originalQuantity->value() + $batchExpectedValue);
});

it('can subtract to another quantity', function (): void {
    $quantity = new Quantity(30);
    $anotherQuantity = new Quantity(20);

    expect($quantity->subtract($anotherQuantity)->value())
        ->toBe($quantity->value() - $anotherQuantity->value());
});

it('throws exception when minuend is less than subtrahend', function (): void {
    (new Quantity(3))->subtract(new Quantity(5));
})->throws(
    DomainException::class,
    'Quantity must be greater than zero'
);
