/**
 * Created by Faisal Abdul Hamid on 14/05/2017.
 */

var app = require('express')();
var server = require('http').Server(app);
var io = require('socket.io')(server);
var redis = require('redis');

server.listen(5656);
io.on('connection', function(socket){

    var redisClient = redis.createClient();
    redisClient.on("error", function (err) {
        console.log("Rdis Error " + err);
    });
    redisClient.on("connect", function () {
        console.log("Redis Connect ");

        //redisClient.subscribe('absensi-siswa');
        //
        //redisClient.on('message', function(channel, message){
        //    console.log('absensi siswa : ', channel, message);
        //    socket.emit('absensiSiswa', message);
        //});

    });

    redisClient.subscribe('message');

    redisClient.on('message', function(channel, message){
        console.log('absensi siswa : ', channel, message);
        socket.emit(channel, message);
    });

    socket.on('disconnect', function() {
        redisClient.quit();
    });

    //socket.emit('absensi_event', 'hello word');

    socket.on('pingServer', function(data){
        console.log('Ping', data)
        socket.emit('responseServer', 'Hello Client');
    });
    console.log('Running http://localhost:5656/');
    console.log('new Client connected')
});