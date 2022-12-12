<?php

namespace KhongKong\Domain\Common\ValueObjects;

use KhongKong\Domain\Common\Exceptions\DomainException;
use Stringable;

class NonNegativeIntegerId extends IntegerValue implements Stringable
{
    protected function guard(): void
    {
        if ($this->value >= 0) {
            return;
        }
        throw new DomainException('The id must be non negative');
    }

    public static function zero(): static
    {
        return new static(0);
    }

    public function __toString(): string
    {
        return $this->value();
    }
}
