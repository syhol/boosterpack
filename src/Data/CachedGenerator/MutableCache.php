<?php

namespace Boosterpack\Data\CachedGenerator;

use Generator;

class MutableCache implements GeneratorCache
{
    /**
     * @var array
     */
    private $cache = [];

    /**
     * @var Generator
     */
    private $generator;

    /**
     * @var boolean
     */
    private $isFinished = false;

    /**
     * MutableCache constructor.
     * @param Generator $generator
     */
    public function __construct(Generator $generator)
    {
        $this->generator = $generator;
        $this->cache[] = $this->generator->current();
    }

    /**
     * @param $offset
     * @return bool
     */
    public function has($offset)
    {
        $this->generateUntil($offset);

        return isset($this->cache[$offset]);
    }

    /**
     * @param $offset
     * @return mixed|null
     */
    public function get($offset)
    {
        $this->generateUntil($offset);

        return isset($this->cache[$offset]) ? $this->cache[$offset] : null ;
    }

    private function generateUntil($offset)
    {
        while (count($this->cache) < ($offset + 1) && $this->isFinished === false) {
            $this->next();
        }
    }

    private function next()
    {
        $this->generator->next();

        if ($this->generator->valid()) {
            $this->cache[] = $this->generator->current();
        } else {
            $this->isFinished = true;
        }
    }
}