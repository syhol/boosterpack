<?php

namespace Boosterpack\Data;

use Boosterpack\Contracts\Data\InfiniteList;
use Boosterpack\Contracts\Data\Maybe;
use Boosterpack\Maybe\Just;
use Boosterpack\Maybe\Nothing;
use EmptyIterator;
use IteratorAggregate;
use Traversable;

class Generator implements IteratorAggregate, InfiniteList
{
    /**
     * @var callable
     */
    private $generatorFactory;

    /**
     * Generator constructor.
     * @param callable $generatorFactory
     */
    public function __construct(callable $generatorFactory)
    {
        $this->generatorFactory = $generatorFactory;
    }

    /**
     * @param callable $function
     * @return static
     */
    public function map(callable $function)
    {
        return $this->transform(function(Traversable $traversable) use ($function) {
            foreach ($traversable as $item) {
                yield $function($item);
            }
        });
    }

    /**
     * @param mixed $item
     * @return static
     */
    public function unshift($item)
    {
        return $this->transform(function(Traversable $traversable) use ($item) {
            yield $item;
            foreach ($traversable as $item) {
                yield $item;
            }
        });
    }

    public function transform(callable $callable)
    {
        return new self(function() use ($callable) {
            return $callable(call_user_func($this->generatorFactory));
        });
    }

    /**
     * @param callable $function
     * @return static
     */
    public function bind(callable $function)
    {
        return $this->transform(function(Traversable $traversable) use ($function) {
            foreach ($traversable as $item) {
                foreach($function($item) as $returnedItem) {
                    yield $returnedItem;
                }
            }
        });
    }

    /**
     * @return static
     */
    public static function fromEmpty()
    {
        return new self(function() {
            return new EmptyIterator();
        });
    }

    /**
     * @return static
     */
    public function getEmpty()
    {
        return self::fromEmpty();
    }

    /**
     * @param mixed $value
     * @return static
     */
    public function concat($value)
    {
        return $this->transform(function (Traversable $traversable) use ($value) {
            foreach ($traversable as $item) {
                yield $item;
            }
            foreach ($value as $item) {
                yield $item;
            }
        });
    }

    /**
     * @return Maybe[]|static[] [Maybe, static]
     */
    public function shift()
    {
        return [$this->first(), $this->dropAmount(1)];
    }

    /**
     * @return static
     */
    protected function dropAmount($size)
    {
        return $this->transform(function (Traversable $traversable) use ($size) {
            foreach ($traversable as $item) {
                $size <= 0 ? yield $item : $size--;
            }
        });
    }

    /**
     * @return Maybe
     */
    protected function first()
    {
        $item = new Nothing;

        foreach ($this as $value) {
            $item = new Just($value);
            break;
        }

        return $item;
    }

    /**
     * Retrieve an external iterator
     * @return Traversable
     */
    public function getIterator()
    {
        return call_user_func($this->generatorFactory);
    }
}