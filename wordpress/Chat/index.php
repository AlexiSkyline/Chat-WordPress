<!DOCTYPE html>
<html>
  <head>
    <title>Interview</title>
    <link rel="stylesheet" href="<?php bloginfo("stylesheet_url"); ?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.6.0/socket.io.js" integrity="sha512-rwu37NnL8piEGiFhe2c5j4GahN+gFsIn9k/0hkRY44iz0pc81tBNaUN56qF8X4fy+5pgAAgYi2C9FXdetne5sQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  </head>
  <body>
    <ul id="messages">
    </ul>
    <form id="form" action="">
      <input id="username" placeholder="Username" autocomplete="off" />
      <input id="input" placeholder="Mensaje" autocomplete="off"/><button>Enviar</button>
    </form>
    
    <script>
      var socket = io("http://localhost:8080/");

      var messages = document.getElementById('messages');
      var form = document.getElementById('form');
      var input = document.getElementById('input');
      var usernameInput = document.getElementById('username');
      
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
      
      socket.on('chat message', function(msg) {
        var item = document.createElement('li');
        item.innerHTML = `<span id="${ verifyUsername(msg.username) }">${ msg.username }</span>: ${ msg.message }`;
        messages.appendChild(item);
        window.scrollTo(0, document.body.scrollHeight);
      });

      const verifyUsername = (username) => {
          return username === usernameInput.value ? "me-username-text" : "username-text"
      }
    </script>
  </body>
</html>
