<?php

declare(strict_types=1);

namespace Regulus\Tests;

use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;

class RuleTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testInitialize()
    {
        $conditions = ['test_condition1, test_condition2'];

        $rule = $this->createStub('Regulus\Rule');
        $rule->method('getName')->willReturn('test_rule');
        $rule->method('getConditions')->willReturn($conditions);

        
        $this->assertInstanceOf('\Regulus\Rule', $rule);
        $this->assertEquals('test_rule', $rule->getName());
        $this->assertEquals($conditions, $rule->getConditions());
    }
}