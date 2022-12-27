<?php

namespace Tests\ValueObjects;

use KhongKong\Domain\Common\Exceptions\DomainException;
use KhongKong\Domain\Common\ValueObjects\PositiveIntegerId;

it('can be created', function (): void {
    $expectedValue = 81295;
    expect((new PositiveIntegerId($expectedValue))->value())->toBe($expectedValue);
});

it('throws an exception when invalid id is given', function (int $value): void {
    new PositiveIntegerId($value);
})->throws(
    DomainException::class,
    'The id must be greater than zero'
)->with([
    0,
    -1,
]);
