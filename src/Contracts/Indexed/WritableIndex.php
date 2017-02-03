<?php

namespace Boosterpack\Contracts\Indexed;

interface WritableIndex
{
    /**
     * @param $index
     * @param $value
     * @return static
     */
    public function setIfAbsent($index, $value);

    /**
     * @param $index
     * @param $value
     * @return static
     */
    public function set($index, $value);
}