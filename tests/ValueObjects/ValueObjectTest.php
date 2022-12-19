<?php

namespace Tests\ValueObjects;

use KhongKong\Domain\Common\Exceptions\DomainException;
use KhongKong\Domain\Common\ValueObjects\Contracts\ValueObject as ValueObjectContract;
use Tests\Dummies\ValueObjects\IntVoDummy;
use Tests\Dummies\ValueObjects\StringVoDummy;
use Tests\TestCase;

class ValueObjectTest extends TestCase
{
    /**
     * @test
     */
    public function shouldBeEqualWhenTwoValueObjectsAreOfTheSameClassWithTheSameValue(): void
    {
        $vo = $this->createIntVo(3);
        $this->assertTrue($vo->equals($this->createIntVo(3)));
    }

    /**
     * @test
     */
    public function shouldNotBeEqualWhenTwoValueObjectsAreNotOfTheSameClass(): void
    {
        $this->expectException(DomainException::class);
        $vo = $this->createIntVo(3);
        $otherVo = $this->createStringVo('3');
        $vo->equals($otherVo);
    }

    private function createIntVo(int $value = 0): ValueObjectContract
    {
        return new IntVoDummy($value);
    }

    private function createStringVo(string $value = ''): ValueObjectContract
    {
        return new StringVoDummy($value);
    }
}
