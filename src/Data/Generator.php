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
     * @param callable $callable
     * @return Generator
     */
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
    public function map(callable $function)
    {
        return $this->transform(function(Traversable $traversable) use ($function) {
            foreach ($traversable as $item) {
                yield $function($item);
            }
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
     * @return static
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
     * @param $count
     * @return static
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
     * @param $count
     * @return Vector
     */
    public function take($count)
    {
        $new = new StdVector([]);
        if ($count < 0) {
            return $new;
        }
        foreach ($this as $item) {
            $new = $new->push($item);
            $count--;
            if ($count <= 0) break;
        }
        return $new;
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