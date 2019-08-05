# PHP Versions Differences: PHP 7.4
https://github.com/php/php-src/blob/php-7.4.0beta1/UPGRADING

## Backward Incompatible Changes

### Core

1. Trying to use values of type *null*, *bool*, *int*, *float* or resource as an *array* will now generate a notice. This does not affect array accesses performed by `list()`. RFC: https://wiki.php.net/rfc/notice-for-non-valid-array-container

```php
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
NULL 
NULL
NULL
NULL
NULL
```
#### PHP 7.4:
```diff
Notice: Trying to access array offset on value of type null in {app}.php on line 8
NULL

Notice: Trying to access array offset on value of type bool in {app}.php on line 9
NULL

Notice: Trying to access array offset on value of type int in {app}.php on line 10
NULL

Notice: Trying to access array offset on value of type null in {app}.php on line 11

Notice: Trying to access array offset on value of type null in {app}.php on line 11
NULL

Notice: Trying to access array offset on value of type int in {app}.php on line 12
NULL
```
