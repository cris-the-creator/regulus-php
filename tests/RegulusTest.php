<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use Regulus\Exception\OutcomeException;
use Regulus\Rule;
use Regulus\Condition;
use Regulus\Outcome;

final class RegulusTest extends TestCase
{
    public function testNewCondition(): string
    {
        $condition = new Condition();

        $this->assertInstanceOf('\Regulus\Condition', $condition);
        return $condition::class;
    }

    #[Depends('testNewCondition')]
    public function testNewRule(string $condition): Rule
    {
        $rule = new Rule(
            'disable_row',
            [$condition]
        );

        $this->assertInstanceOf('\Regulus\Rule', $rule);
        return $rule;
    }

    /**
     * @throws OutcomeException
     */
    #[Depends('testNewRule')]
    public function testNewOutcome(Rule $rule): Outcome
    {
        $outcome = new Outcome();
        $outcome->addRule($rule);

        $this->assertInstanceOf('\Regulus\Outcome', $outcome);
        return $outcome;
    }

    #[Depends('testNewRule')]
    #[Depends('testNewOutcome')]
    public function testDuplicateRuleException(Rule $rule, Outcome $outcome): void
    {
        $this->expectException(OutcomeException::class);

        $outcome->addRule($rule);
    }
}