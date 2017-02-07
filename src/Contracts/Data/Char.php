<?php

namespace Boosterpack\Contracts\Data;

use Boosterpack\Contracts\Bounded;
use Boosterpack\Contracts\Enum;
use Boosterpack\Contracts\Orderable;

interface Char extends Orderable, Bounded, Enum
{
    public function isAlpha();
    public function isNumeric();
    public function isBlank();
    public function isLetter();
    public function isAscii();
    public function isLowerCase();
    public function isUpperCase();
    public function toLowerCase();
    public function toUpperCase();
}