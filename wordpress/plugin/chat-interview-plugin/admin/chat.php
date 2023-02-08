<style>
    #form { background: rgba(0, 0, 0, 0.15); padding: 0.25rem; position: fixed; bottom: 0; left: 10rem; right: 0; display: flex; height: 3rem; box-sizing: border-box; backdrop-filter: blur(10px); z-index: 999;}
    #input { border: none; padding: 0 1rem; flex-grow: 1; border-radius: 2rem; margin: 0.25rem; }
    #input:focus { outline: none; }
    #form > button { background: rgb(53, 66, 167); border: none; padding: 0 1rem; margin: 0.25rem; border-radius: 3px; outline: none; color: #fff; }
    #username { border: none; padding: 0 1rem; border-radius: 2rem; margin: 0.25rem; }
    #username-text { color: rgb(4, 37, 125); font-weight: bold; }
    #me-username-text { color: rgb(20, 134, 75); font-weight: bold; }

    #messages { list-style-type: none; margin: 0; padding: 0; }
    #messages > li { padding: 0.5rem 1rem; }
    #messages > li:nth-child(odd) { background: #efefef; }
</style>

<body>
    <ul id="messages"></ul>
    <form id="form" action="">
        <input id="username" placeholder="Username" autocomplete="off" />
        <input id="input" placeholder="Mensaje" autocomplete="off"/><button>Enviar</button>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.6.0/socket.io.js" integrity="sha512-rwu37NnL8piEGiFhe2c5j4GahN+gFsIn9k/0hkRY44iz0pc81tBNaUN56qF8X4fy+5pgAAgYi2C9FXdetne5sQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        const socket = io("http://localhost:8080/");
      
        const messages = document.getElementById('messages');
        const form = document.getElementById('form');
        const input = document.getElementById('input');
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
            window.scrollTo(0, document.body.scrollHeight);
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
    </script>
</body>
