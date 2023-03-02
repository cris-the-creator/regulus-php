<?php
declare(strict_types=1);

namespace Regulus;
class RuleTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function testInit()
    {
        $ruleResult = $this->createStub(\Regulus\RuleResult::class);

        $rule = $this->createStub(\Regulus\Rule::class);
        $rule->expects($this->once())->method('getRuleResult')->willReturn($ruleResult);

        $this->assertEquals($rule->getRuleResult(), $ruleResult);
    }
}