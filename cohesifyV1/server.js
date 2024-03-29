(function() {
	var io;
	io = require('socket.io').listen(4000);
	io.sockets.on('connection', function(socket) {
		socket.on("drawClick", function(data) {
			socket.broadcast.emit('draw', {
				x: data.x,
				y: data.y,
				type: data.type,
				color: data.color,
				isEraser: data.eraser,
				lineWidth: data.lineWidth,
				isTeacher: data.isTeacher,
				target: data.target
			});
		});
	});
}).call(this);
