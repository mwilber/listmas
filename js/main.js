//(function ($) {

	//var pScale = 200;

	jQuery(document).ready(function($) {
		$(window).scroll(function(){

			DoParallax();

		});

		function DoParallax(){

			SetParallax($('body'), 100);
			SetParallax($('#create'), 60);
			//SetParallax($('#publish'), 100);
			//SetParallax($('#share'), 100);

			//$.each($('.container'),function(){
			//	SetParallax(this, 100);
			//});

			//$.each($('.bkg.one'),function(){
			//	SetParallax(this, 60);
			//});
			// $.each($('.bkg.two'),function(){
			// 	SetParallax(this, 125);
			// });
			// $.each($('.bkg.three'),function(){
			// 	SetParallax(this, 100);
			// });
			// $.each($('.bkg.four'),function(){
			// 	SetParallax(this, 75);
			// });
			// $.each($('.bkg.five'),function(){
			// 	SetParallax(this,50);
			// });
		}

		function SetParallax(pElem, pScale){
			

				// //var dctr = ($(pElem).offset().top+($(pElem).height()/2))-($(document).scrollTop()-($(window).height()/2));
				var dctr = ($(pElem).offset().top+($(pElem).height()/2))-($(document).scrollTop()+($(window).height()/2));
				var nctr = dctr/$(window).height();
				// var tnctr = (nctr+1)/2
				// var poffset = (-pScale)*(tnctr-.5);
				// //console.log(dctr, nctr, tnctr, poffset);
				var poffset = -pScale*nctr;

				// var poffset = (
				// 				(-pScale/4)*
				// 				(
				// 					(
				// 						$(this).offset().top-($(document).scrollTop()+($(window).height()/2))
				// 					)
				// 					/$(window).height()
				// 				)
				// 			);
				// poffset -=(pScale/8);

				//console.log($(this).offset().top, $(document).scrollTop(), $(window).height(), (($(this).offset().top-($(document).scrollTop()+($(window).height()/2)))/$(window).height()), poffset );
				//$(this).find('.parallax-background').css('top',poffset+"%");
				//$(this).find('.parallax-background').css('transform','translateY('+poffset+"%)");
				$(pElem).css('background-position','0px '+poffset+'px');
			
		}

		DoParallax();
	});

//}(jQuery))