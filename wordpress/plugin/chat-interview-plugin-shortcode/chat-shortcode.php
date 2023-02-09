<?php
/**
     * Plugin Name: Chat ShortCode
     * Plugin URI: https://github.com/AlexiSkyline
     * Description: Es herramienta que permite agregar un sistema de chat en línea a un sitio web a través de un ShortCode. Este plugin se integra con el sitio web existente y puede ser utilizado en cualquier página o publicación en donde se coloque el shortcode correspondiente.
     * Version: 0.0.1
     * Author: AlexiSkyline
     * Author URI: https://github.com/AlexiSkyline
     * License: GPL2
     * 
 */

/**
* Desactiva el plugin Chat Interview.
* @return void
*/
function desactivar_chat_short_code() {
    flush_rewrite_rules();
}

// Acción que se ejecuta al desactivar el plugin
register_deactivation_hook( __FILE__, 'desactivar_chat_short_code' );

add_shortcode( 'Chat-Card', 'build_chat_card'  );

/**
* Shortcode para crear un chat en una página o publicación de WordPress
* Este plugin utiliza un shortcode para insertar un chat en una página o publicación de WordPress.
* Incluye archivos CSS y JavaScript para personalizar el aspecto y la funcionalidad del chat.
* También utiliza la biblioteca Socket.io para conectarse en tiempo real a un servidor de chat.
* @return void
*/
function build_chat_card() {
	$dir = plugin_dir_url(__FILE__);

    wp_enqueue_style('style', $dir . 'style.css', array(), '0.1.0', 'all');
	wp_enqueue_script('script', $dir . 'script.js', array(), '0.1.0', true);

	$html = '
		<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.6.0/socket.io.js" integrity="sha512-rwu37NnL8piEGiFhe2c5j4GahN+gFsIn9k/0hkRY44iz0pc81tBNaUN56qF8X4fy+5pgAAgYi2C9FXdetne5sQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<div id="container">
			<ul id="messages"></ul>
			<form id="form" action="">
				<input id="username" placeholder="Username" autocomplete="off" />
				<input id="input_message" placeholder="Mensaje" autocomplete="off"/><button>Enviar</button>
			</form>
		</div>
	';

	return $html;
}
?>
