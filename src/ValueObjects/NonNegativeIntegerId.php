<?php

namespace KhongKong\Domain\Common\ValueObjects;

use KhongKong\Domain\Common\Exceptions\DomainException;

class NonNegativeIntegerId extends IntegerValue
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
}
