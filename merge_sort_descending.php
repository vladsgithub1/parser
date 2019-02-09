<?php

$A = [0, 5, 2, 4, 7, 1, 3, 2, 6];

/**
 * @param $A
 * @param $p
 * @param $q
 * @param $r
 */
function merge(&$A, $p, $q, $r)
{
    $nl = $q - $p + 1;
    $n2 = $r - $q;

    $L = [];
    $R = [];
    for ($i = 1; $i <= $nl; $i++) {
        $L[$i] = $A[$p + $i - 1];
    }
    for ($j = 1; $j <= $n2; $j++) {
        $R[$j] = $A[$q + $j];
    }
    $L[$nl + 1] = -10000000; // -INF
    $R[$n2 + 1] = -10000000; // -INF
    $i = 1;
    $j = 1;
    for ($k = $p; $k <= $r; $k++ ) {
        if ($L[$i] >= $R[$j]) {
            $A[$k] = $L[$i];
            $i++;
        } else {
            $A[$k] = $R[$j];
            $j++;
        }
    }
}

/**
 * @param $A
 * @param $p
 * @param $r
 */
function mergeSort(&$A, $p, $r) {
    if($p < $r) {
        $q = floor(($p + $r) / 2);
        mergeSort($A, $p, $q);
        mergeSort($A, $q + 1, $r);
        merge($A, $p, $q, $r);
    }   
}

mergeSort( $A, 0, count($A) - 1);
echo json_encode($A) . PHP_EOL;
