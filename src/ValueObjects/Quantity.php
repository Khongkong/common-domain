<?php

namespace KhongKong\Domain\Common\ValueObjects;

use KhongKong\Domain\Common\Exceptions\DomainException;

final readonly class Quantity extends IntegerValue
{
    protected function guard(): void
    {
        if ($this->value >= 0) {
            return;
        }
        throw new DomainException('Quantity must be greater than zero');
    }

    public function add(self $quantity): self
    {
        return new self($this->value() + $quantity->value());
    }

    /**
     * @param Quantity[] $quantities
     */
    public function addBatch(array $quantities): self
    {
        return array_reduce($quantities, fn (?Quantity $carry, Quantity $item): Quantity
            => ($carry ?? $this)->add($item));
    }

    public function subtract(self $quantity): self
    {
        return new self($this->value() - $quantity->value());
    }

    public static function zero(): self
    {
        return new self(0);
    }
}
