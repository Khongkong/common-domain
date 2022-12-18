<?php

namespace KhongKong\Domain\Common\ValueObjects;

use KhongKong\Domain\Common\Exceptions\DomainException;
use Ramsey\Uuid\Uuid as RamseyUuid;
use Stringable;

readonly class Uuid extends StringValue implements Stringable
{
    private const REGEX_PATTERN = '/^[a-f\d]{8}(-[a-f\d]{4}){4}[a-f\d]{8}$/i';

    protected function guard(): void
    {
        if (preg_match(self::REGEX_PATTERN, $this->value) === 1) {
            return;
        }
        throw new DomainException('Invalid UUID');
    }

    public static function random(): static
    {
        return new static(RamseyUuid::uuid4()->toString());
    }

    public function __toString(): string
    {
        return $this->value();
    }
}
