<?php
print("PHP version: " . phpversion() . "\n");

class fn {
  const fn = 100;
  public function fn() 
  {
      print(self::fn);
  }
}

$fn = new fn();
$fn->fn(); 
