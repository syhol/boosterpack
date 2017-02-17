<?php

namespace Boosterpack\Data\CachedGenerator;

class BindCache implements GeneratorCache
{
    /**
     * @var GeneratorCache
     */
    private $cache;

    /**
     * @var array
     */
    private $cacheReference = [];

    /**
     * @var callable
     */
    private $function;

    /**
     * @var integer
     */
    private $current = -1;

    /**
     * @var boolean
     */
    private $isFinished = false;

    /**
     * BindCache constructor.
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
        $this->generateUntil($offset);

        return isset($this->cacheReference[$offset]) ? $this->cache->has($this->cacheReference[$offset]) : false ;
    }

    /**
     * @param $offset
     * @return mixed|null
     */
    public function get($offset)
    {
        $this->generateUntil($offset);

        return isset($this->cacheReference[$offset]) ? $this->getBoundItem($offset) : null ;
    }

    private function generateUntil($offset)
    {
        while (count($this->cacheReference) < ($offset + 1) && $this->isFinished === false) {
            $this->next();
        }
    }

    /**
     * @param $offset
     * @return mixed
     */
    private function getBoundItem($offset)
    {
        $values = $this->cache->get($this->cacheReference[$offset]);
        $mapper = $this->function;
        $boundIndex = $this->getBoundIndex($offset);
        $count = 0;
        foreach ($mapper($values) as $item) {
            if ($count === $boundIndex) {
                return $item;
            } else {
                $count++;
            }
        }
    }

    /**
     * @param $offset
     * @return int
     */
    private function getBoundIndex($offset)
    {
        $index = 0;

        while (
            isset($this->cacheReference[$offset - 1])
            && $this->cacheReference[$offset] === $this->cacheReference[$offset - 1]
        ) {
            $index++;
            $offset--;
        }

        return $index;
    }

    private function next()
    {
        $this->current++;
        if ($this->cache->has($this->current) === false) {
            $this->isFinished = true;
        } else {
            $values = $this->cache->get($this->current);
            $mapper = $this->function;
            foreach ($mapper($values) as $_) {
                $this->cacheReference[] = $this->current;
            }
        }
    }
}