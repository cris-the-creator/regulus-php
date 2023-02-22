<?php
declare(strict_types=1);

namespace Regulus;

use Regulus\Exception\ResolverException;

class Resolver
{
    public function __construct(private readonly Outcome $outcome) {}

    /**
     * @throws ResolverException
     */
    public function resolve(string $ruleName): ?RuleResult
    {
        $rule = $this->outcome->findRule($ruleName);
        if (null === $rule) {
            throw new ResolverException('Resolve rule not found.');
        }

        return $rule->getRuleResult();
    }
}