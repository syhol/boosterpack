# Boosterpack
The missing php functions and structures

## Next Steps
* Implement partials functions
* Implement Vector

## Thoughts
* Things to rethink:
    * `Boosterpack\Contracts\Morphable`
    * `Boosterpack\Contracts\Orderable`
    * `Boosterpack\Contracts\Bounded`
    * `Boosterpack\Contracts\Enum`
    * `Boosterpack\Contracts\Data\Table`
    * `Boosterpack\Contracts\Data\String`
    * `Boosterpack\Contracts\Data\Char`
    * `Boosterpack\Contracts\Data\Result`
* Make resize interfaces bigger
    * `ShrinkableStart` to extend `Traversable`
    * `GrowableStart` to have `prepend`
    * `GrowableEnd` to have `append`, to extend `Semigroup`
