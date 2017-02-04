<?php

/**
 * @param string $chars
 * @return array
 */
function chars($chars) {
    return str_split($chars);
}

/**
 * @param array $chars
 * @return string
 */
function unchars($chars) {
    return implode('', $chars);
}

/**
 * @param string $words
 * @return array
 */
function words($words) {
    return explode(' ', $words);
}

/**
 * @param array $words
 * @return string
 */
function unwords($words) {
    return implode(' ', $words);
}

/**
 * @param string $lines
 * @return array
 */
function lines($lines) {
    return explode(PHP_EOL, $lines);
}

/**
 * @param array $lines
 * @return string
 */
function unlines($lines) {
    return implode(PHP_EOL, $lines);
}