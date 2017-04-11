<?php

namespace Boosterpack;

use Generator;
use Iterator;

/**
 * Class RewindableGenerator
 * @package Boosterpack
 */
class RewindableGenerator implements Iterator
{
    /**
     * @var callable
     */
    protected $function;

    /**
     * @var array
     */
    protected $arguments;

    /**
     * @var Generator
     */
    protected $generator;

    /**
     * Generator constructor.
     * @param callable $function
     * @param array $arguments
     */
    public function __construct(callable $function, array $arguments = [])
    {
        $this->function = $function;
        $this->arguments = $arguments;
        $this->generator = null;
    }

    /**
     * @return Generator
     */
    protected function getGenerator()
    {
        if (!$this->generator) {
            $this->rewind();
        }
        return $this->generator;
    }

    /**
     * Recreate the generator to emulate rewinding it
     */
    public function rewind()
    {
        $function = $this->function;
        $this->generator = $function(...$this->arguments);
    }

    /**
     * Move the iterator to the next item
     */
    public function next()
    {
        $this->getGenerator()->next();
    }

    /**
     * @return bool
     */
    public function valid()
    {
        return $this->getGenerator()->valid();
    }

    /**
     * @return mixed
     */
    public function key()
    {
        return $this->getGenerator()->key();
    }

    /**
     * @return mixed
     */
    public function current()
    {
        return $this->getGenerator()->current();
    }

    /**
     * @param mixed $value
     * @return mixed
     */
    public function send($value = null)
    {
        return $this->getGenerator()->send($value);
    }

    /**
     * @param $method
     * @param $args
     * @return mixed
     */
    public function __call($method, $args)
    {
        if ($method === 'throw') {
            return $this->getGenerator()->throw(...$args);
        } else {
            // trigger normal undefined method error
            return $this->$method(...$args);
        }
    }
}
