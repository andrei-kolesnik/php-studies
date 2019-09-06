<?php 
print("PHP version: " . phpversion() . "\n");

$array = array();

$array['key'] = $array['key'] ?? 'default';

// or:
// if (!isset($array['key'])) {
//     $array['key'] = 'default';
// }

print_r($array);