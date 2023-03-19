<?php

declare(strict_types=1);

namespace Regulus;

class Resolver
{
    private array $failedRules = [];
    private array $succeededRules = [];
    private array $failedConditions = [];
    private array $succeededConditions = [];
    private bool $isFulfilled = true;

    /**
     * @param RuleGroup[] $groups
     * @return RuleResult
     */
    public function resolveGroups(array $groups): RuleResult
    {
        $this->resetResultMaps();

        foreach ($groups as $group) {
            foreach($group->getRules() as $rule) {
                $this->resolve($rule);
            }
        }

        return new RuleResult(
            $this->isFulfilled,
            $this->succeededRules,
            $this->failedRules,
            $this->succeededConditions,
            $this->failedConditions
        );
    }

    /**
     * @param Rule[] $rules
     * @return RuleResult
     */
    public function resolveRules(array $rules): RuleResult
    {
        $this->resetResultMaps();

        foreach($rules as $rule) {
            $this->resolve($rule);
        }

        return new RuleResult(
            $this->isFulfilled,
            $this->succeededRules,
            $this->failedRules,
            $this->failedConditions,
            $this->succeededConditions
        );
    }

    private function resolve(Rule $rule): void
    {
        $ruleResult = $rule->resolve();
        if (!$ruleResult->isFulfilled()) {
            $this->failedRules[] = $rule;
            array_push($this->failedConditions, ...$ruleResult->getFailedConditions());
            $this->isFulfilled = false;
            return;
        }


        $this->succeededRules[] = $rule;
        array_push($this->succeededConditions, ...$ruleResult->getSucceededConditions());
    }

    private function resetResultMaps(): void
    {
        $this->isFulfilled = true;
        $this->succeededRules = [];
        $this->failedRules = [];
        $this->succeededConditions = [];
        $this->failedConditions = [];
    }
}