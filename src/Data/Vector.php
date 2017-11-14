<?php

namespace Boosterpack\Data;

use ArrayIterator;
use Boosterpack\Contracts\Data\Maybe;
use Boosterpack\Contracts\Data\Vector as VectorInterface;
use Boosterpack\Maybe\Just;
use Boosterpack\Maybe\Nothing;
use IteratorAggregate;
use Traversable;
use UnexpectedValueException;

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
     * Retrieve an external iterator
     * @return Traversable
     */
    public function getIterator()
    {
        return new ArrayIterator($this->items);
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
     * @param callable $function
     * @return static
     */
    public function flatMap(callable $function)
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
    public function append($value)
    {
        $new = $this->items;
        foreach ($value as $item) array_push($new, $item);
        return new self($new);
    }

    /**
     * @param mixed $value
     * @return static
     */
    public function prepend($value)
    {
        $new = $this->items;
        foreach ($value as $item) array_unshift($new, $item);
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
     * @return Maybe[]|static[] [Maybe, static]
     */
    public function pop()
    {
        return [$this->end(), $this->init()];
    }

    /**
     * @return static
     */
    public function tail()
    {
        return $this->drop(1);
    }

    /**
     * @return static
     */
    public function init()
    {
        return $this->dropEnd(1);
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
     * @return Maybe
     */
    public function end()
    {
        $items = $this->items;
        return empty($items) ? new Nothing() : new Just(array_pop($items));
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
     * @param $count
     * @return static
     */
    public function dropEnd($count)
    {
        $new = $this->items;
        return new self(array_slice($new, 0, count($new) - $count));
    }

    /**
     * @param $count
     * @return VectorInterface
     */
    public function takeEnd($count)
    {
        $new = $this->items;
        return new self(array_slice($new, -$count));
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
     * @param mixed $value
     * @return VectorInterface
     */
    public function keysOf($value)
    {
        $new = new self;
        foreach ($this->items as $key => $item) {
            if ($item === $value) {
                $new = $new->push($key);
            }
        }
        return $new;
    }

    /**
     * @param callable $callable
     * @return VectorInterface
     */
    public function findKeys(callable $callable)
    {
        $new = new self;
        foreach ($this->items as $key => $item) {
            if ($callable($item)) {
                $new = $new->push($key);
            }
        }
        return $new;
    }

    /**
     * @return VectorInterface
     */
    public function pairs()
    {
        $new = new self;
        foreach ($this->items as $key => $value) {
            $new = $new->push([$key, $value]);
        }
        return $new;
    }

    /**
     * @param $pairs
     * @return static
     */
    public static function unPairs($pairs)
    {
        $new = new self;
        foreach ($pairs as $pair) {
            $new = $new->push(array_pop($pair));
        }
        return $new;
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
        return count($this->items);
    }

    /**
     * @param mixed $other
     * @return bool
     */
    public function equals($other)
    {
        return $other->toArray() === $this->items;
    }

    /**
     * @param callable|null $callable
     * @return static
     */
    public function sort(callable $callable = null)
    {
        $new = $this->items;
        is_callable($callable) ? usort($new, $callable) : natsort($new);
        return new self($new);
    }

    /**
     * @return static
     */
    public function reverse()
    {
        return new self(array_reverse($this->items));
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
        return $this->items;
    }

    /**
     * @param mixed $value
     * @return boolean
     */
    public function hasKey($value)
    {
        return array_key_exists($value, $this->items);
    }

    /**
     * @param mixed $value
     * @return boolean
     */
    public function hasValue($value)
    {
        return in_array($this->items, $value);
    }

    /**
     * @param mixed $index
     * @return Maybe
     */
    public function valueAt($index)
    {
        return $this->hasKey($index) ? new Just($this->items[$index]) : new Nothing();
    }

    /**
     * @return mixed
     */
    public function extract()
    {
        if (count($this->items) !== 1) {
            throw new UnexpectedValueException();
        }

        return $this->items[0];
    }
}