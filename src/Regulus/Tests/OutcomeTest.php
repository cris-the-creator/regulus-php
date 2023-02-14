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
    public function testNoTwoRulesOfSameClass()
    {
        $rule = $this->createStub(Rule::class);

        $outcome = new Outcome();
        $outcome->addRule($rule);

        $this->expectException(OutcomeException::class);
        $outcome->addRule($rule);
    }

    public function testFindRule()
    {
        $rule = $this->createStub(Rule::class);
        $outcome = new Outcome();
        $outcome->addRule($rule);

        $this->assertEquals($outcome->findRule($rule::class), $rule);
        $this->assertNull($outcome->findRule('NonExistingClassName'));
    }
}