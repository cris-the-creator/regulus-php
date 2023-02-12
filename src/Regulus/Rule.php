<?php
declare(strict_types=1);

namespace Regulus;

class Rule
{
    /**
     * @param string $name
     * @param string[] $conditions
     */
    public function __construct(
        private readonly string $name,
        private array $conditions = []
    ) { }

    public function getName(): string
    {
        return $this->name;
    }

    public function addCondition(string $condition)
    {
        $this->conditions[] = $condition;
    }

    /**
     * @return string[]
     */
    public function getConditions(): array
    {
        return $this->conditions;
    }
}