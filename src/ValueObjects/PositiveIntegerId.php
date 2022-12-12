<?php

namespace KhongKong\Domain\Common\ValueObjects;

use KhongKong\Domain\Common\Exceptions\DomainException;
use Stringable;

class PositiveIntegerId extends IntegerValue implements Stringable
{
    protected function guard(): void
    {
        if ($this->value > 0) {
            return;
        }
        throw new DomainException('The id must be greater than zero');
    }

    public function __toString(): string
    {
        return $this->value();
    }
}
