const cors = require('cors');
const app = require('express')();
const http = require('http').Server(app);
const io = require('socket.io')(http, {
    cors: {
      origin: "*",
      methods: ["GET", "POST"]
    }
});

/**
 * Configuración del puerto en el que se ejecutará el servidor
 * 
 * @type {number}
 */
const port = process.env.PORT || 8080;

/**
 * Configuración de la librería CORS
 */
app.use(cors());

/**
 * Manejador de petición GET en la raíz '/' que envia el archivo 'index.html'
 * 
 * @param {Object} req - Objeto de la petición
 * @param {Object} res - Objeto de la respuesta
 */
app.get('/', (req, res) => {
    res.sendFile(__dirname + '/web/index.html');
});

/**
 * Manejador de evento de conexión a socket.io
 * 
 * @param {Object} socket - Objeto de socket de la conexión actual
 */
io.on('connection', socket => {
    /**
     * Manejador de evento de mensaje de chat
     * 
     * @param {Object} data - Datos del mensaje de chat
     */
    socket.on('chat message', data => {
        io.emit('chat message', data);
    });
});

/**
 * Inicio del servidor en el puerto especificado o en el puerto 8080
 * 
 * @param {number} port - Puerto en el que se iniciará el servidor
 */
http.listen(port, () => {
    console.log(`Socket.IO server running at http://localhost:${port}/`);
});