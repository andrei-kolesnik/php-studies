# PHP Versions Differences: PHP 7.4

## Backward Incompatible Changes

### Core

1. Trying to use values of type *null*, *bool*, *int*, *float* or resource as an *array* will now generate a notice. This does not affect array accesses performed by `list()`. RFC: https://wiki.php.net/rfc/notice-for-non-valid-array-container

```php
error_reporting(E_ALL);

$nullvar = null;
$boolvar = false;
$intvar  = 1;

var_dump($nullvar[1]);
var_dump($boolvar[1]);
var_dump($intvar[1]);
```
#### PHP 7.3:
```diff
NULL 
NULL
NULL
```
#### PHP 7.4:
```diff
Notice: Trying to access array offset on value of type null in {app}.php on line ...
NULL
Notice: Trying to access array offset on value of type null in {app}.php on line ...
NULL
Notice: Trying to access array offset on value of type null in {app}.php on line ...
NULL
```
