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

    public function addRule(Rule $rule): void
    {
        if (array_key_exists($rule->getName(), $this->rules)) {
            throw new OutcomeException('Rule with same name already exists.');
        }

        $this->rules[$rule->getName()] = $rule;
    }
}