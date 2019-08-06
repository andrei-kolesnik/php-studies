<?php 
print("PHP version: " . phpversion() . "\n");

function array_values_from_keys($arr, $keys) {
    return array_map(fn($x) => $arr[$x], $keys);
}

$data = array('zero', 'one', 'two', 'three');
print_r(array_values_from_keys($data, [0, 2]));
