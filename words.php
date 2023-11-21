<?php
/**
 * @package Hello_Words
 * @version 1.0.0
 */
/*
Plugin Name: Hello Words
Plugin URI: http://wordpress.org/plugins/hello-words/
Description: Esto no es solo un plugin, simboliza la esperanza y el entusiasmo de toda una generación resumida en dos palabras cantadas más famosamente por Louis Armstrong: Hola, Dolly. Cuando se activa, verá aleatoriamente una letra de <cite> Hola, Dolly </cite> en la parte superior derecha de su pantalla de administración en cada página.
Author: Jorge Amestoy
Version: 1.0.0
Author URI: http://mjorge.amestoy/
*/

/**
 * @param $text
 * @return array|string|string[]
 */
function renym_wordpress_typo_fix( $text ) {
    return str_replace( 'WordPress', 'WordPressDAM', $text );
}

add_filter( 'the_content', 'renym_wordpress_typo_fix' );

/**
 * Cambia palabras usando arrays
 * @param $text
 * @return array|string|string[]
 */
function renym_words_replace($text){
$palabras = array("guapo","largo","gordo","alto","dulce");
$antonimos = array("feo","corto","flaco","bajo","salado");
    return str_replace( $palabras, $antonimos, $text );
}
add_filter( 'the_content', 'renym_words_replace' );

