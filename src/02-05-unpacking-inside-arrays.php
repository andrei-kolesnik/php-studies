<?php 
print("PHP version: " . phpversion() . "\n");

$arrInner = [3, 4];
$arrOuter = [1, 2, ...$arrInner, 5];

print_r($arrOuter); 