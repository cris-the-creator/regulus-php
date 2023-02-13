<?php

declare(strict_types=1);

namespace Regulus;

interface Condition
{
    public function isFulfilled(): bool;
}