<?php

declare(strict_types=1);

namespace Regulus\Tests;

use PHPUnit\Framework\TestCase;
use Regulus\Rule;

class RuleTest extends TestCase
{
    public function testInitialize()
    {
        $conditions = ['test_condition1, test_condition2'];
        $rule = new Rule('test_rule', $conditions);
        $this->assertInstanceOf('\Regulus\Rule', $rule);

        $this->assertEquals('test_rule', $rule->getName());
        $this->assertEquals($conditions, $rule->getConditions());
    }
}