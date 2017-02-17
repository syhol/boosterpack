<?php

namespace Boosterpack\Data\CachedGenerator;

class ConcatCache implements GeneratorCache
{
    /**
     * @var GeneratorCache
     */
    private $cacheOne;

    /**
     * @var GeneratorCache
     */
    private $cacheTwo;

    /**
     * @var null|integer
     */
    private $cacheOneSize = null;

    /**
     * ConcatCache constructor.
     * @param GeneratorCache $cacheOne
     * @param GeneratorCache $cacheTwo
     */
    public function __construct(GeneratorCache $cacheOne, GeneratorCache $cacheTwo)
    {
        $this->cacheOne = $cacheOne;
        $this->cacheTwo = $cacheTwo;
    }

    /**
     * @param $offset
     * @return bool
     */
    public function has($offset)
    {
        if ($this->cacheOne->has($offset)) {
            return true;
        }

        $cacheOneSize = $this->cacheOneSize($offset);

        return $this->cacheTwo->has($cacheOneSize + $offset);
    }

    /**
     * @param $offset
     * @return mixed|null
     */
    public function get($offset)
    {
        if ($this->cacheOne->has($offset)) {
            return $this->cacheOne->get($offset);
        }

        $cacheOneSize = $this->cacheOneSize($offset);

        return $this->cacheTwo->get($cacheOneSize + $offset);
    }

    /**
     * @param $offset
     * @return int|null
     */
    private function cacheOneSize($offset)
    {
        return $this->cacheOneSize = is_null($this->cacheOneSize)
            ? $this->findCacheOneSize($offset)
            : $this->cacheOneSize;
    }

    /**
     * @param $from
     * @return int
     */
    private function findCacheOneSize($from)
    {
        while ($from-- && $from > 0) {
            if ($this->cacheOne->has($from)) {
                return $from + 1;
            }
        }

        return 0;
    }
}
