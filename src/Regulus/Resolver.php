<?php
declare(strict_types=1);

namespace Regulus;

use Regulus\Exception\ResolverException;

class Resolver
{
    private array $ruleGroups;

    public function addGroup(RuleGroup $ruleGroup): void
    {
        $this->ruleGroups[$ruleGroup->getName()] = $ruleGroup;
    }

    /**
     * @throws ResolverException
     */
    public function resolve(string $ruleName): ?RuleResult
    {
        $rule = $this->ruleGroup->findRule($ruleName);
        if (null === $rule) {
            throw new ResolverException('Resolve rule not found.');
        }

        return $rule->getRuleResult();
    }

    public function resolveGroup(string $groupName): ?RuleResult
    {
        if (!array_key_exists($groupName, $this->ruleGroups))  {
            return null;
        }

        $ruleResults = $this->ruleGroups[$groupName]->getRuleResults();

        foreach ($ruleResults as $ruleResult) {
            /* @var RuleResult $ruleResult */
            if ($ruleResult->isFulfilled()) {
                continue;
            }

            //TODO: Return fail rule result
        }
        //TODO: Return success rule result
        return new RuleResult($groupName, []);
    }
}