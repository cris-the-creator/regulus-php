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
        $ruleResult = $this->createStub(Core\RuleResult::class);

        $rule = $this->createStub(Interface\Rule::class);
        $rule->expects($this->once())->method('resolve')->willReturn($ruleResult);

        $this->assertEquals($rule->resolve(), $ruleResult);
    }
}