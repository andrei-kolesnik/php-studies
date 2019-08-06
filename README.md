# PHP Versions Difference: PHP 7.4
https://github.com/php/php-src/blob/php-7.4.0beta1/UPGRADING

## Backward Incompatible Changes

### 01. Core

### 01-01. notice-for-non-valid-array-container
Trying to use values of type *null*, *bool*, *int*, *float* or resource as an *array* (such as `$null["key"]`) will now generate a notice. This does not affect array accesses performed by `list()`. 

RFC: https://wiki.php.net/rfc/notice-for-non-valid-array-container

```php
<?php
print("PHP version: " . phpversion() . "\n");

error_reporting(E_ALL);

$nullvar = null;
$boolvar = false;
$intvar  = 1;
$arrvar  = array(100);

var_dump($nullvar[0]);
var_dump($boolvar[0]);
var_dump($intvar[0]);
var_dump($nullvar[0][1]);
var_dump($arrvar[0][1]);
```

#### PHP 7.3:
```diff
PHP version: 7.3.8
NULL 
NULL
NULL
NULL
NULL
```

#### PHP 7.4:
```diff
PHP version: 7.4.0beta1

Notice: Trying to access array offset on value of type null in {app}.php on line 11
NULL

Notice: Trying to access array offset on value of type bool in {app}.php on line 12
NULL

Notice: Trying to access array offset on value of type int in {app}.php on line 13
NULL

Notice: Trying to access array offset on value of type null in {app}.php on line 14

Notice: Trying to access array offset on value of type null in {app}.php on line 14
NULL

Notice: Trying to access array offset on value of type int in {app}.php on line 15
NULL
```

### 01-02. get_declared_classes()
`get_declared_classes()` no longer returns anonymous classes that haven't been instantiated yet.

```php
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
```

#### PHP 7.3:
```diff
PHP version: 7.3.8
class@anonymous/usr/local/src/myapp/01-02-get-declared-classes.php0x7fb5de13f067
```

#### PHP 7.4:
```diff
PHP version: 7.4.0beta1
No anonymous classes
```

### 01-03. `fn` is a reserved keyword
`fn` is now a reserved keyword. In particular it can no longer be used as a function or class name. It can still be used as a method or class constant name.

```php
<?php
print("PHP version: " . phpversion() . "\n");

class fn {
  const fn = 100;
  public function fn() {
    print(__FUNCTION__ . " - " . self::fn . "\n");
  }
}

function fn() {
  print(__FUNCTION__ . "\n");
}

$fn = new fn();
$fn->fn(); 
fn();
```

#### PHP 7.3:
```diff
PHP version: 7.3.8
fn - 100
fn
```

#### PHP 7.4:
```diff
PHP version: 7.4.0beta1
Parse error: syntax error, unexpected 'fn' (T_FN), expecting identifier (T_STRING) in {app}.php on line 4
Parse error: syntax error, unexpected 'fn' (T_FN), expecting identifier (T_STRING) in {app}.php on line 11
```

### 01-04. 
Passing the result of a (non-reference) `list()` assignment by reference is consistently disallowed now. Previously this worked if the right hand side was a simple (CV) variable and did not occur as part of the list().

```php
<?php 
print("PHP version: " . phpversion() . "\n");

error_reporting(E_ALL);

function change(&$ref) {
    $ref = [1, 2, 3];
}

$array = [1];
change(list($val) = $array);
var_dump($array);
```

#### PHP 7.3:
```diff
PHP version: 7.3.8
array(3) {
  [0]=>int(1)
  [1]=>int(2)
  [2]=>int(3)
}
```

#### PHP 7.4:
```diff
PHP version: 7.4.0beta1

Notice: Only variables should be passed by reference in {app}.php on line 11
array(1) {
  [0]=>int(1)
}
```
