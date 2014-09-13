<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<?php
$pathHome = "http://192.168.1.117";
$pathSchool = "http://d142-058-222-095.wireless.sfu.ca";
$pathec2 = "http://ec2-50-112-52-151.us-west-2.compute.amazonaws.com";

//$path = $pathSchool;
//$path = $pathHome;
$path = $pathec2;
?>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="author" content="Jeffrey Qua" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<style type="text/css">
		.clear {
			clear: both;
		}
		body {
		}
		#cohesify {
			top: 0px;
			width: 1024px;
			height: 600px;
			overflow: hidden;
		}
		
		#cohesify article {
			top: 0px;
			position: absolute;
		}
		#canvas {
			position: absolute;
			margin: 0px;
			border: 0px;
			left: 0px;
			top: 0px;
			z-index:3;
		}
		#canvasBase {
			position: absolute;
			margin: 0px;
			border: 0px;
			left: 0px;
			top: 0px;
			z-index:2;
		}
		.drawColorBox {
			width: 20px;
			height: 20px;
		}
		#cohesify .leftCanvasMenu {
			position: absolute;
			z-index:5;
			top: 318px;
		}
		
		#cohesify .rightCanvasMenu {
			position: absolute;
			z-index:5;
			width: 60px;
			left: 964px;/**/
			top: 318px;
		}
		.leftCanvasMenu .pencil, .leftCanvasMenu .eraser, .leftCanvasMenu .colorSelector, .leftCanvasMenu .undo {
			position: relative;
			height: 60px;
			border-top: 1px solid transparent;
			border-right: 1px solid transparent;
			border-bottom: 1px solid transparent;
			background-color: transparent;
			-webkit-border-top-right-radius: 10px;
			-webkit-border-bottom-right-radius: 10px;
			-moz-border-radius-topright: 10px;
			-moz-border-radius-bottomright: 10px;
			border-top-right-radius: 10px;
			border-bottom-right-radius: 10px;
		}
		.leftCanvasMenu .pencil.open, .leftCanvasMenu .eraser.open, .leftCanvasMenu .colorSelector.open {
			background-color: #3ab9db;
			border-top: 1px solid black;
			border-bottom: 1px solid black;
			border-right: 1px solid black;
		}
		
		.leftCanvasMenu .pencil .icon {
			background-image: url("images/pencil_inactive.png");
		}
		.leftCanvasMenu .pencil.active .icon,
		.leftCanvasMenu .pencil.open .icon {
			background-image: url("images/pencil_active.png");
		}
		
		.leftCanvasMenu .eraser .icon {
			background-image: url("images/eraser_inactive.png");
		}
		.leftCanvasMenu .eraser.active .icon,
		.leftCanvasMenu .eraser.open .icon {
			background-image: url("images/eraser_active.png");
		}
		
		
		.leftCanvasMenu .undo .icon {
			background-image: url("images/undo_inactive.png");
		}
		.leftCanvasMenu .undo.active .icon {
			background-image: url("images/undo_active.png");
		}
		
		.leftCanvasMenu .pencil .icon, .leftCanvasMenu .eraser .icon, .leftCanvasMenu .colorSelector .icon, .leftCanvasMenu .undo .icon {
			position: relative;
			top: 10px;
			left: 10px;
			width: 40px;
			height: 40px;
			/*border: 1px solid #6699FF;*/
		}
		
		.leftCanvasMenu .pencil .pencilBG,
		.leftCanvasMenu .eraser .eraserBG,
		.leftCanvasMenu .colorSelector .colorSelectorBG {
			position: relative;
			top: 10px;
			margin: 0px 10px 0px 20px;
		}
		
		.leftCanvasMenu .pencil .pencilBG .pencilWeights,
		.leftCanvasMenu .eraser .eraserBG .eraserWeights,
		.leftCanvasMenu .colorSelector .colorSelectorBG .colorSelectorBoxes {
			display: none;
		}
		
		.pencil .pencilBG .pencilWeights .weight,
		.eraser .eraserBG .eraserWeights .weight,
		.colorSelector .colorSelectorBG .colorSelectorBoxes .color {
			float: left;
			list-style-type: none;
			
			width: 40px;
			height: 40px;
			margin: 0px 5px;
		}
		
		.pencil .pencilBG .pencilWeights .weight .circle1,
		.pencil .pencilBG .pencilWeights .weight .circle2,
		.pencil .pencilBG .pencilWeights .weight .circle3,
		.pencil .pencilBG .pencilWeights .weight .circle4,
		.eraser .eraserBG .eraserWeights .weight .circle1,
		.eraser .eraserBG .eraserWeights .weight .circle2,
		.eraser .eraserBG .eraserWeights .weight .circle3,
		.eraser .eraserBG .eraserWeights .weight .circle4 {
			display: block;
			background: #666;
		}
		
		
		.pencil .pencilBG .pencilWeights .weight .circle1.active,
		.pencil .pencilBG .pencilWeights .weight .circle2.active,
		.pencil .pencilBG .pencilWeights .weight .circle3.active,
		.pencil .pencilBG .pencilWeights .weight .circle4.active,
		.eraser .eraserBG .eraserWeights .weight .circle1.active,
		.eraser .eraserBG .eraserWeights .weight .circle2.active,
		.eraser .eraserBG .eraserWeights .weight .circle3.active,
		.eraser .eraserBG .eraserWeights .weight .circle4.active {
			/*activeColor*/
			background: #dcfdff;
		}
		.colorSelector .colorSelectorBG .colorSelectorBoxes .color .colorBox {
			width: 30px;
			height: 30px;
			
			border: 3px solid transparent;
			margin: 4px;
		}
		
		#colorBox1 {
			background-color: gray;
		}
		
		#colorBox2 {
			background-color: red;
		}
		
		#colorBox3 {
			background-color: green;
		}
		
		#colorBox4 {
			background-color: yellow;
		}
		
		.colorSelector .colorSelectorBG .colorSelectorBoxes .color .colorBox.active {
			border-color: #dcfdff;
		}
		
		.pencil .pencilBG .pencilWeights .weight .circle1,
		.eraser .eraserBG .eraserWeights .weight .circle1 {
			width: 10px;
			height: 10px;
			border-radius: 5px;
			-moz-border-radius: 5px;
			-webkit-border-radius: 5px;
			-khtml-border-radius: 5px;
			margin: 15px 0px 0px 15px;
		}
		
		.pencil .pencilBG .pencilWeights .weight .circle2,
		.eraser .eraserBG .eraserWeights .weight .circle2 {
			width: 15px;
			height: 15px;
			border-radius: 7.5px;
			-moz-border-radius: 7.5px;
			-webkit-border-radius: 7.5px;
			-khtml-border-radius: 7.5px;
			margin: 12.5px 0px 0px 12.5px;
		}
		
		.pencil .pencilBG .pencilWeights .weight .circle3,
		.eraser .eraserBG .eraserWeights .weight .circle3 {
			width: 20px;
			height: 20px;
			border-radius: 10px;
			-moz-border-radius: 10px;
			-webkit-border-radius: 10px;
			-khtml-border-radius: 10px;
			margin: 10px 0px 0px 10px;
		}
		
		.pencil .pencilBG .pencilWeights .weight .circle4,
		.eraser .eraserBG .eraserWeights .weight .circle4 {
			width: 30px;
			height: 30px;
			border-radius: 20px;
			-moz-border-radius: 20px;
			-webkit-border-radius: 20px;
			-khtml-border-radius: 20px;
			margin: 5px 0px 0px 5px;
		}
		
		.leftCanvasMenu .colorSelector .colorSelectorBox {
			position: relative;
			top: 2px;
			left: 2px;
			width: 36px;
			height: 36px;
			background-color: gray;
		}
		
		.rightCanvasMenu .permissions, .rightCanvasMenu .visibility {
			margin: 0px 0px 25px 0px;
		}
		
		.rightCanvasMenu .permissions .icon {
			position: relative;
			top: 10px;
			left: 10px;
			width: 40px;
			height: 40px;
			/*border: 1px solid #6699FF;*/
			background-image: url("images/group_inactive.png");
			cursor: pointer;
		}
		
		.rightCanvasMenu .permissions.active .icon {
			background-image: url("images/group_active.png");
		}
		
		
		.rightCanvasMenu .visibility .icon {
			position: relative;
			top: 10px;
			left: 10px;
			width: 40px;
			height: 40px;
			cursor: pointer;
			/*border: 1px solid #6699FF;*/
			background-image: url("images/visibility_inactive.png");
		}
		
		.rightCanvasMenu .visibility.active .icon {
			background-image: url("images/visibility_active.png");
		}
		
		#menu {
			position: relative;
			top: 572px;
			/* OLD
			closed: 442
			open: 324;
			
			*/
			/* OLD
			/*top:572px;
			/*open: 454px;*/
			
			/* Closed = Open + 118px */
			width: 1024px;
			height: 146px;
			z-index: 6;
			background-image: url("images/menuBackground.png");
		}
		#menuTab {
			height: 28px;
		}
		
		#menuContent {
			height: 118px;
		}
		#menuContent .menuTabs {
			height: 60px;
		}
		#menuContent .menuTabs .tab {
			width: 120px;
			height: 60px;
		}
		
		#menuContent .slides {
			position: absolute;
			top: 35px;
			left: 494px;
		}
		
		#menuContent .slides .slideFrameButton {
			float: left;
			border: 2px solid transparent;
			width: 120px;
			height: 70px;
			margin: 0px 4px 0px;
		}
		
		
		#menuContent .slides .slideFrameButton.active {
			border-color: #3ab9db;
		}
		
		#slide1 {
			background: url("images/Slide1.png");
			background-size: 120px 70px;
			background-repeat:no-repeat;
		}
		
		#slide2 {
			background: url("images/Slide2.png");
			background-size: 120px 70px;
			background-repeat:no-repeat;
		}
		#slide3 {
			background: url("images/Slide3.png");
			background-size: 120px 70px;
			background-repeat:no-repeat;
		}
		#lessonsTab {
			float: left;
			background: url("images/lessonsTab_inactive.png");
		}
		
		#lessonsTab.active {
			background: url("images/lessonsTab_active.png");
		}
		#filesTab {
			float: left;
			background: url("images/filesTab_inactive.png");
		}
		
		#filesTab.active {
			background: url("images/filesTab_active.png");
		}
		#toolsTab {
			float: left;
			background: url("images/toolsTab_inactive.png");
		}
		
		#toolsTab.active {
			background: url("images/toolsTab_active.png");
		}
		
		#lessonsWindow {
			display: none;
			position: absolute;
			top: 62px;
			width: 360px;
			height: 420px;
			z-index: 6;
			background: url("images/lessonsTab_contents.png") no-repeat;
		}
		
		#loadFrictionLesson {
			position: relative;
			background: black;
			top: 240px;
			width: 360px;
			height: 40px;
			opacity: 0.1;
		}
		#filesWindow {
			display: none;
			position: absolute;
			top: 62px;
			left: 0px;
			width: 360px;
			height: 420px;
			z-index: 6;
			background: url("images/filesTab_contents.png") no-repeat;
		}
		
		#filesWindow .week6 {
			position: relative;
			top:240px;
			height: 40px;
			width: 360px;
			filter:alpha(opacity=60);opacity:.6;
		}
		#filesWindow .week6selected {
			display: none;
			position:relative;
			top: 200px;
			left: 4px;
			background: url("images/selectedWeekFiles.png");
			width: 586px;
			height: 130px;
		}
		#toolsWindow {
			display: none;
			position: absolute;
			top: 216px;
			left: 120px;
			width: 360px;
			height: 266px;
			z-index: 6;
			background: url("images/toolsTab_contents.png") no-repeat;
		}
		
		#toolsWindow .tools {
			position: relative;
			top: 50px;
			left: 10px;
		}
		
		
		#toolsWindow .tools .calculator,
		#toolsWindow .tools .ruler,
		#toolsWindow .tools .dictionary,
		#toolsWindow .tools .thesaurus {
			float: left;
			width: 60px;
			height: 60px;
			margin: 0px 12px;
		}
		
		#toolsWindow .tools .calculator .icon,
		#toolsWindow .tools .ruler .icon,
		#toolsWindow .tools .dictionary .icon,
		#toolsWindow .tools .thesaurus .icon {
			height: 60px;
			width: 60px;
		}
		
		#toolsWindow .tools .calculator .icon {
			background-image: url("images/calculator.png");
		}
		
		#toolsWindow .tools .ruler .icon {
			background-image: url("images/ruler.png");
		}
		#toolsWindow .tools .dictionary .icon {
			background-image: url("images/dictionary.png");
		}
		#toolsWindow .tools .thesaurus .icon {
			background-image: url("images/thesaurus.png");
		}
	</style>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery.event.drag-2.0.js"></script>
	<script src="<?php echo $path?>:4000/socket.io/socket.io.js"></script><!---->
	<!--<script src="node_modules/socket.io/lib/socket.io.js"></script><!---->
	<script type="text/javascript" src="scripts.js"></script>
	<script type="text/javascript">

	
	// Stroke Width Variables
	var width1 = 5;
	var width2 = 10;
	var width3 = 15;
	var width4 = 30;
	
	// Color Variables
	var color1 = "gray";
	var color2 = "red";
	var color3 = "green";
	var color4 = "yellow";
	
	// Position Variables
	var menuOpenTop = "454px";
	var menuClosedTop = "572px";
	
	/* OLD
	var menuOpenTop = "324px";
	var menuClosedTop = "442px";
	*/
	// Default Variables:
	var pencilColor = color1;
	var eraser = 0;
	var eraserColor = "white";
	var pencilWidth = width2;
	var eraserWidth = width2;
	var drawWidth = width2
	var drawColor = color1;
	
	// hide left canvas tabs
	function allOpenTabs_off() {
		$("#pencil").removeClass("open");
		$("#eraser").removeClass("open");
		$("#colorSelector").removeClass("open");
		$(".pencilWeights").hide();
		$(".eraserWeights").hide();
		$(".colorSelectorBoxes").hide();
	}
	
	// Left Canvas controls
	function allCanvasControls_off() {
		allOpenTabs_off();
		$("#pencil").removeClass("active");
		$("#eraser").removeClass("active");
		return;
	}
	
	function selectPencilWeight(weight) {
		$('#pencilWeight1').removeClass("active");
		$('#pencilWeight2').removeClass("active");
		$('#pencilWeight3').removeClass("active");
		$('#pencilWeight4').removeClass("active");

		var new_weight = window.width2;
		
		if (weight == 1) {
			new_weight=window.width1;
			$('#pencilWeight1').addClass("active");
		}
		else if(weight==2) {
			new_weight=window.width2;
			$('#pencilWeight2').addClass("active");
		}
		else if (weight==3) {
			new_weight=window.width3;
			$('#pencilWeight3').addClass("active");
		}
		else {
			new_weight=window.width4;
			$('#pencilWeight4').addClass("active");
		}
		
		$("#pencilWeights").hide();
		$("#pencil").removeClass("open");
		window.pencilWidth = new_weight;
		window.drawWidth = window.pencilWidth;
		return;
	}
	
	function selectEraserWeight(weight) {
		$('#eraserWeight1').removeClass("active");
		$('#eraserWeight2').removeClass("active");
		$('#eraserWeight3').removeClass("active");
		$('#eraserWeight4').removeClass("active");

		var new_weight = window.width2;
		
		if (weight == 1) {
			new_weight=window.width1;
			$('#eraserWeight1').addClass("active");
		}
		else if(weight==2) {
			new_weight=window.width2;
			$('#eraserWeight2').addClass("active");
		}
		else if (weight==3) {
			new_weight=window.width3;
			$('#eraserWeight3').addClass("active");
		}
		else {
			new_weight=window.width4;
			$('#eraserWeight4').addClass("active");
		}
		
		$("#eraserWeights").hide();
		$("#eraser").removeClass("open");
		window.eraserWidth = new_weight;
		window.drawWidth = window.eraserWidth;
		return;
	}
	
	
	function selectColor(color) {
		$('#colorBox1.colorBox').removeClass("active");
		$('#colorBox2.colorBox').removeClass("active");
		$('#colorBox3.colorBox').removeClass("active");
		$('#colorBox4.colorBox').removeClass("active");

		var new_color = window.color1;
		
		if (color == 1) {
			new_color=window.color1;
			$('#colorBox1').addClass("active");
		}
		else if(color==2) {
			new_color=window.color2;
			$('#colorBox2').addClass("active");
		}
		else if (color==3) {
			new_color=window.color3;
			$('#colorBox3').addClass("active");
		}
		else {
			new_color=window.color4;
			$('#colorBox4').addClass("active");
		}
		
		$("#colorSelectorBoxes").hide();
		$("#colorSelector").removeClass("open");
		
		// only change active color if the pencil is selected
		if (window.drawColor == window.pencilColor){
			window.drawColor = new_color;
		}
		
		window.pencilColor = new_color;
		$(".colorSelectorBox").css("background-color", new_color);
		return;
	}
	
	
	function show_menu() {
		var menu = $("#menu");
		menu.animate({"top": window.menuOpenTop}, 'fast');
		return;
	}
	
	function hide_menu() {
		var menu = $("#menu");
		hideAllTabWindows();
		menu.animate({top: window.menuClosedTop}, 'fast');
		return;
	}
	
	// Menu Toggle
	function toggle_menu() {
		var menu_pos = $("#menu").css("top");
		
		// closed
		if (menu_pos == window.menuClosedTop) {
			// open it
			show_menu();
		}
		else if (menu_pos == window.menuOpenTop) {
			hide_menu();
		}
		return;
	}
	
	// Left Canvas Toggles
	function undo_active() {
		var undo_div = $("#undo");
		undo_div.addClass("active");
		return;
	}
	
	function undo_inactive() {
		var undo_div = $("#undo");
		undo_div.removeClass("active");
		return;
	}
	
	
	function toggle_pencil() {
		var target_div = $("#pencil");
		var target_active = target_div.hasClass('active');
		var target_open = target_div.hasClass('open');
		
		if (target_active == 0 && target_open == 0) {
			allCanvasControls_off();
			target_div.addClass("active");
			target_div.addClass("open");
			$(".pencilWeights").show();
		}
		else if (target_active==1 && target_open==0) {
			target_div.addClass("open");
			$(".pencilWeights").show();
		}
		else {
			target_div.removeClass("open");
			$(".pencilWeights").hide();
		}
		window.drawColor = window.pencilColor;
		window.drawWidth = window.pencilWidth;
		window.eraser = 0;
		return;
	}
	
	function toggle_eraser() {
		var target_div = $("#eraser");
		var target_active = target_div.hasClass('active');
		var target_open = target_div.hasClass('open');
		
		if (target_active == 0 && target_open == 0) {
			allCanvasControls_off();
			target_div.addClass("active");
			target_div.addClass("open");
			$(".eraserWeights").show();
		}
		else if (target_active==1 && target_open==0) {
			target_div.addClass("open");
			$(".eraserWeights").show();
		}
		else {
			target_div.removeClass("open");
			$(".eraserWeights").hide();
		}
		window.eraser = 1;
		window.drawColor = window.eraserColor;
		window.drawWidth = window.eraserWidth;
		return;
	}
	
	
	function toggle_color() {
		var target_div = $("#colorSelector");
		var target_open = target_div.hasClass('open');
		
		if (target_open == 0) {
			allOpenTabs_off();
			target_div.addClass("open");
			$(".colorSelectorBoxes").show();
		}
		else {
			target_div.removeClass("open");
			$(".colorSelectorBoxes").hide();
		}
		return;
	}
	
	function toggle_permissions() {
		var target_div = $("#permissions");
		var target_active = target_div.hasClass('active');
		
		if (target_active == 0) {
			target_div.addClass("active");
			window.targetClass = 1;
		}
		else {
			target_div.removeClass("active");
			window.targetClass = 0;
		}
		return;
	}
	
	function toggle_visibility() {
		var canvas = $("#canvas");
		var target_div = $("#visibility");
		var target_active = target_div.hasClass('active');
		
		if (target_active == 0) {
			target_div.addClass("active");
			canvas.show();
		}
		else {
			target_div.removeClass("active");
			canvas.hide();
		}
		return;
	}
	// Hide Tab Helpers
	function hideAllTabWindows() {
		$("#lessonsWindow").hide();
		$("#filesWindow").hide();
		$("#toolsWindow").hide();
		inactiveAllTabs();
		return;
	}
	function inactiveAllTabs() {
		$("#lessonsTab").removeClass("active");
		$("#filesTab").removeClass("active");
		$("#toolsTab").removeClass("active");
		return;
	}
	
	
	// Tab Toggles
	function toggleLessonsTab() {
		var lessonsWindow = $("#lessonsWindow");

		if (lessonsWindow.is(":hidden")) {
			hideAllTabWindows();
			lessonsWindow.show();
			$("#lessonsTab").addClass("active");
		}
		else {
			lessonsWindow.hide();
			$("#lessonsTab").removeClass("active");
		}
		return;
	}
	
	function toggleFilesTab() {
		var filesWindow = $("#filesWindow");

		if (filesWindow.is(":hidden")) {
			hideAllTabWindows();
			filesWindow.show();
			$("#filesTab").addClass("active");
		}
		else {
			filesWindow.hide();
			$("#filesTab").removeClass("active");
		}
		return;
	}
	
	function toggleToolsTab() {
		var toolsWindow = $("#toolsWindow");
		
		if (toolsWindow.is(":hidden")) {
			hideAllTabWindows();
			toolsWindow.show();
			$("#toolsTab").addClass("active");
		}
		else {
			toolsWindow.hide();
			$("#toolsTab").removeClass("active");
		}
		return;
	}
	
	function week6popup() {
		$("#week6selected").show();
		return;
	}
	
	
	function loadTempSlides() {
		$("#slidesArea").html('<div class="slideFrameButton" id="slide1" onclick="loadSlide(1)"></div><div class="slideFrameButton" id="slide2" onclick="loadSlide(2)"></div><div class="slideFrameButton" id="slide3" onclick="loadSlide(3)"></div><div class="clear"></div>');
		loadSlide(1);
	}
	
	function loadSlide(slideNum) {
		var canvas = document.getElementById('canvas');
		var canvasBase = document.getElementById('canvasBase');
		var ctx = canvas.getContext('2d'); 
		var ctxBase = canvasBase.getContext('2d');
		
		ctx.clearRect(0, 0, canvas.width, canvas.height);
		ctxBase.clearRect(0, 0, canvasBase.width, canvasBase.height);
		var img = new Image();
		img.src = 'images/Slide'+slideNum+'.png';
		ctxBase.drawImage(img,0,0);
		
		$(".slideFrameButton").removeClass("active");
		$("#slide"+slideNum).addClass("active");
		
		// clear both canvases
	}
	
	<?php
		// Set Teacher variable
		if ($_GET['u']=="teacher") {
	?>
			var teacher = 1;
	<?php
		}
		else {
	?>
			var teacher = 0;
	<?php	
		}
	?>
	
	var targetClass = 0;
	
	$(function() {
		
		// sets toggle permissions
		$("#permissions").click(function(){
			toggle_permissions();
		});
		// sets toggle visibility
		$("#visibility").click(function(){
			//toggle_visibility();
		});
		// hide visibility button if teacher (cannot see different layers)
		if (teacher) {
			$("#visibility").hide();
		}
		
		
	});
	</script>
	<link rel="stylesheet" href="style.css" />

	<title>HTML5 Canvas + Node.JS Socket.io</title>
</head>
<body>
	<div id="cohesify">
		<div id="menu">
			<a href="javascript:toggle_menu();"><div id="menuTab"></div></a>
			<div id="menuContent">
				<div class="menuTabs">
					<div class="tab" id="lessonsTab" onclick="toggleLessonsTab()"></div>
					<div class="tab" id="filesTab" onclick="toggleFilesTab()"></div>
					<div class="tab" id="toolsTab" onclick="toggleToolsTab()"></div>
					<div class="clear"></div>
				</div>
				
				<div id="slidesArea" class="slides">
					
				</div>
			</div>
		</div>
		<article>
			<div class="canvasBG"></div>
			<canvas id="canvas" onmousedown="hide_menu();allOpenTabs_off()" onTouchStart="hide_menu();allOpenTabs_off()" width="1024" height="600"></canvas><!-- our canvas will be inserted here-->
			<canvas id="canvasBase" onmousedown="hide_menu()" onTouchStart="hide_menu()" width="1024" height="600"></canvas></article>
		
		<div class="leftCanvasMenu">
			<div id="pencil" class="pencil active">
				<div style="float:left"><a href="javascript:toggle_pencil()"><div class="icon"></div></a></div>
				<div class="pencilBG" style="float:left">
					<div id="pencilWeights" class="pencilWeights">
						<div class="weight"><a href="javascript:selectPencilWeight(1)"><div id="pencilWeight1" class="circle1"></div></a></div>
						<div class="weight"><a href="javascript:selectPencilWeight(2)"><div id="pencilWeight2" class="circle2 active"></div></a></div>
						<div class="weight"><a href="javascript:selectPencilWeight(3)"><div id="pencilWeight3" class="circle3"></div></a></div>
						<div class="weight"><a href="javascript:selectPencilWeight(4)"><div id="pencilWeight4" class="circle4"></div></a></div>
						<div class="clear"></div>
					</div>
				</div>
				<div class="clear"></div>
			</div>
			
			<div id="eraser" class="eraser">
				<div style="float:left"><a href="javascript:toggle_eraser()"><div class="icon"></div></a></div>
				<div class="eraserBG" style="float:left">
					<div id="eraserWeights" class="eraserWeights">
						<div class="weight"><a href="javascript:selectEraserWeight(1)"><div id="eraserWeight1" class="circle1"></div></a></div>
						<div class="weight"><a href="javascript:selectEraserWeight(2)"><div id="eraserWeight2" class="circle2 active"></div></a></div>
						<div class="weight"><a href="javascript:selectEraserWeight(3)"><div id="eraserWeight3" class="circle3"></div></a></div>
						<div class="weight"><a href="javascript:selectEraserWeight(4)"><div id="eraserWeight4" class="circle4"></div></a></div>
						<div class="clear"></div>
					</div>
				</div>
				<div class="clear"></div>
			</div>
			
			<div id="colorSelector" class="colorSelector">
				<div style="float:left"><a href="javascript:toggle_color()"><div class="icon"><div class="colorSelectorBox"></div></div></a></div>
				
				<div class="colorSelectorBG" style="float:left">
					<div id="colorSelectorBoxes" class="colorSelectorBoxes">
						<div class="color"><a href="javascript:selectColor(1)"><div id="colorBox1" class="colorBox active"></div></a></div>
						<div class="color"><a href="javascript:selectColor(2)"><div id="colorBox2" class="colorBox"></div></a></div>
						<div class="color"><a href="javascript:selectColor(3)"><div id="colorBox3" class="colorBox"></div></a></div>
						<div class="color"><a href="javascript:selectColor(4)"><div id="colorBox4" class="colorBox"></div></a></div>
						<div class="clear"></div>
					</div>
				</div>
				<div class="clear"></div>
			</div>
			
			<div id="undo" class="undo">
				<a href="javascript:void()" onmousedown="javascript:undo_active()" onTouchStart="javascript:undo_active()" onmouseup="javascript:undo_inactive()" onTouchEnd="javascript:undo_inactive()"><div class="icon"></div></a>
			</div>
		</div>
		
		<div class="rightCanvasMenu">
			<div id="permissions" class="permissions">
				<div class="icon"></div>
			</div>
			<div id="visibility" class="visibility active">
				<div class="icon"></div>
			</div>
		</div>
		
		
		
		<div class="fullWindows">
			<div id="lessonsWindow">
				<div id="loadFrictionLesson" onclick="loadTempSlides()"></div>
			</div>
			<div id="filesWindow">
				<a href="javascript: week6popup()"><div class="week6"></div></a>
				<div id="week6selected" class="week6selected"></div>
			</div>
			<div id="toolsWindow">
				<div class="tools">
					<div class="calculator"><div class="icon"></div></div>
					<div class="ruler"><div class="icon"></div></div>
					<div class="dictionary"><div class="icon"></div></div>
					<div class="thesaurus"><div class="icon"></div></div>
				</div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
	
	

</body>

