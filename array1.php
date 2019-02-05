<?php
const DEFAULT_DIRECTION = 1;
const DIRECTION_CHANGE = -1;
const DEFAULT_X = 0;
const DEFAULT_Y = 0;

/**
 * @param int $size
 * @param int $counter
 * @param array $result
 * @return array
 */
function getArray(int $size, $counter = 1, array $result = []) 
{
    $direction = DEFAULT_DIRECTION;
    $indexX = DEFAULT_X;
    $indexY = DEFAULT_Y;
    $lastElementArray = $size ** 2;
    $result[$indexY][$indexX] = $counter;
    
    while ($counter++ < $lastElementArray) {
        $indexY += $direction;
        $result[$indexY][$indexX] = $counter;
        if ($indexY == $size - 1 || $indexY == 0) {
            $direction *= DIRECTION_CHANGE;
            $indexX++;
            if ($counter++ != $lastElementArray) {
                $result[$indexY][$indexX] = $counter;
            }
        }
    }
    return $result;
}

/**
 * @param string $matrix
 * @return string
 */
function outputArray($matrix = '')
{
    $size = (int) getUrl() ?? 0;

    if( $size <= 0 ) {
        return "Size is not correct!";
    }

    $array = getArray($size);

    foreach ($array as $innerArray) {
        if (is_array($innerArray)) {
            $matrix .= implode(" ", $innerArray) . PHP_EOL;
        }
    }
    return $matrix;
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

print_r(outputArray());
