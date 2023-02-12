<?php
declare(strict_types=1);

namespace Regulus\Tests;

use PHPUnit\Event\NoPreviousThrowableException;
use PHPUnit\Framework\InvalidArgumentException;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\MockObject\Stub;
use PHPUnit\Framework\TestCase;
use Regulus\Condition;
use Regulus\Exception\OutcomeException;
use Regulus\Outcome;
use Regulus\Rule;

class OutcomeTest extends TestCase
{

    /**
     * @throws OutcomeException
     */
    public function testInitialize()
    {
        $rule = $this->createStub(Rule::class);
        $rule->method('getName')->willReturn('test_rule');

        $outcome = new Outcome();
        $outcome->addRule($rule);

        $this->expectException(OutcomeException::class);
        $outcome->addRule($rule);
    }

    /**
     * @throws NoPreviousThrowableException
     * @throws Exception
     * @throws InvalidArgumentException
     * @throws OutcomeException
     */
    public function testRulesAdded()
    {
        $outcome = new Outcome();

        // Rule 1
        $isNotPassed = $this->createStub(Condition::class);
        $isNotPassed->method('isFulfilled')->willReturn(true);
        if (!$isNotPassed->isFulfilled()) {
            $outcome->addRule(
                new Rule('disable_row', [$isNotPassed::class])
            );
        }

        // Rule 2
        $hasCreditsReached = $this->createStub(Condition::class);
        $hasCreditsReached->method('isFulfilled')->willReturn(true);
        if ($hasCreditsReached->isFulfilled()) {
            $outcome->addRule(
                new Rule('max_credits_reached', [$hasCreditsReached::class])
            );
        }


    }
}