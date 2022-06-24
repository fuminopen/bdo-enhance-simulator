<?php

namespace App\ValueObjects;

use InvalidArgumentException;

final class FailStack
{
    private const MINIMUM = 0;

    /**
     * @var int
     */
    public readonly int $stack;

    /**
     * __construct
     *
     * @param  int|float $stack Accepts float to avoid loss of precision by implicit conversion. Float will be rejected by check on constructor if passed.
     * @return void
     */
    public function __construct(int|float $stack = self::MINIMUM)
    {
        if ($this->assertInvalidArguments($stack)) {
            throw new InvalidArgumentException('Fail stack must be natural integer including zero.');
        }

        $this->stack = $stack;
    }

    /**
     * assertInvalidArguments
     *
     * @param  int|float $stack
     * @return bool
     */
    private function assertInvalidArguments(int|float $stack): bool
    {
        if (!is_integer($stack)) {
            return true;
        }

        if ($stack < 0) {
            return true;
        }

        return false;
    }
}
