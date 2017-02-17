<?php

namespace Boosterpack\Data\CachedGenerator;

class PrefixedCache implements GeneratorCache
{
    /**
     * @var GeneratorCache
     */
    private $cache;

    /**
     * @var array
     */
    private $prefix;

    /**
     * PrefixedCache constructor.
     * @param GeneratorCache $cache
     * @param array $prefix
     */
    public function __construct(GeneratorCache $cache, array $prefix)
    {
        $this->cache = $cache;
        $this->prefix = array_values($prefix);
    }

    /**
     * @param $offset
     * @return bool
     */
    public function has($offset)
    {
        if ($offset < count($this->prefix)) {
            return true;
        }

        return $this->cache->has($offset - count($this->prefix));
    }

    /**
     * @param $offset
     * @return mixed|null
     */
    public function get($offset)
    {
        if ($offset < count($this->prefix)) {
            return $this->prefix[$offset];
        }

        return $this->cache->get($offset - count($this->prefix));
    }
}
