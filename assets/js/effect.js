// $(window).load(function(){
// 	$('.loading').fadeOut('fast');
// 	$('.container').fadeIn('fast');
// });
$('document').ready(function(){
		var vw;
		$(window).resize(function(){
			 vw = $(window).width()/2;
			$('#b1,#b2,#b3,#b4,#b5,#b6,#b7').stop();
			$('#b11').animate({top:240, left: vw-350},500);
			$('#b22').animate({top:240, left: vw-250},500);
			$('#b33').animate({top:240, left: vw-150},500);
			$('#b44').animate({top:240, left: vw-50},500);
			$('#b55').animate({top:240, left: vw+50},500);
			$('#b66').animate({top:240, left: vw+150},500);
			$('#b77').animate({top:240, left: vw+250},500);
		});

		flying_ballon();

});

function flying_ballon(){
	$('.balloon-border').animate({top:-500},8000);
	$('#b1,#b4,#b5,#b7').addClass('balloons-rotate-behaviour-one');
	$('#b2,#b3,#b6').addClass('balloons-rotate-behaviour-two');
	// $('#b3').addClass('balloons-rotate-behaviour-two');
	// $('#b4').addClass('balloons-rotate-behaviour-one');
	// $('#b5').addClass('balloons-rotate-behaviour-one');
	// $('#b6').addClass('balloons-rotate-behaviour-two');
	// $('#b7').addClass('balloons-rotate-behaviour-one');
	loopOne();
	loopTwo();
	loopThree();
	loopFour();
	loopFive();
	loopSix();
	loopSeven();
	
}


function loopOne() {
	var randleft = 1000*Math.random();
	var randtop = 500*Math.random();
	$('#b1').animate({left:randleft,bottom:randtop},10000,function(){
		loopOne();
	});
}
function loopTwo() {
	var randleft = 1000*Math.random();
	var randtop = 500*Math.random();
	$('#b2').animate({left:randleft,bottom:randtop},10000,function(){
		loopTwo();
	});
}
function loopThree() {
	var randleft = 1000*Math.random();
	var randtop = 500*Math.random();
	$('#b3').animate({left:randleft,bottom:randtop},10000,function(){
		loopThree();
	});
}
function loopFour() {
	var randleft = 1000*Math.random();
	var randtop = 500*Math.random();
	$('#b4').animate({left:randleft,bottom:randtop},10000,function(){
		loopFour();
	});
}
function loopFive() {
	var randleft = 1000*Math.random();
	var randtop = 500*Math.random();
	$('#b5').animate({left:randleft,bottom:randtop},10000,function(){
		loopFive();
	});
}

function loopSix() {
	var randleft = 1000*Math.random();
	var randtop = 500*Math.random();
	$('#b6').animate({left:randleft,bottom:randtop},10000,function(){
		loopSix();
	});
}
function loopSeven() {
	var randleft = 1000*Math.random();
	var randtop = 500*Math.random();
	$('#b7').animate({left:randleft,bottom:randtop},10000,function(){
		loopSeven();
	});
}

//alert('hello');