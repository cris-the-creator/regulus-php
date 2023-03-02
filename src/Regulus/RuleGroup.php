<?php

declare(strict_types=1);

namespace Regulus;

use Regulus\Exception\RuleGroupException;

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
    public function getRuleResults(): array
    {
        $results = [];
        foreach ($this->rules as $rule) {
            $results[] = $rule->getRuleResult();
        }
        return $results;
    }

    /**
     * @throws RuleGroupException
     */
    public function add(Rule $rule): void
    {
        if (array_key_exists($rule::class, $this->rules)) {
            throw new RuleGroupException('RuleResult with same name already exists.');
        }

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