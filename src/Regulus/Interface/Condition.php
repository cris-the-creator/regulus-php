<?php

declare(strict_types=1);

namespace Regulus\Interface;

interface Condition
{
    public function isFulfilled(): bool;
}