<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class ResolverTest extends TestCase
{
    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     * @throws \Regulus\Exception\ResolverException
     */
    public function testInit()
    {
        /*$ruleResult = $this->createStub('Regulus\RuleResult');
        $ruleResult->method('isFulfilled')->willReturn(false);*/

        $ruleResult = $this->createStub(\Regulus\RuleResult::class);

        $resolver = $this->createStub(\Regulus\Resolver::class);
        $resolver->method('resolve')->willReturn($ruleResult);

        $this->assertEquals($resolver->resolve('test'), $ruleResult);
    }
}