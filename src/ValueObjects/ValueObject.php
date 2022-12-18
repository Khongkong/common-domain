<?php

namespace KhongKong\Domain\Common\ValueObjects;

use KhongKong\Domain\Common\Exceptions\DomainException;
use KhongKong\Domain\Common\ValueObjects\Contracts\ValueObject as ValueObjectContract;

abstract readonly class ValueObject implements ValueObjectContract
{
    abstract protected function guard(): void;

    abstract public function value(): mixed;

    public function equals(ValueObjectContract $otherVo): bool
    {
        if ($otherVo::class !== static::class) {
            throw new DomainException(
                $otherVo::class . 'does not have the same type of value object with' . static::class
            );
        }
        return $this->value() === $otherVo->value();
    }
}
