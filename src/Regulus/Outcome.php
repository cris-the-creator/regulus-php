<?php

declare(strict_types=1);

namespace Regulus;

use Regulus\Exception\OutcomeException;

class Outcome
{
    /**
     * @var Rule[]
     */
    private array $rules = [];

    /**
     * @throws OutcomeException
     */
    public function addRule(Rule $rule): void
    {
        if (array_key_exists($rule::class, $this->rules)) {
            throw new OutcomeException('RuleResult with same name already exists.');
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