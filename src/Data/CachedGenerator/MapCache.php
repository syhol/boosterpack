<?php

namespace Boosterpack\Data\CachedGenerator;

class MapCache implements GeneratorCache
{
    /**
     * @var GeneratorCache
     */
    private $cache;

    /**
     * @var callable
     */
    private $function;

    /**
     * MapCache constructor.
     * @param GeneratorCache $cache
     * @param callable $function
     */
    public function __construct(GeneratorCache $cache, callable $function)
    {
        $this->cache = $cache;
        $this->function = $function;
    }

    /**
     * @param $offset
     * @return bool
     */
    public function has($offset)
    {
        return $this->cache->has($offset);
    }

    /**
     * @param $offset
     * @return mixed|null
     */
    public function get($offset)
    {
        $value = $this->cache->get($offset);
        return $this->cache->has($offset) ? $this->map($value) : $value ;
    }

    /**
     * @param $value
     * @return mixed
     */
    public function map($value)
    {
        $mapper = $this->function;
        return $mapper($value);
    }
}