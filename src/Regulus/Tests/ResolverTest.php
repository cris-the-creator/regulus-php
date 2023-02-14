<?php

declare(strict_types=1);

namespace Regulus\Tests;

use PHPUnit\Framework\TestCase;

class ResolverTest extends TestCase
{
    public function testInit()
    {
        $ruleResult = $this->createStub('Regulus\RuleResult');
        $ruleResult->method('isFulfilled')->willReturn(false);

        $outcome = $this->createStub('Regulus\Outcome');
        $outcome->method('findRule')->willReturn($ruleResult);

        $resolver = new \Regulus\Resolver($outcome);
        $this->assertEquals($resolver->resolve('test'), $ruleResult);
    }
}