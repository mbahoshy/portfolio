		function imgLarge () {
			xid = $(this).attr('id');
			var $imgwait = $('.shadow-img').attr('src', '../images/' + xid);
			$('.shadow-container').fadeToggle('slow', 'linear');
			var newtop;
			$imgwait.on('load', function () {
				newtop = Math.round( 
					(($('.shadow').height()) - ($('.shadow-img').height())) / 2
				);
				$('.shadow-img').css('top', newtop);
			});
		}
		
		function vidLarge () {
			xid = $(this).attr('id');
			$('.shadow-video').attr('src', '//www.youtube.com/embed/' + xid);
			$('.shadow-video-container').fadeToggle('slow', 'linear');
			var newtop = Math.round( 
				(($('.vid-shadow').height()) - 520) / 2
			);
			$('.shadow-video').css('top', newtop);
			$('.shadow-video').attr('display', 'inline');
		}
			
		$(document).ready(function(){
			$('.ex-click').click({param: this.id}, imgLarge);
			$('.vid-click').click({param: this.id}, vidLarge);
			$('.shadow').click(function () {$('.shadow-container').fadeToggle('slow', 'linear'); $('.shadow-img').attr('src', '');});
			$('.vid-shadow').click(function () {$('.shadow-video-container').fadeToggle('slow', 'linear'); $('.shadow-video').attr('src', '');});
			
			
			$('.arrow-right').click(changeSlide);
			$('.arrow-left').click(changeSlide);

			
			slides = $('.slide');
			slides_number = slides.length;
			
			for (i=0; i<slides_number; i++) {
				slides[i].id = 'slide_' + (1+i);
				$('#slider1').append('<span class="slide-select" id="ss' + (1+i) + '">Slide ' + (1+i) + '</span>');
				
			}
	
			$('#ss1').addClass('ss-active');
			
			var elementsToBeHighlighted = SyntaxHighlighter.findElements().length,
			
			highlightedElements = 0;

			SyntaxHighlighter.all();

			// Create callback for syntax highlight completion
			SyntaxHighlighter.complete = function(callback){

			  (function recountHighlightedElements() {
				setTimeout(function () {
				  highlightedElements = $('.syntaxhighlighter');
				  if (highlightedElements.length < elementsToBeHighlighted) {
					  recountHighlightedElements();
				  } else {
					  callback();
				  }
				}, 200);
			  })();

			};
			
			SyntaxHighlighter.complete(setHeight);
		
		});
		
			
		var slidecounter;
		slidecounter = 1;
		
		var slide_transition = 'false';
		
		function changeSlide () {
			if (slide_transition == 'false') {
				slide_transition = 'true';
				slide_id = $('.active-slide').attr('id');
				slides = $('.slide');
				slides_number = slides.length;
						
				clickclass = $(this).attr('class');		
					
					if (clickclass == 'arrow-right') {
						if (slidecounter < slides_number) {
							$('.active-slide').fadeToggle(750, 'linear');
							setTimeout( function () {			
								$('#ss' + slidecounter).removeClass('ss-active');
								$('.active-slide').removeClass('active-slide');
								slidecounter ++;
								$('#slide_' + slidecounter).fadeToggle(750, 'linear');
								$('#slide_' + slidecounter).addClass('active-slide');
								$('#ss' + slidecounter).addClass('ss-active');
								
								setHeight();
								slide_transition = 'false';
							}, 750);	
						} else {
							slide_transition = 'false';
						}
					}
					if (clickclass == 'arrow-left') {
						if (slidecounter > 1) {
							$('.active-slide').fadeToggle(750, 'linear');
							setTimeout( function () {
								$('#ss' + slidecounter).removeClass('ss-active');
								$('.active-slide').removeClass('active-slide');
								slidecounter --;
								$('#slide_' + slidecounter).fadeToggle(750, 'linear');
								$('#slide_' + slidecounter).addClass('active-slide');
								$('#ss' + slidecounter).addClass('ss-active');
							
								setHeight();
								slide_transition = 'false';
							}, 750);	
						} else {
							slide_transition = 'false';
						}
					}
				
			}	
		}
			
		function setHeight () {
			
				divheight = $('.active-slide').css('height');
				triangleheight = (parseFloat(divheight) / 2) - 10;
				$('.arrow-left').height(divheight);
				$('.arrow-right').height(divheight);
				$('.triangle-right').css('margin-top', triangleheight);
				$('.triangle-left').css('margin-top', triangleheight);
			
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	