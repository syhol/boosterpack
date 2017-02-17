<?php

namespace Boosterpack\Data\CachedGenerator;

class NoopCache implements GeneratorCache
{
    /**
     * @param $offset
     * @return bool
     */
    public function has($offset)
    {
        return false;
    }

    /**
     * @param $offset
     * @return mixed|null
     */
    public function get($offset)
    {
        return null;
    }
}