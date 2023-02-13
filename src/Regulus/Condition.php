<?php

declare(strict_types=1);

namespace Regulus;

abstract class Condition
{
    /**
     * @var callable
     */
    private $fulfilled;
    /**
     * @param string $name
     * @param callable $fullfiled
     */
    public function __construct(
        private readonly string $name,
        $fulfilled
    )
    {
        $this->fulfilled = $fulfilled;
    }

    public function getName(): string
    {
        return $this->name;
    }

    abstract public function isFulfilled(): bool;
}