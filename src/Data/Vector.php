<?php

namespace Boosterpack\Data;

use ArrayIterator;
use Boosterpack\Contracts\Data\Maybe;
use Boosterpack\Contracts\Data\Vector as VectorInterface;
use Boosterpack\Maybe\Just;
use Boosterpack\Maybe\Nothing;
use EmptyIterator;
use IteratorAggregate;
use Traversable;

class Vector implements IteratorAggregate, VectorInterface
{
    /**
     * @var array
     */
    private $items;

    /**
     * Vector constructor.
     * @param array $items
     */
    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    /**
     * @param callable $function
     * @return static
     */
    public function map(callable $function)
    {
        $new = $this->getEmpty();
        foreach ($this->items as $item) {
            $new->push($function($item));
        }
        return $new;
    }

    /**
     * @param mixed $item
     * @return static
     */
    public function unshift($item)
    {
        $items = $this->items;
        array_unshift($items, $item);
        new self($items);
    }

    /**
     * @param callable $function
     * @return static
     */
    public function bind(callable $function)
    {
        $new = $this->getEmpty();
        foreach ($this->items as $item) {
            foreach ($function($item) as $child) {
                $new->push($child);
            }
        }
        return $new;
    }

    /**
     * @return static
     */
    public static function fromEmpty()
    {
        return new self([]);
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
        $new = $this->items;
        foreach ($value as $item) array_push($new, $item);
        return new self($new);
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
     * Retrieve an external iterator
     * @return Traversable
     */
    public function getIterator()
    {
        return new ArrayIterator($this->items);
    }

    /**
     * @param $count
     * @return static
     */
    public function drop($count)
    {
        $new = $this->items;
        return new self(array_slice($new, $count));
    }

    /**
     * @param $count
     * @return Vector
     */
    public function take($count)
    {
        $new = $this->items;
        return new self(array_slice($new, 0, $count));
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->items;
    }

    /**
     * @param callable $function
     * @param mixed $initial
     * @return mixed
     */
    public function reduce(callable $function, $initial)
    {
        return array_reduce($this->items, $function, $initial);
    }

    /**
     * @param mixed $item
     * @return static
     */
    public function push($item)
    {
        $items = $this->items;
        array_push($items, $item);
        return new self($items);
    }

    /**
     * @return VectorInterface
     */
    public function keys()
    {
        return array_keys($this->items);
    }

    /**
     * @return VectorInterface
     */
    public function values()
    {
        return array_values($this->items);
    }

    /**
     * @param mixed $index
     * @param callable $callable
     * @return static
     */
    public function mapAt($index, callable $callable)
    {
        if (isset($this->items[$index])) {
            $new = $this->items;
            $new[$index] = $callable($new[$index]);
            return new self($new);
        }
        return $this;
    }

    /**
     * @param callable $callable
     * @return static
     */
    public function mapWithKeys(callable $callable)
    {
        // TODO: Implement mapWithKeys() method.
    }

    /**
     * @param callable $callable
     * @return static
     */
    public function mapKeys(callable $callable)
    {
        // TODO: Implement mapKeys() method.
    }

    /**
     * @param mixed $value
     * @return VectorInterface
     */
    public function keysOf($value)
    {
        // TODO: Implement keysOf() method.
    }

    /**
     * @param callable $callable
     * @return VectorInterface
     */
    public function findKeys(callable $callable)
    {
        // TODO: Implement findKeys() method.
    }

    /**
     * @return VectorInterface
     */
    public function pairs()
    {
        // TODO: Implement pairs() method.
    }

    /**
     * @param $pairs
     * @return static
     */
    public static function unPairs($pairs)
    {
        // TODO: Implement unPairs() method.
    }

    /**
     * Count elements of an object
     * @link http://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * </p>
     * <p>
     * The return value is cast to an integer.
     * @since 5.1.0
     */
    public function count()
    {
        // TODO: Implement count() method.
    }

    /**
     * @param mixed $other
     * @return bool
     */
    public function equals($other)
    {
        // TODO: Implement equals() method.
    }

    /**
     * @return Maybe[]|static[] [Maybe, static]
     */
    public function pop()
    {
        // TODO: Implement pop() method.
    }

    /**
     * @return static
     */
    public function init()
    {
        // TODO: Implement init() method.
    }

    /**
     * @return Maybe
     */
    public function end()
    {
        // TODO: Implement end() method.
    }

    /**
     * @param $count
     * @return static
     */
    public function dropEnd($count)
    {
        // TODO: Implement dropEnd() method.
    }

    /**
     * @param $count
     * @return VectorInterface
     */
    public function takeEnd($count)
    {
        // TODO: Implement takeEnd() method.
    }

    /**
     * @param callable|null $callable
     * @return static
     */
    public function sort(callable $callable = null)
    {
        // TODO: Implement sort() method.
    }

    /**
     * @param callable|null $callable
     * @return static
     */
    public function reverse(callable $callable = null)
    {
        // TODO: Implement reverse() method.
    }

    /**
     * @param mixed $index
     * @return Maybe
     */
    public function elementAt($index)
    {
        // TODO: Implement elementAt() method.
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize()
    {
        // TODO: Implement jsonSerialize() method.
    }
}