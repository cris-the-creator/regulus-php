<?php

declare(strict_types=1);

namespace Regulus;

abstract class AbstractRule implements Rule
{
    protected function createResult(
        bool $isFulfilled,
        Rule $rule,
        array $succeededConditions,
        array $failedConditions
    ): RuleResult {

        $succeededRules = [];
        $failedRules = [];
        if ($isFulfilled) {
            $succeededRules[] = $rule;
        } else {
            $failedRules[] = $rule;
        }

        return new RuleResult(
            $isFulfilled,
            $succeededRules,
            $failedRules,
            $succeededConditions,
            $failedConditions
        );
    }
}