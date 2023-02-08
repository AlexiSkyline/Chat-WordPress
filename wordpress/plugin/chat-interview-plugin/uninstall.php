<?php
/**
* Verificamos que la constante WP_UNINSTALL_PLUGIN se encuentre definida
* para garantizar que este código sólo se ejecute durante la desinstalación
* del plugin.
*/
if (!define( 'WP_UNINSTALL_PLUGIN' )) {
    die();
}