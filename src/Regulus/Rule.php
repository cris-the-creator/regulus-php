<?php

declare(strict_types=1);

namespace Regulus;

interface Rule
{
    public function resolve(): RuleResult;
}