<?php
/**
 * SCSS-Native
 *
 * Native Compile SCSS to inline CSS for WordPress.
 * a WordPress Implementation of the SCSSPHP project.
 * https://scssphp.github.io/scssphp
 *
 * @link		https://github.com/mitchell-b-chelin/SCSS-Native/blob/main/LICENSE
 * @since 		1.0.1
 * @package		MBC
 *
 * @better-rest
 * Plugin Name:	   	Native SCSS
 * Plugin URI:		https://github.com/mitchell-b-chelin/SCSS-Native/blob/main/LICENSE
 * Description:	   	Native Compile SCSS to inline CSS for WordPress.
 * Version:		   	1.0.1
 * Author:			Mitchell-Blair Chelin
 * Author URI:		https://github.com/mitchell-b-chelin/
 * License:		   	MIT
 * License URI:	   	https://github.com/mitchell-b-chelin/SCSS-Native/blob/main/LICENSE
 */
namespace MBC;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
if (version_compare(PHP_VERSION, '7.2') < 0) throw new \Exception('SCSS-Native requires PHP 7.2 or above');
else require plugin_dir_path( __FILE__ ) . 'inc/init.php';


