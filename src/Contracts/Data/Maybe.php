<?php

namespace Boosterpack\Contracts\Data;

use Boosterpack\Contracts\Fantasy\Monad;
use Boosterpack\Contracts\Arrayable;
use Boosterpack\Contracts\Fantasy\Setoid;
use Boosterpack\Maybe\Just;

interface Maybe extends Monad, Setoid, Arrayable
{
    /**
     * @param callable $callable
     * @return Maybe
     */
    public function orBind(callable $callable);

    /**
     * @param mixed $default
     * @return Just
     */
    public function orValue($default);

    /**
     * @param callable $callable
     * @return Just
     */
    public function orElse(callable $callable);

    /**
     * @param string $message the exception message to use when throwing
     * @return mixed
     */
    public function expect($message);
}