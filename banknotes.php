<?php
/**
 * Created by PhpStorm.
 * User: vladdoroshchuk
 * Date: 2/3/19
 * Time: 9:47 AM
 */


const BANKNOTES = [500, 200, 100, 50, 20, 10, 5, 2 ,1];

function sumPerBancnotes(int $sum, $result = [], $banknotesIndex = 0) :array
{
    if($sum < 1) {
        return [
            'error' => 'Sum is too low'
        ];
    }
    while($sum > 0) {
        if($sum >= BANKNOTES[$banknotesIndex]) {
            if(!isset($result[BANKNOTES[$banknotesIndex]])) {
                $result[BANKNOTES[$banknotesIndex]] = 0;
            }
            $result[BANKNOTES[$banknotesIndex]]++;
            $sum -= BANKNOTES[$banknotesIndex];
        } else {
            $banknotesIndex++;
        }
    }
    return $result; 
}

print_r(sumPerBancnotes(1234));
print_r(sumPerBancnotes(54321));
