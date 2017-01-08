<?php

interface Sortable
{
    public function sort(callable $callable = null);
}