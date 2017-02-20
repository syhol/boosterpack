<?php

namespace Boosterpack\Data;

use Boosterpack\Contracts\Data\InfiniteList;
use Boosterpack\Contracts\Data\Maybe;
use Boosterpack\Contracts\Data\Vector;
use Boosterpack\Data\CachedGenerator\BindCache;
use Boosterpack\Data\CachedGenerator\CacheIterator;
use Boosterpack\Data\CachedGenerator\ConcatCache;
use Boosterpack\Data\CachedGenerator\MapCache;
use Boosterpack\Data\CachedGenerator\OffsetCache;
use Boosterpack\Data\CachedGenerator\GeneratorCache;
use Boosterpack\Data\CachedGenerator\MutableCache;
use Boosterpack\Data\CachedGenerator\NoopCache;
use Boosterpack\Data\CachedGenerator\PrefixedCache;
use Boosterpack\Data\Vector as StdVector;
use Boosterpack\Maybe\Just;
use Boosterpack\Maybe\Nothing;
use IteratorAggregate;
use Traversable;

class CachedGenerator implements IteratorAggregate, InfiniteList
{
    /**
     * @var GeneratorCache
     */
    private $cache;

    /**
     * Generator constructor.
     * @param GeneratorCache $cache
     */
    public function __construct(GeneratorCache $cache)
    {
        $this->cache = $cache;
    }

    public static function fromGenerator(callable $generatorFactory)
    {
        return new self(new MutableCache($generatorFactory));
    }

    /**
     * @param callable $function
     * @return static
     */
    public function map(callable $function)
    {
        return new self(new MapCache($this->cache, $function));
    }

    /**
     * @param mixed $item
     * @return static
     */
    public function unshift($item)
    {
        return new self(new PrefixedCache($this->cache, [$item]));
    }

    /**
     * @param callable $function
     * @return static
     */
    public function bind(callable $function)
    {
        return new self(new BindCache($this->cache, $function));
    }

    /**
     * @return static
     */
    public static function fromEmpty()
    {
        return new self(new NoopCache());
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
        $generator = function() use ($value) {
            foreach ($value as $item) {
                yield $item;
            }
        };

        return new self(new ConcatCache($this->cache, new MutableCache($generator)));
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
     * @return CacheIterator
     */
    public function getIterator()
    {
        return new CacheIterator($this->cache);
    }

    /**
     * @param $count
     * @return static
     */
    public function drop($count)
    {
        return new self(new OffsetCache($this->cache, $count));
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
}