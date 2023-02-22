<?php
declare(strict_types=1);

class ConditionTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function testInit()
    {
        $condition = $this->createStub(\Regulus\Condition::class);
        $condition->method('isFulfilled')->willReturn(true);

        $this->assertTrue($condition->isFulfilled());
    }
}