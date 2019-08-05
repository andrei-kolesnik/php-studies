<?php
print("PHP version: " . phpversion() . "\n");

class fn {
  const fn = 100;
  public function fn() {
      print(self::fn . "\n");
  }
}

function fn() {
  print(__FUNCTION__ . "\n");
}

$fn = new fn();
$fn->fn(); 
fn();