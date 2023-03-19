<?php
declare(strict_types=1);

namespace Regulus;
class ConditionTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function testInit()
    {
        $condition = $this->createStub(Interface\Condition::class);
        $condition->method('isFulfilled')->willReturn(true);

        $this->assertTrue($condition->isFulfilled());
    }
}