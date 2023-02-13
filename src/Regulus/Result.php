<?php

declare(strict_types=1);

namespace Regulus;

readonly class Result
{
    /**
     * @param string $ruleName
     * @param string[] $conditions
     */
    public function __construct(private string $ruleName, private array $conditions)
    {}

    public function getRuleName(): string
    {
        return $this->ruleName;
    }

    /**
     * @return string[]
     */
    public function getConditions(): array
    {
        return $this->conditions;
    }

}