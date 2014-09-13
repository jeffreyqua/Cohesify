
// Modified from Wesbos Websocket Canvas Draw using Node.js
// Modified by: Jeffrey Qua
// 27 Mar 2012
(function() {
	var App;
	App = {};
	/*
		Init 
	*/
	App.init = function() {
		App.canvas = document.getElementById("canvas");
		App.canvas.backgroundColor = "transparent";
		App.canvas.height = 600;
		App.canvas.width = 1024;
		
		App.ctx = App.canvas.getContext("2d");
		App.ctx.fillStyle = "solid";
		App.ctx.strokeStyle = drawColor;
		App.ctx.lineWidth = drawWidth;
		App.ctx.lineCap = "round";
		
		// Base Canvas
		
		App.canvasBase = document.getElementById("canvasBase");
		App.canvasBase.backgroundColor = "transparent";
		App.canvasBase.height = 600;
		App.canvasBase.width = 1024;
		
		App.ctxBase = App.canvasBase.getContext("2d");
		App.ctxBase.fillStyle = "solid";
		App.ctxBase.strokeStyle = drawColor;
		App.ctxBase.lineWidth = drawWidth;
		App.ctxBase.lineCap = "round";
		
		App.socket = io.connect('http://ec2-50-112-52-151.us-west-2.compute.amazonaws.com:4000');
		
		// when received draw message
		App.socket.on('draw', function(data) {
			return App.draw(data.x, data.y, data.type, data.color, data.isEraser, data.lineWidth, data.isTeacher, data.target);
		});
	};
	
	App.draw = function(x, y, type, color, isEraser, lineWidth, isTeacher, target) {
		if (isEraser) {
			color = "white";
		}
		
		if (isTeacher || target) {
			// Teacher Writing OR Student writing to class
			App.ctxBase.lineWidth = lineWidth;
			App.ctxBase.strokeStyle = color;
			if (isEraser) {
				//App.ctxBase.globalCompositeOperation = "destination-out";
			}
			else {
				//App.ctxBase.globalCompositeOperation = "source-over";
			};

			// Teacher writing on base canvas
			if (type === "dragstart" || type ==="touchstart") {
				App.ctxBase.closePath();
				App.ctxBase.beginPath();
				App.ctxBase.moveTo(x, y);
			}
			else if (type === "drag" || type ==="touchmove") {
				App.ctxBase.lineTo(x, y);
				App.ctxBase.stroke();
			}
			else if (type === "dragend" || type === "touchend") {
				App.ctxBase.closePath();
			}
		}
		else if (!isTeacher && !window.teacher) {
			// Student writing on canvas, not targetting class
			App.ctx.lineWidth = lineWidth;
			App.ctx.strokeStyle = color;
			if (isEraser) {
				//App.ctx.globalCompositeOperation = "destination-out";
			}
			else {
				//App.ctx.globalCompositeOperation = "source-over";
			}
			
			if (type === "dragstart" || type ==="touchstart") {
				App.ctx.closePath();
				App.ctx.beginPath();
				App.ctx.moveTo(x, y);
			}
			else if (type === "drag" || type ==="touchmove") {
				App.ctx.lineTo(x, y);
				App.ctx.stroke();
			}
			else if (type === "dragend" || type === "touchend") {
				App.ctx.closePath();
			}
		}
		return;
	};
	
  /*
  	Draw Events
  */
  
	// CANVAS
	$('canvas').live("drag dragstart dragend", function(e) {
		var offset, type, x, y;
		type = e.type;
		offset = $(this).offset();
		e.offsetX = e.layerX - offset.left;
		e.offsetY = e.layerY - offset.top;
		x = e.offsetX;
		y = e.offsetY;
		App.draw(x, y, type, drawColor, eraser, drawWidth, teacher, targetClass);
		App.socket.emit('drawClick', {
			x: x,
			y: y,
			type: type,
			color: drawColor,
			isEraser: eraser,
			lineWidth: drawWidth,
			isTeacher: teacher,
			target: targetClass
		});
	});
	
	$('canvas').live("touchstart touchmove touchend", function(e) {
		var offset, type, x, y;
		offset = $(this).offset();
		var originX = e.originalEvent.touches[0].pageX;
		var originY = e.originalEvent.touches[0].pageY;
		x = originX - offset.left;
		y = originY - offset.top;
		App.draw(x, y, type, drawColor, eraser, drawWidth, teacher, targetClass);
		App.socket.emit('drawClick', {
			x: x,
			y: y,
			type: e.type,
			color: drawColor,
			isEraser: eraser,
			lineWidth: drawWidth,
			isTeacher: teacher,
			target: targetClass
		});
	});
	
  
	$(function() {
		App.init();
		return;
	});
}).call(this);

/* Add behaviours */

$('body').live("drag dragstart dragend", function(e) {
	e.preventDefault();
});


$('canvas').live("touchstart touchmove touchend", function(e) {
	e.preventDefault();
	// HACK for TABLET DEVICES
	var App;
	App = {};
	
	var type, x, y, offset, color, isEraser, lineWidth, isTeacher, target;
	App.canvas = document.getElementById("canvas");
	App.ctx = App.canvas.getContext("2d");
	App.ctx.fillStyle = "solid";
	App.ctx.lineCap = "round";
	
	App.canvasBase = document.getElementById("canvasBase");
	App.ctxBase = App.canvasBase.getContext("2d");
	App.ctxBase.fillStyle = "solid";
	App.ctxBase.lineCap = "round";
		
	type=e.type;
	
	offset = $(this).offset();
		var originX = e.originalEvent.touches[0].pageX;
		var originY = e.originalEvent.touches[0].pageY;
		x = originX - offset.left;
		y = originY - offset.top;
	color = drawColor;
	lineWidth = drawWidth;
	isEraser = eraser;
	isTeacher = teacher;
	target = targetClass;
	
	
	if (isEraser) {
		color = eraserColor;
	}
	
	if (isTeacher || target) {
		App.ctxBase.lineWidth = lineWidth;
		App.ctxBase.strokeStyle = color;

		// Teacher writing on base canvas
		if (type === "dragstart" || type ==="touchstart") {
			App.ctxBase.closePath();
			App.ctxBase.beginPath();
			App.ctxBase.moveTo(x, y);
		}
		else if (type === "drag" || type ==="touchmove") {
			App.ctxBase.lineTo(x, y);
			App.ctxBase.stroke();
		}
		else if (type === "dragend" || type === "touchend") {
			App.ctxBase.closePath();
		}
	}
	else if (!isTeacher) {
	// Student writing on canvas
		App.ctx.lineWidth = lineWidth;
		App.ctx.strokeStyle = color;
		
		if (type === "dragstart" || type ==="touchstart") {
			App.ctx.closePath();
			App.ctx.beginPath();
			App.ctx.moveTo(x, y);
		}
		else if (type === "drag" || type ==="touchmove") {
			App.ctx.lineTo(x, y);
			App.ctx.stroke();
		}
		else if (type === "dragend" || type === "touchend") {
			App.ctx.closePath();
		}
	}
	return;
});

