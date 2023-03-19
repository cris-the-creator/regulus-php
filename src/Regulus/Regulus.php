<?php

declare(strict_types=1);

namespace Regulus;

use Regulus\Exception\RuleGroupException;

/**
 * Facade for easy rule management.
 */
class Regulus
{
    private bool $strictMode = false;

    /**
     * @var RuleGroup[]
     */
    private array $groups;
    public function __construct(private readonly Resolver $resolver) {}

    public function enableStrictMode(): void
    {
        $this->strictMode = true;
    }

    /**
     * @param string $groupName
     * @throws RuleGroupException
     */
    public function createGroup(string $groupName): void
    {
        if ($this->strictMode && in_array($groupName, $this->groups)) {
            throw new RuleGroupException('STRICT MODE: Group Name already exists.');
        }

        $this->groups[$groupName] = new RuleGroup($groupName);
    }

    /**
     * @param string $groupName
     * @param Rule $rule
     * @throws RuleGroupException
     */
    public function addRuleTo(string $groupName, Rule $rule): void
    {
        $this->ensureGroupExist($groupName);

        if ($this->strictMode && $this->groups[$groupName]->findRule($rule::class)) {
            throw new RuleGroupException("STRICT MODE: Rule $rule::class already exists in this Group.");
        }

        $this->groups[$groupName]->add($rule);
    }

    /**
     * @param string $groupName
     * @param string $ruleName
     * @return RuleResult
     * @throws RuleGroupException
     */
    public function resolveRuleIn(string $groupName, string $ruleName): RuleResult
    {
        $this->ensureGroupExist($groupName);

        $rule = $this->groups[$groupName]->findRule($ruleName);
        if (null === $rule) {
            throw new RuleGroupException('Rule not found.');
        }

        return $rule->resolve();
    }

    /**
     * @param string $groupName
     * @return RuleResult
     * @throws RuleGroupException
     */
    public function resolveGroup(string $groupName): RuleResult
    {
        $this->ensureGroupExist($groupName);

        $rules = $this->groups[$groupName]->getRules();

        return $this->resolver->resolveRules($rules);
    }

    public function resolveAll(): RuleResult
    {
        return $this->resolver->resolveGroups($this->groups);
    }

    /**
     * @param string $groupName
     * @return void
     * @throws RuleGroupException
     */
    private function ensureGroupExist(string $groupName): void
    {
        if (!array_key_exists($groupName, $this->groups)) {
            throw new RuleGroupException("Group $groupName not found.");
        }
    }
}