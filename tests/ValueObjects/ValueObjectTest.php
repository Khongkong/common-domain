<?php

namespace Tests\ValueObjects;

use KhongKong\Domain\Common\Exceptions\DomainException;
use Tests\Dummies\ValueObjects\IntVoDummy;
use Tests\Dummies\ValueObjects\StringVoDummy;

it('should be equal between two value objects with the same class and value', function () {
    expect(IntVoDummy::create(1)->equals(IntVoDummy::create(1)))->toBeTrue();
    expect(StringVoDummy::create('test')->equals(StringVoDummy::create('test')))->toBeTrue();
});

it('throws exception when two value objects with different class', function () {
    IntVoDummy::create(1)->equals(StringVoDummy::create(1));
})->throws(
    DomainException::class,
    StringVoDummy::class . 'does not have the same type of value object with' . IntVoDummy::class
);
