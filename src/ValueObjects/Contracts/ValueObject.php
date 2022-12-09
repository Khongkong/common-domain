<?php

namespace KhongKong\Domain\Common\ValueObjects\Contracts;

interface ValueObject
{
    public function value(): mixed;

    public function equals(self $otherVo): bool;
}
