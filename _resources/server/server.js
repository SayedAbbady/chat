var express = require('express');
var app = express();
var server = require('http').createServer(app);
var io = require('socket.io').listen(server);

users = [];
connections = [];

server.listen(process.env.PORT || 3000);
console.log("server running...");

app.get('/', function (req, res){
  res.sendFile(__dirname + '/index.html');
});

io.sockets.on('connection', function(socket){
  var t = socket.handshake.query.userId;
  socket.id = t;
  
  io.sockets.emit('online_user', {
    socket_id: socket.id
  });
  console.log('connected: %s', socket.id);
  connections.push(socket);
  


  //disconnected
  socket.on('disconnect', function (data) {
    connections.splice(connections.indexOf(data), 1);
    console.log('disconnected: %s sockets connectd', connections.length);
  });

  socket.on('send message', function (data) {
    
    io.sockets.emit('new message', data);
    console.log('send: %s', data);
  })

  socket.on("delete message", function(data){
    io.sockets.emit('delete message', data);
    console.log('delete: %s', data);
  })
});