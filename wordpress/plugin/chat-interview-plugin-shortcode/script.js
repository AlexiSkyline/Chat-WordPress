const socket = io("http://localhost:8080");
      
const messages = document.getElementById('messages');
const form = document.getElementById('form');
const input = document.getElementById('input_message');
const usernameInput = document.getElementById('username');

/**
 * Controla el evento de envío del formulario.
 * Se verifica que los valores de entrada y usuario no estén vacíos antes de enviarlos al servidor.
 * En caso contrario, muestra una alerta para que el usuario ingrese el nombre de usuario.
 */
form.addEventListener('submit', function(e) {
    e.preventDefault();
    if (input.value && usernameInput.value) {
        socket.emit('chat message', {
        username: usernameInput.value,
        message: input.value
        });
        input.value = '';
    } else {
        window.alert("Ingrese el nombre de usuario");
    }
});

/**
 * Controla el evento de recepción de mensaje del servidor.
 * Crea un elemento 'li' con el mensaje y el usuario, y lo agrega a la lista de mensajes.
 * Finalmente, hace un scroll hacia abajo para ver el último mensaje.
 */
socket.on('chat message', function(msg) {
    var item = document.createElement('li');
    item.innerHTML = `<span id="${ verifyUsername(msg.username) }">${ msg.username }</span>: ${ msg.message }`;
    messages.appendChild(item);
});

/**
 * Verifica si el nombre de usuario proporcionado es el mismo que el ingresado por el usuario actual.
 * 
 * @param  {string} username - Nombre de usuario a verificar
 * @return {string} Identificador CSS para el estilo del nombre de usuario
 */
const verifyUsername = (username) => {
    return username === usernameInput.value ? "me-username-text" : "username-text"
}