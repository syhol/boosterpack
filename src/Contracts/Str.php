<?php

/**
 * Created by PhpStorm.
 * User: simon
 * Date: 07/01/17
 * Time: 17:58
 */
interface Str extends Vector
{
    public function between();
    public function camelize();
    public function chars();
    public function collapseWhitespace();
    public function dasherize();
    public function delimit();
    public function getEncoding();
    public function hasLowerCase();
    public function hasUpperCase();
    public function humanize();
    public function isAlpha();
    public function isAlphanumeric();
    public function isBlank(); // Just use is empty
    public function isLowerCase();
    public function isUpperCase();
    public function lines();
    public function lowerCaseFirst();
    public function regexReplace();
    public function safeTruncate();
    public function slugify();
    public function split();
    public function swapCase();
    public function tidy();
    public function titleize();
    public function toAscii();
    public function toBoolean();
    public function toLowerCase();
    public function toSpaces();
    public function toTabs();
    public function toTitleCase();
    public function toUpperCase();
    public function truncate();
    public function underscored();
    public function upperCamelize();
    public function upperCaseFirst();
    public function words();
}