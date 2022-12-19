<?php

namespace KhongKong\Domain\Common\ValueObjects;

abstract readonly class StringValue extends ValueObject
{
    public function __construct(protected string $value)
    {
        $this->guard();
    }

    public function value(): string
    {
        return $this->value;
    }
}
