<?php

namespace KhongKong\Domain\Common\ValueObjects;

use KhongKong\Domain\Common\Exceptions\DomainException;

class PositiveIntegerId extends IntegerValue
{
    protected function guard(): void
    {
        if ($this->value > 0) {
            return;
        }
        throw new DomainException('The id must be greater than zero');
    }
}
