<?php
/**
 * Plugin Name: Chat Interview Plugin
 * Plugin URI: https://github.com/AlexiSkyline
 * Description: Este plugin es una prueba para crear una página de chat en el panel de administrador de Wordpress.
 * Version: 0.0.1
 * Author: AlexiSkyline
 * Author URI: https://github.com/AlexiSkyline
 * License: GPL2
 */

/**
* Desactiva el plugin Chat Interview.
* @return void
*/
function desactivar_chat_interview_plugin() {
    flush_rewrite_rules();
}

// Acción que se ejecuta al desactivar el plugin
register_deactivation_hook( __FILE__, 'desactivar_chat_interview_plugin' );

// Acción que crea el menú en el panel de administración
add_action( 'admin_menu', 'crear_menu_chat_interview' );

/**
* Crea un menú en el panel de administración para el plugin Chat Interview.
* @return void
*/
function crear_menu_chat_interview() {
    add_menu_page(
        'Chat Interview', // Título de la página
        'Chat Interview', // Título del menú
        'manage_options', // Capacidad
        plugin_dir_path( __FILE__ ) . 'admin/chat.php', // Slug
        null, // Función que se ejecuta al abrir la página, en este caso no hay una función específica
        'dashicons-format-chat', // Icono
        1 // Posición en el menú
    );
}