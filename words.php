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
function inicioPlugin(){
    createTable();
    insertData();
}
#Se ejecutará la base de datos cuando se cargue el plugin, y en la base de datos
#de la derecha saldrá un wp_palabras


function createTable(){
    global $wpdb;
    $table_name = $wpdb->prefix . 'palabras';
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE $table_name (
       id mediumint(9) NOT NULL AUTO_INCREMENT,
       word varchar(255) NOT NULL,
       antonym varchar(255) NOT NULL,
       PRIMARY KEY  (id)
   ) $charset_collate;";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}


function insertData(){
    global $wpdb;
    $table_name = $wpdb->prefix . 'palabras';
    $data_exists = $wpdb->get_var("SELECT COUNT(*) FROM $table_name");//Verifica si hay datos en la tabla
    if($data_exists > 0){
        $wpdb->query("DROP TABLE IF EXISTS $table_name");//Si hay datos, los borra
        createTable();//Crea la tabla
    }
    $wpdb->insert(
        $table_name,
        array(
            'word' => 'listo',
            'antonym' => 'tonto'
        )
    );
    $wpdb->insert(
        $table_name,
        array(
            'word' => 'largo',
            'antonym' => 'corto'
        )
    );
    $wpdb->insert(
        $table_name,
        array(
            'word' => 'gordo',
            'antonym' => 'flaco'
        )
    );
    $wpdb->insert(
        $table_name,
        array(
            'word' => 'alto',
            'antonym' => 'bajo'
        )
    );
    $wpdb->insert(
        $table_name,
        array(
            'word' => 'dulce',
            'antonym' => 'salado'
        )
    );
}

add_action('plugins_loaded','inicioPlugin');



function renym_wordpress_typo_fix( $text ) {
    return str_replace( 'WordPress', 'WordPressDAM', $text );
}

add_filter( 'the_content', 'renym_wordpress_typo_fix' );


function renym_words_replace($text){
$palabras = array("guapo","largo","gordo","alto","dulce");
$antonimos = array("feo","corto","flaco","bajo","salado");
    return str_replace( $palabras, $antonimos, $text );
}
add_filter( 'the_content', 'renym_words_replace' );



function renym_words_replace_db($text){
    global $wpdb;
    $table_name = $wpdb->prefix . 'palabras';
    $palabras = $wpdb->get_results("SELECT word FROM $table_name");
    $antonimos = $wpdb->get_results("SELECT antonym FROM $table_name");
    $palabras = array_column($palabras, 'word');
    $antonimos = array_column($antonimos, 'antonym');
    return str_replace( $palabras, $antonimos, $text );
}
add_filter( 'the_content', 'renym_words_replace_db' );






