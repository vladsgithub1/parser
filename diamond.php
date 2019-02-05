<?php
const FILLED_FIELD = ' * ';
const EMPTY_FIELD = '   ';
const SYMBOLS_IN_FIELD = 3;

/**
 * @param $centerIndex
 * @param $index
 * @param string $line
 * @return string
 */
function getLine($centerIndex, $index, $line = '') {
    for ($position = 0; $position < $centerIndex; $position++) {
        $line .= ($position < $index) ? FILLED_FIELD : EMPTY_FIELD;
    }
    return $line;
}

/**
 * @return string
 */
function getDiamond() 
{
    $size = (int) getUrl() ?? 0;

    if( $size <= 0 || !(boolean)($size % 2)) {
        return 'Size is not correct! Size should be odd number > 0' . PHP_EOL;
    }
    
    $centerIndex = ceil($size / 2);
    
    return calculateDiamond($centerIndex);
}

/**
 * @param $centerIndex - center index of the diamond
 * @param string $diamondUp - upper part of diamond
 * @param string $diamondDown - down part of diamond
 * @return string - return diamond
 */
function calculateDiamond($centerIndex, $diamondUp = '', $diamondDown = '')
{
    for ($index = $centerIndex; $index >= 0; $index--) {
        $line = getLine($centerIndex, $index);
        $diamondUp = strrev($line) . substr($line, SYMBOLS_IN_FIELD) . PHP_EOL . $diamondUp;
        if ($index !=  $centerIndex) {
            $diamondDown = $diamondDown . strrev($line) . substr($line, SYMBOLS_IN_FIELD) . PHP_EOL;
        }
    }
    return $diamondUp . $diamondDown;
}

/**
 * @return string
 */
function getUrl()
{
    $shortOption = "s::";
    $longOption = ["size::"];
    $get = getopt($shortOption, $longOption);
    return $get['size'] ?? $get['s'] ?? $_SERVER['argv'][1] ?? '';
}

print_r(getDiamond());
