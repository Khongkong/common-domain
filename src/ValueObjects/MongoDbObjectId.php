<?php

namespace KhongKong\Domain\Common\ValueObjects;

use KhongKong\Domain\Common\Exceptions\DomainException;
use MongoDB\BSON\ObjectId as BSONObjectId;
use Stringable;

class MongoDbObjectId extends StringValue implements Stringable
{
    public function random(): static
    {
        return new static((string) new BSONObjectId());
    }

    public function __toString(): string
    {
        return $this->value;
    }

    protected function guard(): void
    {
        /** @link https://github.com/mongodb/mongo-php-driver/issues/509#issuecomment-271297971 */
        if (
            strlen($this->value) === 24 &&
            strspn($this->value, '0123456789ABCDEFabcdef') === 24
        ) {
            return;
        }
        throw new DomainException('Invalid ObjectId value');
    }
}
