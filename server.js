// Setup basic express server
var express = require('express');
var app = express();

var server = require('http').createServer(app);

var port = process.env.PORT || 3000;
var io = require('socket.io').listen(server);
server.listen(port);

server.listen(port, function () {
    console.log('Server listening at port %d', port);
});

app.use('/static', express.static(__dirname + '/static'));

app.get('/', function (req, res) {
    res.sendfile(__dirname + '/index.html');
});

// Chatroom

var numUsers = 0;



io.on('connection', function (socket) {
    var addedUser = false;

    socket.on('message', function (message) {
        try {
            //посылаем сообщение себе
            socket.emit('message', message);
            //посылаем сообщение всем клиентам, кроме себя
            socket.broadcast.emit('message', message);

        } catch (e) {
            console.log(e);
            socket.disconnect();
        }
    });

    socket.on('add user', function (username) {
        if (addedUser) return;

        // we store the username in the socket session for this client
        socket.username = username;
        ++numUsers;
        addedUser = true;
        socket.emit('login', {
            numUsers: numUsers
        });
        // echo globally (all clients) that a person has connected
        socket.broadcast.emit('user joined', {
            username: socket.username,
            numUsers: numUsers
        });
    });

    // when the client emits 'typing', we broadcast it to others
    socket.on('typing', function () {
        socket.broadcast.emit('typing', {
            username: socket.username
        });
    });

    // when the client emits 'stop typing', we broadcast it to others
    socket.on('stop typing', function () {
        socket.broadcast.emit('stop typing', {
            username: socket.username
        });
    });

    // when the user disconnects.. perform this
    socket.on('disconnect', function () {
        if (addedUser) {
            --numUsers;

            // echo globally that this client has left
            socket.broadcast.emit('user left', {
                username: socket.username,
                numUsers: numUsers
            });
        }
    });
});

///**
//* Created by jay on 08.01.16.
//*/
//
//var PORT = 8008;
//
//var options = {
////    'log level': 0
//};
//
//var numUsers = 0;
//
//var express = require('express');
//var app = express();
//
//var http = require('http');
//var server = http.createServer(app);
//
//var io = require('socket.io').listen(server, options);
//server.listen(PORT);
//
//app.use('/static', express.static(__dirname + '/static'));
//
//app.get('/', function (req, res) {
//    res.sendfile(__dirname + '/index.html');
//});
////подписываемся на событие соединения нового клиента
//io.sockets.on('connection', function (client) {
//    //console.log('Your application is running on http://localhost:' + PORT);
//    //подписываемся на событие message от клиента
//    client.on('message', function (message) {
//        try {
//            //посылаем сообщение себе
//            client.emit('message', message);
//            //посылаем сообщение всем клиентам, кроме себя
//            client.broadcast.emit('message', message);
//
//        } catch (e) {
//            console.log(e);
//            client.disconnect();
//        }
//    });
//
//});