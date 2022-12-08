<?php

namespace KhongKong\Domain\Common\ValueObjects;

interface ValueObject
{
    public function equals(ValueObject $comparedVo): bool;
}
