function Background() {
	this.init = initBackground;
	this.draw = drawBackground;
	this.loop = backgroundLoop;
	this.animate = animateBackground;
	this.stop = stopBackgroundAnimation;
}
function initBackground() {
	this.x = this.y = this.w = this.h = 0;
}
function drawBackground(ctx) {
	var lingrad = ctx.createLinearGradient(this.x,this.y,this.x,this.h);
	lingrad.addColorStop(0, bkcolor1);
	lingrad.addColorStop(1, bkcolor2);
	ctx.fillStyle = lingrad;
	ctx.fillRect(this.x,this.y,this.w,this.h);
}
function backgroundLoop() {
	this.time += speed;
	if(this.time < this.start) {
		return;
	}
	this.x = 0;
	this.w = width;
	this.h += height/25;
	this.y = (height - this.h)/2;
	if(this.h >= height) this.stop();
}
function animateBackground(start) {
	this.start = start;
	this.time = 0;
	var bk = this;
	this.id = setInterval(function(){bk.loop();}, speed);
}
function stopBackgroundAnimation() {
	clearInterval(this.id);
}

function Line1() {
	this.init = initLine1;
	this.draw = drawLine1;
	this.loop = line1Loop;
	this.animate = animateLine1;
	this.stop = stopLine1Animation;
}
function initLine1() {
	this.x = 3*width/2;
	this.y = height/5;
	this.maxw = width - width/10;
}
function drawLine1(ctx) {
	ctx.font="18pt Arial";
	ctx.textAlign = "center";
	ctx.fillStyle=textcolor;
	ctx.fillText(line1, this.x, this.y, this.maxw);
}
function line1Loop() {
	this.time += speed;
	if(this.time < this.start) {
		return;
	}
	this.x -= width/20;
	if(this.x <= width/2) this.stop();
}
function animateLine1(start) {
	this.start = start;
	this.time = 0;
	var l1 = this;
	this.id = setInterval(function(){l1.loop();}, speed);
}
function stopLine1Animation() {
	clearInterval(this.id);
}

function Line2() {
	this.init = initLine2;
	this.draw = drawLine2;
	this.loop = line2Loop;
	this.animate = animateLine2;
	this.stop = stopLine2Animation;
}
function initLine2() {
	this.x = width/2;
	this.y = 2*height/5 + 16;
	this.maxw = width - this.x*2;
}
function drawLine2(ctx) {
	ctx.save();
	ctx.beginPath();
	ctx.moveTo(0,2*height/5);
	ctx.lineTo(0,2*height/5-16);
	ctx.lineTo(width,2*height/5-16);
	ctx.lineTo(width,2*height/5);
	ctx.closePath();
	ctx.clip();
	ctx.font="16pt Arial";
	ctx.textAlign = "center";
	ctx.fillStyle='#000';
	
	ctx.fillText(line2, this.x, this.y, this.maxw);
	ctx.restore();
}
function line2Loop() {
	this.time += speed;
	if(this.time < this.start) {
		return;
	}
	this.y -= 1;
	if(this.y <= 2*height/5) this.stop();
}
function animateLine2(start) {
	this.start = start;
	this.time = 0;
	var l2 = this;
	this.id = setInterval(function(){l2.loop();}, speed);
}
function stopLine2Animation() {
	clearInterval(this.id);
}

function Logo(img) {
	this.init = initLogo;
	this.draw = drawLogo;
	this.loop = logoLoop;
	this.animate = animateLogo;
	this.stop = stopLogoAnimation;
	this.img = img;
}
function initLogo() {
	this.x = width/2-logowidth/2;
	this.y = height/2;
	this.alpha = 0;
}
function drawLogo(ctx) {
	ctx.save();
	ctx.globalAlpha = this.alpha;
	ctx.drawImage(img, this.x, this.y);
	ctx.restore();
}
function logoLoop() {
	this.time += speed;
	if(this.time < this.start) {
		return;
	}
	this.alpha += 0.02;
	if(this.alpha >= 1) this.stop();
}
function animateLogo(start) {
	this.start = start;
	this.time = 0;
	var logo = this;
	this.id = setInterval(function(){logo.loop();}, speed);
}
function stopLogoAnimation() {
	clearInterval(this.id);
}

function Buttons() {
	this.init = initButtons;
	this.loop = buttonsLoop;
	this.animate = animateButtons;
	this.stop = stopButtonsAnimation;

	this.replay = document.getElementById("replay");
	this.linkbutton = document.getElementById("linkbutton");

	this.replay.onclick = function() { init(); animate(); }
	this.linkbutton.onclick = function() { location.href = link; }
}
function initButtons() {
	this.replay.style.visibility = "hidden";
	this.linkbutton.style.visibility = "hidden";
}
function buttonsLoop() {
	this.time += speed;
	if(this.time < this.start) {
		return;
	}
	this.replay.style.visibility = "visible";
	this.linkbutton.style.visibility = "visible";
	this.stop();
}
function animateButtons(start) {
	this.start = start;
	this.time = 0;
	var btns = this;
	this.id = setInterval(function(){btns.loop();}, speed);
}
function stopButtonsAnimation() {
	clearInterval(this.id);
}

var bkground,l1,l2,logo,buttons;
function createObjects() {
	bkground = new Background();
	l1 = new Line1();
	l2 = new Line2();
	logo = new Logo(img);
	buttons = new Buttons();
}

function init() {
	bkground.init();
	l1.init();
	l2.init();
	logo.init();
	buttons.init();
}

function animate() {
	//bkground.animate(1000);
	l1.animate(1500);
	l2.animate(3000);
	//logo.animate(4000);
	buttons.animate(5000);
	
	setInterval(draw, speed);
}

function draw() {
	ctx.clearRect(0,0,width,height);
	bkground.draw(ctx);
	l1.draw(ctx);
	l2.draw(ctx);
	logo.draw(ctx);
}

/*document.write('<div style="width:300px;height:250px">');
document.write('<div id="replay" style="font-family:Arial;font-size:9px;position:absolute;margin:235px 0 0 5px;cursor:pointer">Replay</div>');
document.write('<div id="linkbutton" style="font-family:Arial;font-size:14px;font-weight:bold;position:absolute;margin:180px 0 0 100px;cursor:pointer;width:100px;text-align:center;line-height:25px;background:white;border-radius:5px">Visit</div>');
document.write('<canvas id="canvas" width="300" height="250">Your browser is unsupported</canvas>');
document.write('</div>');*/

var element = document.getElementById('canvas');
var ctx = element.getContext('2d');
var width = element.getAttribute('width');
var height = element.getAttribute('height');

var img = new Image();
img.src = logo;
img.onload = function() {
	createObjects();
	init();
	animate();
}