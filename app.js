const cors = require('cors');
const app = require('express')();
const http = require('http').Server(app);
const io = require('socket.io')(http, {
    cors: {
      origin: "*",
      methods: ["GET", "POST"]
    }
});

const port = process.env.PORT || 8080;

app.use(cors());
app.get('/', (req, res) => {
    res.sendFile(__dirname + '/web/index.html');
});

io.on('connection', socket => {
    socket.on('chat message', data => {
        io.emit('chat message', data);
    });
});

http.listen(port, () => {
  console.log(`Socket.IO server running at http://localhost:${port}/`);
});