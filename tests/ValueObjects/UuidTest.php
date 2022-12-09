<?php

namespace Tests\ValueObjects;

use KhongKong\Domain\Common\Exceptions\DomainException;
use KhongKong\Domain\Common\ValueObjects\Uuid;
use Tests\TestCase;

class UuidTest extends TestCase
{
    private const REGEX_PATTERN = '/^[a-f\d]{8}(-[a-f\d]{4}){4}[a-f\d]{8}$/i';

    /**
     * @test
     * @dataProvider uuidStringProvider
     */
    public function canCreateSuccessfullyWhenValidUuidStringsAreGiven(string $uuidString): void
    {
        $this->assertSame($uuidString, (string) new Uuid($uuidString));
    }

    public function uuidStringProvider(): array
    {
        return [
            ['068f1dba-9ced-4f91-80bf-22a1de0f202d'],
            ['adaf146a-4016-4a81-aa1e-6c6e7ca54785'],
            ['a2c69e21-cbfe-4522-bb62-17d3b3069906'],
            ['5a6dddf7-9e91-481c-aae7-339af217e599'],
            ['be858435-1cfe-4439-8948-51b56f0f8417'],
        ];
    }

    /**
     * @test
     * @dataProvider invalidUuidStringProvider
     */
    public function shouldEncounterExceptionWhenInvalidValueIsGiven(string $value): void
    {
        $this->expectException(DomainException::class);
        new Uuid($value);
    }

    public function invalidUuidStringProvider(): array
    {
        return [
            [''],
            ['hihihihihihihihihihihihihihihihihihi'],
        ];
    }

    /**
     * @test
     */
    public function canCreateRandomUuid(): void
    {
        $this->assertMatchesRegularExpression(self::REGEX_PATTERN, Uuid::random()->value());
    }
}
