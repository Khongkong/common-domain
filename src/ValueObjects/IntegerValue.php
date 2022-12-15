<?php

namespace KhongKong\Domain\Common\ValueObjects;

abstract class IntegerValue extends ValueObject
{
    public function __construct(protected readonly int $value)
    {
        $this->guard();
    }

    public function value(): int
    {
        return $this->value;
    }
}
