<?php

declare(strict_types=1);

namespace Regulus\Tests;

use PHPUnit\Event\NoPreviousThrowableException;
use PHPUnit\Framework\InvalidArgumentException;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use Regulus\Condition;
use Regulus\Exception\OutcomeException;
use Regulus\Outcome;
use Regulus\Rule;

class OutcomeTest extends TestCase
{

    /**
     * @throws OutcomeException
     * @throws Exception
     */
    public function testInitialize()
    {
        $rule = $this->createStub(Rule::class);

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
                $this->createStub('Regulus\Rule')
            );
        }

        // Rule 2
        $hasCreditsReached = $this->createStub(Condition::class);
        $hasCreditsReached->method('isFulfilled')->willReturn(true);
        if ($hasCreditsReached->isFulfilled()) {
            $outcome->addRule(
                $this->createStub('Regulus\Rule')
            );
        }

        $this->assertTrue(true);
    }
}