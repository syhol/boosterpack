<?php

namespace Boosterpack\Data\CachedGenerator;

class OffsetCache implements GeneratorCache
{
    /**
     * @var GeneratorCache
     */
    private $cache;

    /**
     * @var integer
     */
    private $offset;

    /**
     * OffsetCache constructor.
     * @param GeneratorCache $cache
     * @param integer $offset
     */
    public function __construct(GeneratorCache $cache, $offset)
    {
        $this->cache = $cache;
        $this->offset = $offset;
    }

    /**
     * @param $offset
     * @return bool
     */
    public function has($offset)
    {
        return $this->cache->has($offset + $this->offset);
    }

    /**
     * @param $offset
     * @return mixed|null
     */
    public function get($offset)
    {
        return $this->cache->get($offset + $this->offset);
    }
}