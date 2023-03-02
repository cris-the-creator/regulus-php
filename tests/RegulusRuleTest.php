<?php

declare(strict_types=1);

class RegulusRuleTest extends \PHPUnit\Framework\TestCase
{
    private static \PHPUnit\Framework\MockObject\Stub $rule1;
    private static \PHPUnit\Framework\MockObject\Stub $rule2;

    function setUp(): void
    {
        self::$rule1 = $this->createMock(\Regulus\Rule::class);
        $ruleResult1 = new \Regulus\RuleResult(self::$rule1::class . '1', []);
        self::$rule1->method('getRuleResult')->willReturn($ruleResult1);

        self::$rule2 = $this->createMock(\Regulus\Rule::class);
        $ruleResult2 = new \Regulus\RuleResult(self::$rule2::class . '2', []);
        self::$rule2->method('getRuleResult')->willReturn($ruleResult2);
    }

    /**
     * @throws \Regulus\Exception\ResolverException
     * @throws \Regulus\Exception\RuleGroupException
     */
    public function testSingleRule()
    {
        $ruleGroup = $this->createMock(\Regulus\RuleGroup::class);
        $ruleGroup->method('findRule')->willReturn(self::$rule1);

        $resolver = new \Regulus\Resolver();
        $resolver->addGroup($ruleGroup);
        $ruleResult = $resolver->resolve(self::$rule1::class);

        $this->assertEquals(\Regulus\RuleResult::class, $ruleResult::class);
    }

    public function testRuleGroup()
    {
        $testGroupTitle = 'row_rules';

        $ruleGroup = $this->createMock(\Regulus\RuleGroup::class);
        $ruleGroup->method('findRules')->with($testGroupTitle)->willReturn([self::$rule1, self::$rule2]);

        $resolver = new \Regulus\Resolver($ruleGroup);
        $ruleResults = $resolver->resolveGroup($testGroupTitle);

        $this->assertCount(2, count($ruleResults));
    }

    public function testAllRules()
    {

    }
}