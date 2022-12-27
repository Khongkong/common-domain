<?php

namespace Tests\ValueObjects;

use KhongKong\Domain\Common\Exceptions\DomainException;
use KhongKong\Domain\Common\ValueObjects\Uuid;

it('can be created when valid UUID strings are passed', function (string $value): void {
    expect((string) new Uuid($value))->toBe($value);
})->with([
    '068f1dba-9ced-4f91-80bf-22a1de0f202d',
    'adaf146a-4016-4a81-aa1e-6c6e7ca54785',
    'a2c69e21-cbfe-4522-bb62-17d3b3069906',
    '5a6dddf7-9e91-481c-aae7-339af217e599',
    'be858435-1cfe-4439-8948-51b56f0f8417',
]);

it('throws exception when invalid value are passed', function (string $value): void {
    new Uuid($value);
})->throws(
    DomainException::class,
    'Invalid UUID'
)->with([
    '',
    'I should fail'
]);
