<?php

namespace Tests\ValueObjects;

use KhongKong\Domain\Common\Exceptions\DomainException;
use KhongKong\Domain\Common\ValueObjects\ValueObject;
use KhongKong\Domain\Common\ValueObjects\Contracts\ValueObject as ValueObjectContract;
use Tests\TestCase;

class ValueObjectTest extends TestCase
{
    /**
     * @test
     */
    public function shouldBeEqualWhenTwoValueObjectsAreOfTheSameClassWithTheSameValue(): void
    {
        $vo = $this->createIntVo();
        $this->assertTrue($vo->equals($this->createIntVo()));
    }

    /**
     * @test
     */
    public function shouldNotBeEqualWhenTwoValueObjectsAreNotOfTheSameClass(): void
    {
        $this->expectException(DomainException::class);
        $vo = $this->createIntVo();
        $otherVo = $this->createStringVo();
        $vo->equals($otherVo);
    }

    private function createIntVo(): ValueObjectContract
    {
        return new class extends ValueObject {
            protected function guard(): void
            {
            }

            public function value(): int
            {
                return 1;
            }
        };
    }

    private function createStringVo(): ValueObjectContract
    {
        return new class extends ValueObject {
            protected function guard(): void
            {
            }

            public function value(): string
            {
                return '1';
            }
        };
    }
}
