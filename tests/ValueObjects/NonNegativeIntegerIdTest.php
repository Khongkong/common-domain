<?php

namespace Tests\ValueObjects;

use KhongKong\Domain\Common\Exceptions\DomainException;
use KhongKong\Domain\Common\ValueObjects\NonNegativeIntegerId;

it('can be created', function (int $value): void {
    expect((new NonNegativeIntegerId($value))->value())->toBe($value);
})->with([
    0,
    938434872383,
]);

it('throws exception', function (): void {
    new NonNegativeIntegerId(-1);
})->throws(
    DomainException::class,
    'The id must be non negative'
);
