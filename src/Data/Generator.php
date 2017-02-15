<?php

namespace Boosterpack\Data;

use Boosterpack\Contracts\Data\InfiniteList;
use Boosterpack\Contracts\Data\Maybe;
use Boosterpack\Contracts\Data\Vector;
use Boosterpack\Data\Vector as StdVector;
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
        return [$this->head(), $this->tail()];
    }

    /**
     * @return self
     */
    public function tail()
    {
        return $this->drop(1);
    }

    /**
     * @return Maybe
     */
    public function head()
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

    /**
     * @param $count
     * @return self
     */
    public function drop($count)
    {
        return $this->transform(function (Traversable $traversable) use ($count) {
            $current = 0;
            foreach ($traversable as $item) {
                $current >= $count ? yield $item : $current++;
            }
        });
    }

    /**
     * @param $condition
     * @return self
     */
    public function dropWhile($condition)
    {
        // Not yet
    }

    /**
     * @param $count
     * @return Vector
     */
    public function take($count)
    {
        $new = new StdVector([]);
        foreach ($this as $item) {
            if ($count <= 0) break;
            $count--;
            $new = $new->push($item);
        }
        return $new;
    }

    /**
     * @param $condition
     * @return Vector
     */
    public function takeWhile($condition)
    {
        // Not yet
    }
}