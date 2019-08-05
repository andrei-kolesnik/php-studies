<?php
print("PHP version: " . phpversion() . "\n");

error_reporting(E_ALL);

$nullvar = null;
$boolvar = false;
$intvar  = 1;

var_dump($nullvar[1]);
var_dump($boolvar[1]);
var_dump($intvar[1]);
