<?php

declare(strict_types=1);

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Regulus\Core\Resolver;
use Regulus\Core\RuleResult;
use Regulus\Exception\RuleGroupException;
use Regulus\Interface\Condition;
use Regulus\Interface\Rule;
use Regulus\Regulus;

class RegulusRuleTest extends TestCase
{
    private static MockObject $rule;
    private static MockObject $condition;

    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    function setUp(): void
    {
        self::$rule = $this->createMock(Rule::class);
        self::$condition = $this->createMock(Condition::class);
    }

    /**
     * @return Regulus
     * @throws RuleGroupException
     */
    public function testSingleRule(): Regulus
    {
        $resolver = new Resolver();
        $regulus = new Regulus($resolver);

        $isFulfilled = true;
        $ruleResultStub = new RuleResult($isFulfilled, [self::$rule], [], [], [self::$condition]);
        self::$rule->method('resolve')->willReturnReference($ruleResultStub);
        self::$condition->method('isFulfilled')->willReturn($isFulfilled);

        $regulus->createGroup('test_group');
        $regulus->addRuleTo('test_group', self::$rule);

        $ruleResult = $regulus->resolveRuleIn('test_group', self::$rule::class);
        $this->assertNotNull($ruleResult::class);
        $this->assertTrue($ruleResult->isFulfilled());
        $this->assertCount(1, $ruleResult->getSucceededRules());
        $this->assertCount(1, $ruleResult->getSucceededConditions());

        return $regulus;
    }

    /**
     * @depends testSingleRule
     * @param Regulus $regulus
     * @return Regulus
     * @throws RuleGroupException
     */
    public function testRuleGroup(Regulus $regulus): Regulus
    {
        $ruleResult = $regulus->resolveGroup('test_group');

        $this->assertNotNull($ruleResult);
        $this->assertTrue($ruleResult->isFulfilled());
        $this->assertCount(1, $ruleResult->getSucceededRules());
        $this->assertCount(1, $ruleResult->getSucceededConditions());

        return $regulus;
    }

    /**
     * @depends testRuleGroup
     * @param Regulus $regulus
     * @return void
     * @throws RuleGroupException
     */
    public function testAllRules(Regulus $regulus): void
    {
        $regulus->createGroup('test_group_two');
        $regulus->addRuleTo('test_group_two', self::$rule);

        $ruleResult = $regulus->resolveAll();
        $this->assertNotNull($ruleResult);
        $this->assertFalse($ruleResult->isFulfilled());
        $this->assertCount(1, $ruleResult->getSucceededRules());
        $this->assertCount(1, $ruleResult->getFailedRules());
    }
}