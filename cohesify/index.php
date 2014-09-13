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
			width: 1280px;
			height: 800px;
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
		.leftCanvasMenu {
			position: relative;
			z-index:5;
			top: 0px;
		}
		
		.rightCanvasMenu {
			position: absolute;
			z-index:5;
			width: 400px;
			height: 60px;
			left: 1030px;/**/
			top: 0px;
		}
		.leftCanvasMenu .pencil, .leftCanvasMenu .eraser, .leftCanvasMenu .colorSelector, .leftCanvasMenu .undo {
			float: left;
			position: relative;
			height: 60px;
			width: 60px;
		}
		.leftCanvasMenu .pencil.open, .leftCanvasMenu .eraser.open, .leftCanvasMenu .colorSelector.open {
			/*background-color: #3ab9db;*/
			background-color: #DFF2F8;
		}
		
		.leftCanvasMenu .pencil .icon {
			background-image: url("images/icons/pencil_inactive.png");
		}
		.leftCanvasMenu .pencil.active .icon,
		.leftCanvasMenu .pencil.open .icon {
			background-image: url("images/icons/pencil_active.png");
		}
		
		.leftCanvasMenu .eraser .icon {
			background-image: url("images/icons/eraser_inactive.png");
		}
		.leftCanvasMenu .eraser.active .icon,
		.leftCanvasMenu .eraser.open .icon {
			background-image: url("images/icons/eraser_active.png");
		}
		
		
		.leftCanvasMenu .undo .icon {
			background-image: url("images/icons/undo_inactive.png");
		}
		.leftCanvasMenu .undo.active .icon {
			background-image: url("images/icons/undo_active.png");
		}
		
		.leftCanvasMenu .pencil .icon, .leftCanvasMenu .eraser .icon, .leftCanvasMenu .colorSelector .icon, .leftCanvasMenu .undo .icon {
			position: relative;
			top: 10px;
			left: 10px;
			width: 40px;
			height: 40px;
			/*border: 1px solid #6699FF;*/
		}
		
		
		.leftCanvasMenu .pencilBG,
		.leftCanvasMenu .eraserBG,
		.leftCanvasMenu .colorSelectorBG {
			display: none;
			position: absolute;
			width: 60px;
			z-index: 10;
			
			-webkit-border-top-left-radius: 10px;
			-webkit-border-top-right-radius: 10px;
			-moz-border-radius-topleft: 10px;
			-moz-border-radius-topright: 10px;
			border-top-left-radius: 10px;
			border-top-right-radius: 10px;
			/*background: #3ab9db;*/
			background: #DFF2F8;
		}
		
		.leftCanvasMenu .pencilBG,
		.leftCanvasMenu .eraserBG {
			top: -240px;
		}
		
		.leftCanvasMenu .colorSelectorBG {
			top: -250px;
		}
		
		
		.leftCanvasMenu .pencilBG {
			left: 0px;
		}
		.leftCanvasMenu .eraserBG {
			left: 60px;
		}
		.leftCanvasMenu .colorSelectorBG {
			left: 120px;
		}
		
		.leftCanvasMenu .colorSelector .colorSelectorBG .colorSelectorBoxes {
			display: none;
		}
		
		
		.pencilBG .pencilWeights .weight,
		.eraserBG .eraserWeights .weight {
			width: 40px;
			height: 40px;
			padding: 10px 10px;
		}
		
		.colorSelectorBG .colorSelectorBoxes .color {
			width: 30px;
			height: 30px;
			padding: 10px 15px;
		}
		
		.pencilBG .pencilWeights .weight .circle1,
		.pencilBG .pencilWeights .weight .circle2,
		.pencilBG .pencilWeights .weight .circle3,
		.pencilBG .pencilWeights .weight .circle4,
		.eraserBG .eraserWeights .weight .circle1,
		.eraserBG .eraserWeights .weight .circle2,
		.eraserBG .eraserWeights .weight .circle3,
		.eraserBG .eraserWeights .weight .circle4 {
			display: block;
			background: #666;
		}
		
		
		.pencilBG .pencilWeights .weight .circle1.active,
		.pencilBG .pencilWeights .weight .circle2.active,
		.pencilBG .pencilWeights .weight .circle3.active,
		.pencilBG .pencilWeights .weight .circle4.active,
		.eraserBG .eraserWeights .weight .circle1.active,
		.eraserBG .eraserWeights .weight .circle2.active,
		.eraserBG .eraserWeights .weight .circle3.active,
		.eraserBG .eraserWeights .weight .circle4.active {
			/*activeColor*/
			/*background: #dcfdff;*/
			background: #419ED8;
		}
		.colorSelectorBG .colorSelectorBoxes .color .colorBox {
			width: 30px;
			height: 30px;
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
		
		#colorBox5 {
			background-color: blue;
		}
		
		.colorSelectorBG .colorSelectorBoxes .color .colorBox.active {
			border: 1px solid #419ED8;
		}
		
		.pencilBG .pencilWeights .weight .circle1,
		.eraserBG .eraserWeights .weight .circle1 {
			width: 10px;
			height: 10px;
			border-radius: 5px;
			-moz-border-radius: 5px;
			-webkit-border-radius: 5px;
			-khtml-border-radius: 5px;
			margin: 15px 0px 0px 15px;
		}
		
		.pencilBG .pencilWeights .weight .circle2,
		.eraserBG .eraserWeights .weight .circle2 {
			width: 15px;
			height: 15px;
			border-radius: 7.5px;
			-moz-border-radius: 7.5px;
			-webkit-border-radius: 7.5px;
			-khtml-border-radius: 7.5px;
			margin: 12.5px 0px 0px 12.5px;
		}
		
		.pencilBG .pencilWeights .weight .circle3,
		.eraserBG .eraserWeights .weight .circle3 {
			width: 20px;
			height: 20px;
			border-radius: 10px;
			-moz-border-radius: 10px;
			-webkit-border-radius: 10px;
			-khtml-border-radius: 10px;
			margin: 10px 0px 0px 10px;
		}
		
		.pencilBG .pencilWeights .weight .circle4,
		.eraserBG .eraserWeights .weight .circle4 {
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
			top: 4px;
			left: 4px;
			width: 30px;
			height: 30px;
			background-color: gray;
			border: 1px solid #419ED8;
		}
		
		.rightCanvasMenu .permissions, .rightCanvasMenu .visibility, .rightCanvasMenu .slideLeft, .rightCanvasMenu .slideRight {
			float: left;
			position: relative;
			height: 60px;
			width: 60px;
		}
		
		.rightCanvasMenu .permissions .icon {
			position: relative;
			top: 10px;
			left: 10px;
			width: 40px;
			height: 40px;
			/*border: 1px solid #6699FF;*/
			background-image: url("images/icons/volunteer_inactive.png");
			cursor: pointer;
		}
		
		.rightCanvasMenu .permissions.waiting .icon {
			background-image: url("images/icons/volunteer_active.png");
       		opacity:0.25;
		}
		
		.rightCanvasMenu .permissions.active .icon {
			background-image: url("images/icons/volunteer_active.png");
		}
		
		
		.rightCanvasMenu .visibility .icon {
			position: relative;
			top: 10px;
			left: 10px;
			width: 40px;
			height: 40px;
			cursor: pointer;
			/*border: 1px solid #6699FF;*/
			background-image: url("images/icons/noteshare_inactive.png");
		}
		
		.rightCanvasMenu .visibility.active .icon {
			background-image: url("images/icons/noteshare_active.png");
		}
		
		
		.rightCanvasMenu .slideLeft .icon {
			position: relative;
			top: 10px;
			left: 10px;
			width: 40px;
			height: 40px;
			background-image: url("images/icons/previous_inactive.png");
			cursor: pointer;
		}
		
		.rightCanvasMenu .slideLeft.active .icon {
			background-image: url("images/icons/previous_active.png");
		}
		
		.rightCanvasMenu .slideRight .icon {
			position: relative;
			top: 10px;
			left: 10px;
			width: 40px;
			height: 40px;
			background-image: url("images/icons/next_inactive.png");
			cursor: pointer;
		}
		
		.rightCanvasMenu .slideRight.active .icon {
			background-image: url("images/icons/next_active.png");
		}
		
		#menu {
			position: relative;
			top: 740px;
			/* OLD
			closed: 442
			open: 324;
			
			*/
			/* OLD
			/*top:572px;
			/*open: 454px;*/
			
			/* Closed = Open + 118px */
			width: 1280px;
			height: 180px;
			z-index: 6;
			background-image: url("images/menus/menu_bg.png");
			background-position-y: 10px;
		}
		#menuTab {
			position: relative;
			height: 28px;
			width: 90px;
			top: 34px;
			left: 595px;
			cursor: hand;
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
		
		#slidesArea {
			position: absolute;
			top: 70px;
			left: 550px;
		}
		#slideCarousel {
			position: absolute;
			top: 155px;
			left: 760px;
			height: 20px;
			width: 300px;
		}
		#slideCarousel .slideCarouselButton {
			float: left;
			height: 20px;
			width: 20px;
			margin: 0px 2px;
		}
		
		#slideCarousel .slideCarouselButton .icon {
			border-radius: 50%;
			width: 8px;
			height: 8px;
			border: 1px solid #666;
			background-color: #B8E3EE;
			margin: 5px;
			/* width and height can be anything, as long as they're equal */
		}
		
		#slideCarousel .slideCarouselButton.active .icon {
			border-radius: 50%;
			width: 13px;
			height: 13px;
			border: 1px solid #666;
			background-color: #419ED8;
			margin: 2px;
			/* width and height can be anything, as long as they're equal */
		}
		#carBtn0 {
			position: relative;
			left: 105px;
			
		}
		#menuContent .slides .slideFrameButton {
			float: left;
			border: 2px solid transparent;
			width: 120px;
			height: 75px;
			margin: 0px 4px 0px;
			background-color: #FFF;
			box-shadow: 2px 2px 10px #666;
		}
		
		
		#menuContent .slides .slideFrameButton.active {
			/*border-color: #3ab9db;*/
			border-color: #419ED8;
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
		#slide4 {
			background: url("images/Slide4.png");
			background-size: 120px 70px;
			background-repeat:no-repeat;
		}
		#slide5 {
			background: url("images/Slide5.png");
			background-size: 120px 70px;
			background-repeat:no-repeat;
		}
		#slide6 {
			background: url("images/Slide6.png");
			background-size: 120px 70px;
			background-repeat:no-repeat;
		}
		#slide7 {
			background: url("images/Slide7.png");
			background-size: 120px 70px;
			background-repeat:no-repeat;
		}
		#slide8 {
			background: url("images/Slide8.png");
			background-size: 120px 70px;
			background-repeat:no-repeat;
		}
		#slide9 {
			background: url("images/Slide9.png");
			background-size: 120px 70px;
			background-repeat:no-repeat;
		}
		#slide10 {
			background: url("images/Slide10.png");
			background-size: 120px 70px;
			background-repeat:no-repeat;
		}
		#blankSlide {
			position: absolute;
			left: 260px;
		}
		#lessonsTab {
			float: left;
			background: url("images/menus/lessons_tab_inactive.png");
		}
		
		#lessonsTab.active {
			background: url("images/menus/lessons_tab_active.png");
		}
		#filesTab {
			float: left;
			background: url("images/menus/files_tab_inactive.png");
		}
		
		#filesTab.active {
			background: url("images/menus/files_tab_active.png");
		}
		#toolsTab {
			float: left;
			background: url("images/menus/tools_tab_inactive.png");
		}
		
		#toolsTab.active {
			background: url("images/menus/tools_tab_active.png");
		}
		
		#lessonsWindow {
			display: none;
			position: absolute;
			top: 140px;
			width: 360px;
			height: 540px;
			z-index: 6;
			background: url("images/menus/lessons_browser.png") no-repeat;
		}
		
		#loadFrictionLesson {
			position: relative;
			background: #00F;
			top: 360px;
			width: 360px;
			height: 60px;
			opacity: 0.05;
			cursor: hand;
		}
		#filesWindow {
			display: none;
			position: absolute;
			top: 140px;
			left: 0px;
			width: 360px;
			height: 540px;
			z-index: 6;
			background: url("images/menus/files_browser.png") no-repeat;
		}
		
		#filesWindow .week6 {
			position: relative;
			top: 358px;
			height: 60px;
			width: 360px;
			background: #00F;
			opacity:0.05;
			cursor: hand;
		}
		#filesWindow .week6selected {
			display: none;
			position:relative;
			top: -60px;
			left: 0px;
			background: url("images/menus/files_browser_friction.png");
			width: 360px;
			height: 540px;
		}
		
		#filesWindow .week6selected .closeWeek6 {
			position: relative;
			top: 15px;
			left: 95px;
			height: 30px;
			width: 95px;
			cursor: hand;
		}
		#toolsWindow {
			display: none;
			position: absolute;
			top: 440px;
			left: 0px;
			width: 360px;
			height: 240px;
			z-index: 6;
			background: url("images/menus/tools_browser.png") no-repeat;
		}
		
		#toolsWindow .tools {
			display: none;
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
		#boardWriteStatus {
			display: none;
			font-family: "Segoe WP";
			font-weight: 200;
			position: absolute;
			top: 0px;
			left: 1020px;
			width: 220px;
			padding: 5px 20px 10px;
			background: #B8E3EE;
			z-index:7;
		}
		#preload {
			height: 0px;
			width: 0px;
			display: inline;
			background: url("images/menus/lessons_tab_active.png");
			background: url("images/menus/files_tab_active.png");
			background: url("images/menus/tools_tab_active.png");
			background: url("images/Slide1.png");
			background: url("images/Slide2.png");
			background: url("images/Slide3.png");
			background: url("images/Slide4.png");
			background: url("images/Slide5.png");
			background: url("images/Slide6.png");
			background: url("images/Slide7.png");
			background: url("images/Slide8.png");
			background: url("images/Slide9.png");
			background: url("images/Slide10.png");
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
	var color5 = "blue";
	
	// Position Variables
	var menuOpenTop = "620px";
	var menuClosedTop = "740px";
	
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
	var numSlides = 1;
	var currentSlide = 1;
	
	// hide left canvas tabs
	function allOpenTabs_off() {
		$("#pencil").removeClass("open");
		$("#eraser").removeClass("open");
		$("#colorSelector").removeClass("open");
		$("#pencilBG").hide();
		$("#eraserBG").hide();
		$("#colorSelectorBG").hide();
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
		
		// default weight
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
		
		$("#pencilBG").hide();
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
		
		$("#eraserBG").hide();
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
		$('#colorBox5.colorBox').removeClass("active");

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
		else if (color==4) {
			new_color=window.color4;
			$('#colorBox4').addClass("active");
		}
		else {
			new_color=window.color5;
			$('#colorBox5').addClass("active");
		}
		
		$("#colorSelectorBG").hide();
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
		}
		else if (target_active==1 && target_open==0) {
			target_div.addClass("open");
			$("#pencilBG").show();
		}
		else {
			target_div.removeClass("open");
			$("#pencilBG").hide();
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
		}
		else if (target_active==1 && target_open==0) {
			target_div.addClass("open");
			$("#eraserBG").show();
		}
		else {
			target_div.removeClass("open");
			$("#eraserBG").hide();
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
			$("#colorSelectorBG").show();
		}
		else {
			target_div.removeClass("open");
			$("#colorSelectorBG").hide();
		}
		return;
	}
	
	function toggle_permissions() {
		var target_div = $("#permissions");
		var target_active = target_div.hasClass('active');
		var target_waiting = target_div.hasClass('waiting');
		
		if (target_active == 0) {
			target_div.addClass("waiting");
			setTimeout(activeBoard, 5000);
		}
		else {
			target_div.removeClass("active");
			target_div.removeClass("waiting");
			window.targetClass = 0;
			hideWriteStatus();
		}
		return;
	}
	
	function activeBoard() {
		var target_div = $("#permissions");
			target_div.removeClass("waiting");
			target_div.addClass("active");
			showWriteStatus();
			window.targetClass = 1;
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
		hide_week6();
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
	
	function show_week6() {
		$("#week6selected").show();
	}
	
	function hide_week6() {
		$("#week6selected").hide();
	}
	
	
	function loadTempSlides() {
		$("#slidesArea").html('<div class="slideFrameButton" id="slide1" onclick="loadSlide(1)"></div><div class="slideFrameButton" id="slide2" onclick="loadSlide(2)"></div><div class="slideFrameButton" id="slide3" onclick="loadSlide(3)"></div><div class="slideFrameButton" id="slide4" onclick="loadSlide(4)"></div><div class="slideFrameButton" id="slide5" onclick="loadSlide(5)"></div><div class="clear"></div>');
		
		// Load Carousel
		
		$("#slideCarousel").html('<div class="slideCarouselButton active" id="carBtn1" onclick="loadSlide(1)"><div class="icon"></div></div><div class="slideCarouselButton" id="carBtn2" onclick="loadSlide(2)"><div class="icon"></div></div><div class="slideCarouselButton" id="carBtn3" onclick="loadSlide(3)"><div class="icon"></div></div><div class="slideCarouselButton" id="carBtn4" onclick="loadSlide(4)"><div class="icon"></div></div><div class="slideCarouselButton" id="carBtn5" onclick="loadSlide(5)"><div class="icon"></div></div><div class="slideCarouselButton" id="carBtn6" onclick="loadSlide(6)"><div class="icon"></div></div><div class="slideCarouselButton" id="carBtn7" onclick="loadSlide(7)"><div class="icon"></div></div><div class="slideCarouselButton" id="carBtn8" onclick="loadSlide(8)"><div class="icon"></div></div><div class="slideCarouselButton" id="carBtn9" onclick="loadSlide(9)"><div class="icon"></div></div><div class="slideCarouselButton" id="carBtn10" onclick="loadSlide(10)"><div class="icon"></div></div><div class="clear"></div>');
		
		window.numSlides=10;
		window.currentSlide=1;
		loadSlide(1);
	}
	
	function loadSlide(slideNum) {
		window.currentSlide = slideNum;
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
		
		$("#slideLeft").removeClass("active");
		$("#slideRight").removeClass("active");
		
		if (window.currentSlide>1) {
			$("#slideLeft").addClass("active");
		}
		
		if (window.currentSlide<window.numSlides) {
			$("#slideRight").addClass("active");
		}
		
		// update carousel
		$(".slideCarouselButton").removeClass("active");
		$("#carBtn"+slideNum).addClass("active");
	}
	
	function slidePrev() {
		var currentSlide = window.currentSlide;
		prevSlide = currentSlide-1;
		
		if (currentSlide>1) {
			loadSlide(prevSlide);
		}
		return;
	}
	
	function slideNext() {
		var currentSlide = window.currentSlide;
		nextSlide = currentSlide+1;
		
		if (currentSlide<window.numSlides) {
			loadSlide(nextSlide);
		}
		return;
	}
	
	function hideWriteStatus() {
		$("#boardWriteStatus").hide();
	}
	
	function showWriteStatus() {
		$("#boardWriteStatus").show();
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
			$("#permissions").hide();
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
			<div class="leftCanvasMenu">
				<div id="pencil" class="pencil active">
					<a href="javascript:toggle_pencil()"><div class="icon"></div></a>
					<div class="clear"></div>
				</div>
				<div id="pencilBG" class="pencilBG">
					<div id="pencilWeights" class="pencilWeights">
						<div class="weight"><a href="javascript:selectPencilWeight(1)"><div id="pencilWeight1" class="circle1"></div></a></div>
						<div class="weight"><a href="javascript:selectPencilWeight(2)"><div id="pencilWeight2" class="circle2 active"></div></a></div>
						<div class="weight"><a href="javascript:selectPencilWeight(3)"><div id="pencilWeight3" class="circle3"></div></a></div>
						<div class="weight"><a href="javascript:selectPencilWeight(4)"><div id="pencilWeight4" class="circle4"></div></a></div>
						<div class="clear"></div>
					</div>
				</div>
				
				<div id="eraser" class="eraser">
					<div style="float:left"><a href="javascript:toggle_eraser()"><div class="icon"></div></a></div>
					<div class="clear"></div>
				</div>
				
				<div id="eraserBG" class="eraserBG">
					<div id="eraserWeights" class="eraserWeights">
						<div class="weight"><a href="javascript:selectEraserWeight(1)"><div id="eraserWeight1" class="circle1"></div></a></div>
						<div class="weight"><a href="javascript:selectEraserWeight(2)"><div id="eraserWeight2" class="circle2 active"></div></a></div>
						<div class="weight"><a href="javascript:selectEraserWeight(3)"><div id="eraserWeight3" class="circle3"></div></a></div>
						<div class="weight"><a href="javascript:selectEraserWeight(4)"><div id="eraserWeight4" class="circle4"></div></a></div>
						<div class="clear"></div>
					</div>
				</div>
				
				<div id="colorSelector" class="colorSelector">
					<div style="float:left"><a href="javascript:toggle_color()"><div class="icon"><div class="colorSelectorBox"></div></div></a></div>
					
					<div class="clear"></div>
				</div>
				<div id="colorSelectorBG" class="colorSelectorBG">
					<div id="colorSelectorBoxes" class="colorSelectorBoxes">
						<div class="color"><a href="javascript:selectColor(1)"><div id="colorBox1" class="colorBox active"></div></a></div>
						<div class="color"><a href="javascript:selectColor(2)"><div id="colorBox2" class="colorBox"></div></a></div>
						<div class="color"><a href="javascript:selectColor(3)"><div id="colorBox3" class="colorBox"></div></a></div>
						<div class="color"><a href="javascript:selectColor(4)"><div id="colorBox4" class="colorBox"></div></a></div>
						<div class="color"><a href="javascript:selectColor(5)"><div id="colorBox5" class="colorBox"></div></a></div>
						<div class="clear"></div>
					</div>
				</div>
					
				<div id="undo" class="undo">
					<a href="javascript:void()" onmousedown="javascript:undo_active()" onTouchStart="javascript:undo_active()" onmouseup="javascript:undo_inactive()" onTouchEnd="javascript:undo_inactive()"><div class="icon"></div></a>
				</div>
			</div>


			<div id="menuTab" onclick="toggle_menu()"></div>
			<div class="clear"></div>
			<div id="menuContent">
				<div class="menuTabs">
					<div class="tab" id="lessonsTab" onclick="toggleLessonsTab()"></div>
					<div class="tab" id="filesTab" onclick="toggleFilesTab()"></div>
					<div class="tab" id="toolsTab" onclick="toggleToolsTab()"></div>
					<div class="clear"></div>
				</div>
				
				<div id="slidesArea" class="slides">
					<div class="slideFrameButton active" id="blankSlide"></div>
				</div>
				<div id="slideCarousel" class="slideCarousel">
					<div class="slideCarouselButton active" id="carBtn0">
						<div class="icon"></div>	
					</div>
				</div>
			</div>
			
			
			<div class="rightCanvasMenu">
				<div id="permissions" class="permissions">
					<div class="icon"></div>
				</div>
				<div id="visibility" class="visibility">
					<div class="icon"></div>
				</div>
				<div id="slideLeft" class="slideLeft" onclick="slidePrev()">
					<div class="icon"></div>
				</div>
				<div id="slideRight" class="slideRight" onclick="slideNext()">
					<div class="icon"></div>
				</div>
			</div>
		</div>
		<article>
			<div class="canvasBG"></div>
			<canvas id="canvas" onmousedown="hide_menu();allOpenTabs_off()" onTouchStart="hide_menu();allOpenTabs_off()" width="1024" height="600"></canvas><!-- our canvas will be inserted here-->
			<canvas id="canvasBase" onmousedown="hide_menu()" onTouchStart="hide_menu()" width="1024" height="600"></canvas></article>
		
		
		
		
		<div class="fullWindows">
			<div id="lessonsWindow">
				<div id="loadFrictionLesson" onclick="loadTempSlides()"></div>
			</div>
			<div id="filesWindow">
				<div class="week6" onclick="show_week6()"></div>
				<div id="week6selected" class="week6selected">
					<div id="closeWeek6" class="closeWeek6" onclick="hide_week6()"></div>
				</div>
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
		<div id="boardWriteStatus">You are now writing to the class</div>
	</div>
	<div id="preload"></div>
	

</body>

