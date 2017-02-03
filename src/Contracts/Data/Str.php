<?php

namespace Boosterpack\Contracts\Data;

interface Str extends Vector
{
    public function between();
    public function collapseWhitespace();
    public function getEncoding();
    public function hasLowerCase();
    public function hasUpperCase();
    public function isAlpha();
    public function isAlphanumeric();
    public function isBlank();
    public function isLowerCase();
    public function isUpperCase();
    public function lowerCaseFirst();
    public function regexReplace();
    public function split($delimiter);
    public function swapCase();
    public function tidy();
    public function titleize();
    public function toAscii();
    public function toBoolean();
    public function toLowerCase();
    public function toUpperCase();
    public function toSpaces();
    public function toTabs();
    public function toTitleCase();
    public function safeTruncate();
    public function truncate();
    public function slugify();
    public function camelize();
    public function underscored();
    public function humanize();
    public function dasherize();
    public function delimit();
    public function upperCamelize();
    public function upperCaseFirst();
    public function lines();
    public function words();
    public function chars();
}