<?php

declare(strict_types=1);

namespace Regulus;

abstract class Rule
{
    /**
     * @var string[]
     */
    private array $conditions;

    public abstract function getRuleResult(): bool;

    public function addCondition(string $condition): void
    {
        $this->conditions[] = $condition;
    }

    /**
     * @return string[]
     */
    public function setConditions(array $conditions): array
    {
        return $this->conditions = $conditions;
    }

    /**
     * @return string[]
     */
    public function getConditions(): array
    {
        return $this->conditions;
    }
}