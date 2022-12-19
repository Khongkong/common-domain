<?php

namespace Tests\Dummies\ValueObjects;

use KhongKong\Domain\Common\ValueObjects\ValueObject;

readonly class IntVoDummy extends ValueObject
{
    public function __construct(
        private int $value
    ) {
    }

    protected function guard(): void
    {
    }

    public function value(): int
    {
        return $this->value;
    }
}
