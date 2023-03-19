<?php

declare(strict_types=1);

namespace Regulus;

use PHPUnit\Framework\TestCase;
use Regulus\Core\Resolver;

class ResolverTest extends TestCase
{

    public function testGroupResolve(): Resolver
    {
        $resolver = new Resolver();
        $ruleResult = $resolver->resolveGroups([]);

        $this->assertNotNull($ruleResult);
        $this->assertTrue($ruleResult->isFulfilled());

        return $resolver;
    }

    /**
     * @depends testGroupResolve
     * @return void
     */
    public function testRuleResolve(Resolver $resolver)
    {
        $ruleResult = $resolver->resolveRules([]);

        $this->assertNotNull($ruleResult);
        $this->assertTrue($ruleResult->isFulfilled());
    }
}