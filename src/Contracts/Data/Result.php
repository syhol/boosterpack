<?php

namespace Boosterpack\Contracts\Data;

use Boosterpack\Contracts\Fantasy\Comonad;
use Boosterpack\Contracts\Fantasy\Monad;
use Boosterpack\Contracts\Arrayable;
use Boosterpack\Contracts\Fantasy\Setoid;
use Boosterpack\Result\Error;
use Boosterpack\Result\Ok;
use Throwable;

interface Result extends Monad, Setoid, Arrayable, Comonad
{
    /**
     * @param callable $callable
     * @return Error
     */
    public function mapError(callable $callable);

    /**
     * @param callable $callable
     * @return Result
     */
    public function bindError(callable $callable);

    /**
     * @param mixed $default
     * @return Ok
     */
    public function orValue($default);

    /**
     * @param mixed $default
     * @return Ok
     */
    public function andValue($default);

    /**
     * @throws Throwable
     */
    public function throwIt();
}