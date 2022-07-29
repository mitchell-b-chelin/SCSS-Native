# Class Usage
Native SCSS has one class that requires SCSSPHP class.

## Convert Inline
To convert inline ```<style lang="scss">```
```php
/* functions.php */

/* Is not required rename the namespace using MBC\inc before the class is fine */
use MBC\inc\native as NATIVE;

$scss = '<style lang="scss">
.test {
    h1 {
        b {
            color: red;
        }
    }
}
</style>';

$css = NATIVE/scss::convert($scss);
echo $css;
/**
 * <style>.test h1 b {color:red}</style>
 * /
```

## Compile
if you want to compile straight scss you can use compile
```php
/* functions.php */

/* Is not required rename the namespace using MBC\inc before the class is fine */
use MBC\inc\native as NATIVE;

$scss = '.test {
    h1 {
        b {
            color: red;
        }
    }
}';

$css = NATIVE/scss::compile($scss);
echo $css;
/**
 * .test h1 b {color:red}
 * /
```