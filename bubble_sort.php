<?php

/**
 * @param $array
 * @return mixed
 */
function bubble_sort($array) {
    for ($i=1; $i<count($array)-1; $i++) {
        for ($j=0; $j<count($array)+1-$i; $j++) {
            if ($array[$j] < $array[$j-1]) {
                list($array[$j], $array[$j-1]) = [$array[$j-1], $array[$j]];
            }
        }
    }
    return $array;
}

$array = [0, 5, 2, 4, 234, 32, -23, 1, 0, 7, 1, 3, 2, 6];
print_r(bubble_sort($array));
