var express = require('express');
var app = express();
var cookie = require('cookie');
app.set('port', process.env.PORT || 3000);
var server = app.listen(app.get('port'));
var io     = require('socket.io').listen(server);
//var socket = require('socket.io');
//var server = app.listen(3000);
//var io = socket.listen(server);
var async = require('async');
var mysql= require('mysql');
var pool  = mysql.createPool({
  host     : 'localhost',
  user     : 'root',
  password : 'toor2',
  database:'node_chat',
});

var chatserver=require('./chatserver.js');
var chatpage=io.of('/chatpage').authorization(function (handshakeData, callback) {
  handshakeData.page = 'chatpage';
  callback(null, true);
}).on('connection', function (socket) {
	chatserver.getUserFeeds(chatpage,socket,io,pool,async);
});