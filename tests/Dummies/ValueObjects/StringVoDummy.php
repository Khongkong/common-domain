<?php

namespace Tests\Dummies\ValueObjects;

use KhongKong\Domain\Common\ValueObjects\ValueObject;

readonly class StringVoDummy extends ValueObject
{
    public function __construct(
        private string $value
    ) {
    }

    protected function guard(): void
    {
    }

    public function value(): string
    {
        return $this->value;
    }
}
