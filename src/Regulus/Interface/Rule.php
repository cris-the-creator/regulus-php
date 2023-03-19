<?php

declare(strict_types=1);

namespace Regulus\Interface;

use Regulus\Core\RuleResult;

interface Rule
{
    public function resolve(): RuleResult;
}