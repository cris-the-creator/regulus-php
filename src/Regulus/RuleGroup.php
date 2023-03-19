<?php

declare(strict_types=1);

namespace Regulus;

class RuleGroup
{
    /**
     * @var Rule[]
     */
    private array $rules = [];

    public function __construct(private readonly string $name) {}

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Rule[]
     */
    public function getRules(): array
    {
        return $this->rules;
    }

    public function add(Rule $rule): void
    {
        $this->rules[$rule::class] = $rule;
    }

    public function findRule(string $name): ?Rule
    {
        if (array_key_exists($name, $this->rules)) {
            return $this->rules[$name];
        }
        return null;
    }
}