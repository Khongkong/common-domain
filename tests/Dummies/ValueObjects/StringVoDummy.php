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

    public static function create(string $value): self
    {
        return new self($value);
    }
}
