<p align="center">
    <img alt="WPSCSSNative" src="./inc/docs/_images/WPSCSSNative.png">
</p>

<div align="center">
<h2>SCSS Native.</h2>
<h3>a WordPress Implementation of the SCSSPHP project.</h3>
</div>

# SCSS Native
Native Compile SCSS to inline CSS for WordPress.  
This plugin is based off SCSSPHP and credit to the following in [links](#links)

# Features

- Convert SCSS to CSS
- Inline Convert SCSS lang to CSS

# Links

- [SCSSPHP](https://github.com/scssphp/scssphp)
- [Ubuntu](https://www.ubuntu.com/about/about-ubuntu/conduct)
- [Drupal](https://www.drupal.org/dcoc)
- [Sass](https://sass-lang.com/community-guidelines)

# Class Usage
Native SCSS has one class that requires SCSSPHP class.

## Convert Inline
To convert inline ```<style lang="scss">```
```php
/* functions.php */

/* Is not required rename the namespace using MBC\inc before the class is fine */
use MBC\inc as PLUGINS;

$scss = '<style lang="scss">
.test {
    h1 {
        b {
            color: red;
        }
    }
}
</style>';

$css = PLUGINS/scss::convert($scss);
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
use MBC\inc as PLUGINS;

$scss = '.test {
    h1 {
        b {
            color: red;
        }
    }
}';

$css = PLUGINS/scss::compile($scss);
echo $css;
/**
 * .test h1 b {color:red}
 * /
```
## License

[MIT](LICENSE)

## Author

**Mitchell Chelin**

- Linkedin: [@mitchell-chelin](https://www.linkedin.com/in/mitchell-chelin/)
- Email: [Gmail](mitchell.b.chelin@gmail.com)