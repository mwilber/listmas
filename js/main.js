//(function ($) {

	//var pScale = 200;

	jQuery(document).ready(function($) {
		

		if (Modernizr.touch) { 
			// $('body').css('transition', 'all 100ms');
			// $('#create').css('transition', 'all 100ms');

			// $(window).on({
			// 	'touchmove': function(e) { 
			// 		DoParallax();
			// 	}
			// });

			//$('body').css('background-attachment', 'fixed');
			//$('#create').css('background-attachment', 'fixed');
			//$('#publish').css('background-attachment', 'fixed');
			//$('#share').css('background-attachment', 'fixed');
		}else{
			// $(window).on({
			// 	'scroll': function(e) { 
			// 		DoParallax();
			// 	}
			// });
		}

		function DoParallax(){

			SetParallax($('body'), 30);
			SetParallax($('#create'), 20);
			//SetParallax($('#publish'), 30);
			//SetParallax($('#share'), 30);

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

		//DoParallax();
		$('#fullpage').fullpage({
				anchors: ['homepage', 'createpage', 'publishpage','sharepage','downloadpage'],
				navigation: true,
				navigationPosition: 'right',
				navigationTooltips: ['Info', 'Create', 'Publish', 'Share', 'Download'],
				onLeave: function(index, nextIndex, direction){
					//
				},
				afterLoad: function(anchorLink, index){
					$('.animate').removeClass('animate');
					if( anchorLink == "createpage" ){
						$('.create-frame').addClass('animate');
					}
				},
				//afterRender: function(){alert('a render');},
				//afterResize: function(){alert('a resize');},
				//afterSlideLoad: function(anchorLink, index, slideAnchor, slideIndex){alert('a s load');},
			});
	});

//}(jQuery))