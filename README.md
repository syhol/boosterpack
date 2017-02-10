
## Next Steps
* Spec test existing functions
* Implement partials functions
* Implement Vector

## Thoughts
* Remove `Boosterpack\Contracts\Data\Char`
* Move `Boosterpack\Contracts\Data\String`
* Do something better with `Boosterpack\Contracts\Data\Table`
* Make resize interfaces bigger
    * `ShrinkableStart` to have `take`, `drop`, `head`, to extend `Traversable`
    * `ShrinkableEnd` to have `takeEnd`, `dropEnd`, `end`
    * `GrowableStart` to have `prepend`
    * `GrowableEnd` to have `append`, to extend `Setoid`
