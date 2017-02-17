<?php

namespace Boosterpack\Data\CachedGenerator;

interface GeneratorCache
{
    /**
     * @param $offset
     * @return bool
     */
    public function has($offset);

    /**
     * @param $offset
     * @return mixed|null
     */
    public function get($offset);
}