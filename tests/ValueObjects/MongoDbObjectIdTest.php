<?php

namespace Tests\ValueObjects;

use KhongKong\Domain\Common\Exceptions\DomainException;
use KhongKong\Domain\Common\ValueObjects\MongoDbObjectId;

it('can be created', function (): void {
    $expectedValue = '6392fc1ded20afd180eba2ef';
    expect((string) new MongoDbObjectId($expectedValue))->toBe($expectedValue);
});

it('throws an exception when invalid object id is provided', function (): void {
    new MongoDbObjectId('I should fail');
})->throws(
    DomainException::class,
    'Invalid ObjectId value'
);
