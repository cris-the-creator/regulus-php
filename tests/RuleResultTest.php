<?php
declare(strict_types=1);

class RuleResultTest extends \PHPUnit\Framework\TestCase
{
    public function testInit()
    {
        $ruleResult = $this->createStub(\Regulus\RuleResult::class);
        $ruleResult->method('getRuleName')->willReturn('test');
        $ruleResult->method('getConditionNames')->willReturn(['condition1, condition2']);

        $this->assertEquals('test', $ruleResult->getRuleName());
        $this->assertTrue(count($ruleResult->getConditionNames()) === 2);
    }
}