<?php
declare(strict_types=1);

namespace Regulus;

use Regulus\Exception\ResolverException;

readonly class Resolver
{
    public function __construct(private Outcome $outcome) {}

    /**
     * @throws ResolverException
     */
    public function resolve(string $ruleName)
    {
        $rule = $this->outcome->findRule($ruleName);
        if (null === $rule) {
            throw new ResolverException('Resolve rule not found.');
        }

        return $rule->getRuleResult();
    }
}