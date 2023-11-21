## TAREA PLUGINS

Un **plugin** es un componente de software modular diseñado para ampliar las capacidades de una aplicación existente sin requerir cambios en su código base. Esto facilita la personalización y la adaptación de aplicaciones a las necesidades específicas de los usuarios.

Así, en nuestro WordPress podemos crear y añadir plugins. Para ello hay que crear funciones, por ejemplo:

**PLUGIN 1:** 
```
function renym_wordpress_typo_fix( $text ) {
    return str_replace( 'WordPress', 'WordPressDAM', $text );
}

add_filter( 'the_content', 'renym_wordpress_typo_fix' );
```
Este plugin lo que hace es cambiar todas las palabras "WordPress" por "WordPressDAM" en el contenido de la página.<br>

**renym_wordpress_typo_fix**  es el nombre de la función, la cual acepta un parámetro **$text.**<br>
Dentro de la función, utiliza **str_replace** para reemplazar 'WordPress' por 'WordPressDAM' en el texto proporcionado.
Por último, en la línea **`add_filter( 'the_content', 'renym_wordpress_typo_fix' );**, agregamos un filtro que se ejecutará cuando se imprima el contenido de WordPress.
--------------------
**PLUGIN 2:**
```
function renym_words_replace($text){
$palabras = array("guapo","largo","gordo","alto","dulce");
$antonimos = array("feo","corto","flaco","bajo","salado");
    return str_replace( $palabras, $antonimos, $text );
}
add_filter( 'the_content', 'renym_words_replace' );
```
En cambio, este plugin lo que hace es cambiar las palabras "guapo","largo","gordo","alto","dulce" por sus antónimos en el contenido de la página.<br>



Siendo **renym_words_replace** el nombre de la función/método, el cual acepta un parámetro $text, se definen dos arrays: 
- **$palabras :** que contiene las palabras a buscar 
- **$antonimos :** que contiene las palabras a reemplazar.

Luego utilizamos el  **str_replace** para reemplazar todas las palabras definidas en $palabras con las palabras 
definidas en el otro array $antonimos. Finalmente, agrega un filtro a **'the_content'**, que se ejecutará cuando se imprima el contenido de WordPress.
