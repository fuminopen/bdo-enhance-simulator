<?php

namespace App\ValueObjects;

use App\Exceptions\InvalidStackCountException;
use App\ValueObjects\Traits\GetIntValueTrait;
use InvalidArgumentException;

final class FailStack
{
    use GetIntValueTrait;

    private const MINIMUM = 0;

    /**
     * @var int
     */
    private readonly int $value;

    /**
     * __construct
     *
     * @param  int|float $stack Accepts float to avoid loss of precision by implicit conversion. Float will be rejected by check on constructor if passed.
     * @return void
     */
    public function __construct(int|float $stack = self::MINIMUM)
    {
        if ($this->assertInvalidArguments($stack)) {
            throw new InvalidStackCountException();
        }

        $this->value = $stack;
    }

    /**
     * addition
     *
     * @param  self $subtrahend
     * @return self
     */
    public function add(FailStack $addend): self
    {
        return new self($this->value + $addend->getValue());
    }

    /**
     * subtraction
     *
     * @param  self $subtrahend
     * @return self
     */
    public function sub(FailStack $subtrahend): self
    {
        if (($this->value - $subtrahend->getValue()) < self::MINIMUM) {
            return new self(self::MINIMUM);
        }

        return new self($this->value - $subtrahend->getValue());
    }

    /**
     * greater than
     *
     * @param  FailStack $subject
     * @return bool
     */
    public function gt(FailStack $subject): bool
    {
        return $this->value > $subject->getValue();
    }

    /**************************
     *
     * private methods
     *
     **************************/

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
