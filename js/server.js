var socket = require("socket.io"),
  express = require("express"),
  https = require("https"),
  http = require("http"),
  logger = require("winston");

logger.remove(logger.transports.Console);
logger.add(logger.transports.Console, { colorize: true, timestamp: true });
logger.info("SocketIO > listening on port ");

// HTTPS
/*
var https_server = https.createServer({
key: fs.readFileSync("'),
cert: fs.readFileSync('')
}, app).listen(3000);*/

var app = express();
var http_server = http.createServer(app).listen(3001);

function emitNewOrder(http_server) {
  var io = socket.listen(http_server);

  /*First listen to a connection and run the call back function*/
  io.sockets.on("connection", function (socket) {});
}
emitNewOrder(http_server);
