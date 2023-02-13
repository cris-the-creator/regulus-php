<?php

declare(strict_types=1);

namespace Regulus\Exception;

use Exception;

abstract class AbstractRegulusException extends Exception
{
    public function __construct(string $message, $code = 0)
    {
        parent::__construct($message, $code);
    }

    public function __toString(): string
    {
        return __CLASS__ . ": [$this->code]: $this->message\n";
    }
}