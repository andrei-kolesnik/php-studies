<?php 
print("PHP version: " . phpversion() . "\n");
class User {
  public int $id;
  public string $name;
}

$user = new User();
$user->id = 'abc';
$user->name = ['name'];
