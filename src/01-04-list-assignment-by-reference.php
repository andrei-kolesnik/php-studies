<?php 
print("PHP version: " . phpversion() . "\n");

error_reporting(E_ALL);

function change(&$ref) {
    $ref = [1, 2, 3];
}

$array = [1];
change(list($val) = $array);
var_dump($array);
