var app = require('http').createServer(handler)
var io = require('socket.io')(app);

app.listen(8001);

io.on('connection', function (socket) {
    socket.on('joining', function(room) {
        console.log('Someone joined ' + room);
        socket.room = room;
        socket.join(room);
    });
    socket.on('update.item', function(item) {
        console.log('Updating item');
        socket.broadcast.to(socket.room).emit('update.item', item);
    });
});

function handler (req, res) {

    req.on('data', function(chunk) {
        var body = JSON.parse(chunk.toString());
        console.log(body);
        io.sockets.in(body.room).emit(body.event, body.payload);
    });

    res.writeHead(200);
    res.end("Message sent");
}
