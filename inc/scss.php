<?php
/**
 * brick Blocks
 * This Class is used to implement bricks and extend backend functionality with Wordpress
 *
 * @package MBC\Docsify
 */
namespace MBC\inc\native;
defined( 'ABSPATH' ) || exit;
include_once(__DIR__ . '/compiler/scss.inc.php');


class scss {
    function __construct(){
    }
    /**
     * Convert
     * Converts inline lang SCSS to CSS and replaces
     */
    public static function convert($buffer){
        $output = $buffer;
        $pattern = '/<style lang="scss">(.*?)<\/style>/s';
        preg_match_all($pattern, $buffer, $matches);
        if(isset($matches) !== false && isset($matches[1]) !== false){
            foreach($matches[1] as $key => $match){
                $scss = str_replace(array("\r\n","\n","<br />"),'',$match);
                $css = self::compile($scss);
                if(!empty($css) && is_string($css)) $output = str_replace($matches[0][$key], '<style>'.$css.'</style>', $output );
            }
        }
        return $output;
    }
    /**
     * Compile
     * SCSS code can be passed and compiled to CSS
     */
    public static function compile($uncompiled){
        $compiler = new \ScssPhp\ScssPhp\Compiler();
        $compiled = $compiler->compileString($uncompiled)->getCss();
        if(!empty($compiled) && is_string($compiled)) {
            return self::minify($compiled);
        } else false;
    }
    /**
     * Private Minify
     * Minifies CSS code
     */
    private static function minify($css) {
        if(trim($css) === "") return $css;
        return preg_replace(
            array(
                // Remove comment(s)
                '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')|\/\*(?!\!)(?>.*?\*\/)|^\s*|\s*$#s',
                // Remove unused white-space(s)
                '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'|\/\*(?>.*?\*\/))|\s*+;\s*+(})\s*+|\s*+([*$~^|]?+=|[{};,>~]|\s(?![0-9\.])|!important\b)\s*+|([[(:])\s++|\s++([])])|\s++(:)\s*+(?!(?>[^{}"\']++|"(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')*+{)|^\s++|\s++\z|(\s)\s+#si',
                // Replace `0(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)` with `0`
                '#(?<=[\s:])(0)(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)#si',
                // Replace `:0 0 0 0` with `:0`
                '#:(0\s+0|0\s+0\s+0\s+0)(?=[;\}]|\!important)#i',
                // Replace `background-position:0` with `background-position:0 0`
                '#(background-position):0(?=[;\}])#si',
                // Replace `0.6` with `.6`, but only when preceded by `:`, `,`, `-` or a white-space
                '#(?<=[\s:,\-])0+\.(\d+)#s',
                // Minify string value
                '#(\/\*(?>.*?\*\/))|(?<!content\:)([\'"])([a-z_][a-z0-9\-_]*?)\2(?=[\s\{\}\];,])#si',
                '#(\/\*(?>.*?\*\/))|(\burl\()([\'"])([^\s]+?)\3(\))#si',
                // Minify HEX color code
                '#(?<=[\s:,\-]\#)([a-f0-6]+)\1([a-f0-6]+)\2([a-f0-6]+)\3#i',
                // Replace `(border|outline):none` with `(border|outline):0`
                '#(?<=[\{;])(border|outline):none(?=[;\}\!])#',
                // Remove empty selector(s)
                '#(\/\*(?>.*?\*\/))|(^|[\{\}])(?:[^\s\{\}]+)\{\}#s'
            ),
            array(
                '$1',
                '$1$2$3$4$5$6$7',
                '$1',
                ':0',
                '$1:0 0',
                '.$1',
                '$1$3',
                '$1$2$4$5',
                '$1$2$3',
                '$1:0',
                '$1$2'
            ),
            $css);
    }
}
