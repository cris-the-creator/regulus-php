<?php
declare(strict_types=1);

namespace Regulus;
use PHPUnit\Framework\MockObject\Exception;
use Regulus\Core\AbstractRule;
use Regulus\Core\RuleResult;
use Regulus\Interface\Condition;

class RuleResultTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @throws Exception
     */
    public function testInit()
    {
        $ruleResult = new RuleResult(
            true,
            [$this->createStub(AbstractRule::class)],
            [$this->createStub(AbstractRule::class)],
            [$this->createStub(Condition::class)],
            [$this->createStub(Condition::class)]
        );

        $this->assertTrue($ruleResult->isFulfilled());
        $this->assertCount(1, $ruleResult->getSucceededRules());
        $this->assertCount(1, $ruleResult->getFailedRules());
        $this->assertCount(1, $ruleResult->getFailedConditions());
        $this->assertCount(1, $ruleResult->getSucceededConditions());
    }
}