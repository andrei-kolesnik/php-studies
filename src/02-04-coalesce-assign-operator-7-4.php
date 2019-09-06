<?php 
print("PHP version: " . phpversion() . "\n");

$array = array();

$array['key'] ??= 'default';

print_r($array);