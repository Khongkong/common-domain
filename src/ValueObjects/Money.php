<?php

namespace KhongKong\Domain\Common\ValueObjects;

use KhongKong\Domain\Common\Exceptions\DomainException;

final class Money extends IntegerValue
{
    protected function guard(): void
    {
        if ($this->value >= 0) {
            return;
        }
        throw new DomainException('Money amount must be greater than zero');
    }

    public function add(self $money): self
    {
        return new self($this->value() + $money->value());
    }

    public function subtract(self $money): self
    {
        return new self($this->value() - $money->value());
    }

    public function multiply(int $multiplier): self
    {
        if ($multiplier <= 0) {
            throw new DomainException('The multiplier is expected to be greater than zero');
        }
        return new self($this->value() * $multiplier);
    }

    public static function zero(): self
    {
        return new self(0);
    }
}
