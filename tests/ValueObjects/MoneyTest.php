<?php

namespace Tests\ValueObjects;

use KhongKong\Domain\Common\Exceptions\DomainException;
use KhongKong\Domain\Common\ValueObjects\Money;

it('can be created from non-negative integer', function (int $value): void {
    expect((new Money($value))->value())->toBe($value);
})->with([
    'zero' => 0,
    'positive' => 1,
]);

it('throws exception when negative value is given', function (): void {
    new Money(-1);
})->throws(
    DomainException::class,
    'Money amount must be greater than zero'
);

it('can add two money amounts', function (int $addedValue, int $addingValue): void {
    expect((new Money($addedValue))->add(new Money($addingValue))->value())
        ->toBe($addedValue + $addingValue);
})->with([
    [random_int(0, 10000), random_int(0, 10000)],
    [random_int(0, 10000), random_int(0, 10000)],
]);

it('can add a lot of money', function (): void {
    $moneyBatch = [
        new Money(random_int(0, 10000)),
        new Money(random_int(0, 10000)),
        new Money(random_int(0, 10000)),
        new Money(random_int(0, 10000)),
    ];
    $originalMoney = new Money(666);
    $batchExpectedValue = array_reduce($moneyBatch, static fn (int $carry, Money $money): int
        => $carry + $money->value(), 0);
    expect($originalMoney->addBatch($moneyBatch)->value())
        ->toBe($originalMoney->value() + $batchExpectedValue);
});

it('can subtract to another money', function (): void {
    $money = new Money(30);
    $anotherMoney = new Money(20);

    expect($money->subtract($anotherMoney)->value())
        ->toBe($money->value() - $anotherMoney->value());
});

it('can multiply with positive multiplier', function (): void {
    $money = new Money(10);
    $multiplier = 3;
    expect($money->multiply($multiplier)->value())->toBe($money->value() * $multiplier);
});

it('throws exception when the multiplier is invalid', function (int $multiplier): void {
    (new Money(10))->multiply($multiplier);
})->throws(
    DomainException::class,
    'The multiplier is expected to be greater than zero'
)->with([
    'zero' => 0,
    'negative' => -1,
]);

it('throws exception when minuend is less than subtrahend', function (): void {
    (new Money(3))->subtract(new Money(5));
})->throws(
    DomainException::class,
    'Money amount must be greater than zero'
);
