# PHP Versions Difference: PHP 7.4
https://github.com/php/php-src/blob/php-7.4.0beta1/UPGRADING

## 01. Backward Incompatible Changes

[ Core ]
---

### 01-01. Notice for a non-valid array container
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

#### PHP version: 7.3.8
```diff
NULL 
NULL
NULL
NULL
NULL
```

#### PHP version: 7.4.0beta1
```diff
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

#### PHP version: 7.3.8
```diff
class@anonymous/usr/local/src/myapp/01-02-get-declared-classes.php0x7fb5de13f067
```

#### PHP version: 7.4.0beta1
```diff
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

#### PHP version: 7.3.8
```diff
fn - 100
fn
```

#### PHP version: 7.4.0beta1
```diff
Parse error: syntax error, unexpected 'fn' (T_FN), expecting identifier (T_STRING) in {app}.php on line 4
Parse error: syntax error, unexpected 'fn' (T_FN), expecting identifier (T_STRING) in {app}.php on line 11
```

### 01-04. `List()` assignment by reference
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

#### PHP version: 7.3.8
```diff
array(3) {
  [0]=>int(1)
  [1]=>int(2)
  [2]=>int(3)
}
```

#### PHP version: 7.4.0beta1
```diff
Notice: Only variables should be passed by reference in {app}.php on line 11
array(1) {
  [0]=>int(1)
}
```

### 01-05. `<?php` opening tag at the end of the file
`<?php` at the end of the file (without trailing newline) will now be interpreted as an opening PHP tag. Previously it was interpreted either as `<? php` and resulted in a syntax error (with `short_open_tag=1`) or was interpreted as a literal `<?php` string (with `short_open_tag=0`).

```php
<?php 
print("PHP version: " . phpversion() . "\n");
?>
<?php
```

#### PHP version: 7.3.8
```diff
Parse error: syntax error, unexpected end of file in {app}.php on line 4
```

#### PHP version: 7.4.0beta1
```diff
{no errors}
```

## 02. New Features

[ Core ]
---

### 02-01. Typed properties
Added support for typed properties.

RFC: https://wiki.php.net/rfc/typed_properties_v2

```php
<?php 
print("PHP version: " . phpversion() . "\n");
class User {
  public int $id;
  public string $name;
}

$user = new User();
$user->id = 'abc';
$user->name = ['name'];
```

#### PHP version: 7.3.8
```diff
Parse error: syntax error, unexpected 'int' (T_STRING), expecting function (T_FUNCTION) or const (T_CONST) in {app}.php on line 4
```

#### PHP version: 7.4.0beta1
```diff
Fatal error: Uncaught TypeError: Typed property User::$id must be int, string used in {app}.php:9
Fatal error: Uncaught TypeError: Typed property User::$name must be string, array used {app}.php:10
```

### 02-02. Arrow functions with implicit by-value scope binding
Added support for arrow functions with implicit by-value scope binding.

RFC: https://wiki.php.net/rfc/arrow_functions_v2

```php
<?php 
print("PHP version: " . phpversion() . "\n");

function array_values_from_keys($arr, $keys) {
    return array_map(
      function ($x) use ($arr) { 
        return $arr[$x]; 
      }, 
      $keys
    );
}

$data = array('zero', 'one', 'two', 'three');
print_r(array_values_from_keys($data, [0, 2]));
```

```php
<?php 
print("PHP version: " . phpversion() . "\n");

function array_values_from_keys($arr, $keys) {
    return array_map(fn($x) => $arr[$x], $keys);
}

$data = array('zero', 'one', 'two', 'three');
print_r(array_values_from_keys($data, [0, 2]));
```

#### PHP versions: 7.3.8 and 7.4.0beta1
```diff
Array
(
    [0] => zero
    [1] => two
)
```

### 02-03. Type covariance
Added support for limited return type covariance and argument type contravariance..

RFC: https://wiki.php.net/rfc/covariant-returns-and-contravariant-parameters

```php
<?php 
print("PHP version: " . phpversion() . "\n");

class A {
  public function check() {
    print("A\n");
  }
}

class B extends A {
  public function check() {
    print("B\n");
  }
}

class Producer {
    public function method(): A {
      print("Producer:");
      return new A();
    }
}

class ChildProducer extends Producer {
    public function method(): B {
      print("ChildProducer:");      
      return new B();
    }
}

$producer = new Producer();
$producer->method()->check();

$childProducer = new ChildProducer();
$childProducer->method()->check();
```

#### PHP version: 7.3.8
```diff
Fatal error: Declaration of ChildProducer::method(): B must be compatible with Producer::method(): A in {app}.php on line 28
```

#### PHP version: 7.4.0beta1
```diff
Producer:A
ChildProducer:B
```

### 02-04. Coalesce assign operator.
Added support for coalesce assign (??=) operator.

RFC: https://wiki.php.net/rfc/null_coalesce_equal_operator

```php
<?php 
print("PHP version: " . phpversion() . "\n");

$array = array();

$array['key'] = $array['key'] ?? 'default';

// or:
// if (!isset($array['key'])) {
//     $array['key'] = 'default';
// }

print_r($array);
```

```php
<?php 
print("PHP version: " . phpversion() . "\n");

$array = array();

$array['key'] ??= 'default';

print_r($array);
```

#### PHP versions: 7.3.8 and 7.4.0beta1
```diff
Array
(
    [key] => default
)
```


### 02-05. Unpacking inside arrays
Added support for unpacking inside arrays.

RFC: https://wiki.php.net/rfc/spread_operator_for_array

```php
<?php 
print("PHP version: " . phpversion() . "\n");

$arrInner = [3, 4];
$arrOuter = [1, 2, ...$arrInner, 5];

print_r($arrOuter); 
```

#### PHP version: 7.3.8
```diff
Parse error: syntax error, unexpected '...' (T_ELLIPSIS), expecting ']' in {app.php} on line 5
```

#### PHP version: 7.4.0beta1
```diff
PHP version: 7.4.0beta1
Array
(
    [0] => 1
    [1] => 2
    [2] => 3
    [3] => 4
    [4] => 5
)
```

### 02-06. Underscore separators in numeric literals
Added support for underscore separators in numeric literals.

RFC: https://wiki.php.net/rfc/numeric_literal_separator

```php
<?php 
print("PHP version: " . phpversion() . "\n");

printf("%e\n", 1.234_567e-89); // float
printf("%d\n", 123_456_789);   // decimal
printf("%X\n", 0x1234_ABCD);   // hexadecimal
printf("%b\n", 0b0000_1111);   // binary
printf("%o\n", 0123_456);      // octal

/* NOT VALID:
// already a valid constant name
_123; 
// "Parse error: syntax error":
123_;       // trailing
1__2;       // next to underscore
1_.2; 1._2; // next to decimal point
0x_123;     // next to x
0b_101;     // next to b
1_e2; 1e_2; // next to e
*/
```

#### PHP version: 7.3.8
```diff
Parse error: syntax error, unexpected '_567e' (T_STRING), expecting ')' in {app.php} on line 4
```

#### PHP version: 7.4.0beta1
```diff
1.234567e-89
123456789
1234ABCD
1111
123456
```