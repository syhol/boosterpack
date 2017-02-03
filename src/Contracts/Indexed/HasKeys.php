<?php

namespace Boosterpack\Contracts\Indexed;

interface HasKeys
{
    /**
     * @return Vector
     */
    public function keys();
}