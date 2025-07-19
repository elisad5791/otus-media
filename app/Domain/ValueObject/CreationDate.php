<?php

namespace App\Domain\ValueObject;

use InvalidArgumentException;

class CreationDate
{
    private string $value;

    public function __construct(string $value)
    {
        $this->assertValidDate($value);
        $this->value = date_create($value)->format('Y-m-d');
    }

    public function getValue(): string
    {
        return $this->value;
    }

    private function assertValidDate(string $value): void
    {
        if (!date_create($value)) {
            throw new InvalidArgumentException('Некорректная дата');
        }
    }
}