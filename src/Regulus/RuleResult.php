<?php

declare(strict_types=1);

namespace Regulus;

class RuleResult
{
    public function __construct(
        private readonly bool $isFulfilled,
        private readonly array $succeededRules,
        private readonly array $failedRules,
        private readonly array $failedConditions,
        private readonly array $succeededConditions
    ) {}

    public function isFulfilled(): bool
    {
        return $this->isFulfilled;
    }

    public function getFailedRules(): array
    {
        return $this->failedRules;
    }

    /**
     * @return string[]
     */
    public function getSucceededRules(): array
    {
        return $this->succeededRules;
    }

    public function getFailedConditions(): array
    {
        return $this->failedConditions;
    }

    public function getSucceededConditions(): array
    {
        return $this->succeededConditions;
    }
}