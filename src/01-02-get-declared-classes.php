<?php
print("PHP version: " . phpversion() . "\n");

function newClass () {
    return new class {
    };
}

$declaredClasses = get_declared_classes();

$anonymousClasses = array_filter(
  $declaredClasses,
  function($item) {
    return strpos($item, "anonymous") !== false;
  }
);

if (count($anonymousClasses) > 0) {
  foreach ($anonymousClasses as $value) {
    print($value);
  }  
} else {
  print("No anonymous classes\n");
}
