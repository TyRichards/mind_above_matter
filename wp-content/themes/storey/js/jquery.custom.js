/*-----------------------------------------------------------------------------------

 	Custom JS - All front-end jQuery

-----------------------------------------------------------------------------------*/

;(function($) {
	"use strict";

	$(document).ready(function($) {

		/* --------------------------------------- */
		/* ZillaMobileMenu & Superfish
		/* --------------------------------------- */
		$('#primary-menu')
			.zillaMobileMenu({
				breakPoint: 768,
				hideNavParent: true,
				onInit: function( menu ) {
					$(menu).removeClass('zilla-sf-menu primary-menu');
				}
			})
			.superfish({
		    		delay: 200,
		    		animation: {opacity:'show'},
		    		speed: 'fast',
		    		cssArrows: false,
		    		disableHI: true
			});

		/* --------------------------------------- */
		/* jPlayer - Audio/Video Media
		/* --------------------------------------- */
		if( $().jPlayer ) {
			var $jplayers = $('.jp-jplayer');

			$jplayers.each(function() {
				var $player = $(this),
					playerType = $player.data('player-type'),
					playerMedia = $player.data('media-info');

				if( playerType === 'video' ) {
					$player.jPlayer({
						ready: function() {
							$(this).jPlayer('setMedia', {
								poster: playerMedia.p,
								m4v: playerMedia.m,
								ogv: playerMedia.o,
							});
						},
						size: {
							width: '100%',
							height: 'auto',
						},
						play: function() { // To avoid multiple jPlayers playing together.
							$(this).jPlayer("pauseOthers");
						},
						swfPath: zillaStatesman.jsFolder,
						cssSelectorAncestor: playerMedia.ancestor,
						supplied: 'm4v, ogv'
					});

					// Show/Hide player controls when video playing
					$player.bind($.jPlayer.event.playing, function(e) {
						var gui = $(this).next('.jp-video').find('.jp-interface');
						$(this).add(gui).hover( function() {
							$(gui).stop().animate({ opacity: 1 }, 300);
						}, function() {
							$(gui).stop().animate({ opacity: 0}, 300);
						});
					});

					$player.bind($.jPlayer.event.pause, function(e) {
						var gui = $(this).next('.jp-video').find('.jp-interface');
						$(this).add(gui).unbind('hover');
						$(gui).stop().animate({ opacity: 1 }, 300);
					});
				} else {
					$player.jPlayer({
						ready: function() {
							$(this).jPlayer('setMedia', {
								poster: playerMedia.p,
								mp3: playerMedia.m,
								oga: playerMedia.o,
							});
						},
						size: {
							width: '100%',
							height: 'auto',
						},
						play: function() { // To avoid multiple jPlayers playing together.
							$(this).jPlayer("pauseOthers");
						},
						preload: 'auto',
						swfPath: zillaStatesman.jsFolder,
						cssSelectorAncestor: playerMedia.ancestor,
						supplied: 'mp3, ogg'
					});
				}
			});
		} /* jPlayer --- */

		/* --------------------------------------- */
		/* Responsive media - FitVids
		/* --------------------------------------- */
		if( $().fitVids ) {
			$('#content').fitVids();
		} /* FitVids --- */

		/* ------------------------------------------------- */
		/* Gallery Slider
		/* ------------------------------------------------- */
		if( $().slidesjs ) {
			var $slideshows = $('.slideshow');
			if($slideshows.length){
				$slideshows.each(function(){
					var $slider = $(this);
					$slider.imagesLoaded(function(){
						$slider.slidesjs({
							width: $slider.width(),
							height: $slider.find('img').height(),
							pagination: {
								active: false
							},
							callback: {
								loaded: function(number) {
									var $activeSlide = $slider.find('li:nth-child('+ number +')');
									$slider.find('.slidesjs-container').css('height', $activeSlide.height());
								},
								complete: function(number) {
									var $activeSlide = $slider.find('li:nth-child('+ number +')');
									$slider.find('.slidesjs-container').css('height', $activeSlide.height());
								}
							}
						});
					});
				});
			}
		}

        /* --------------------------------------- */
        /* Parallax - Skrollr
        /* --------------------------------------- */
        if ($('html').hasClass('no-touch')) {
	        var s = skrollr.init({ forceHeight: false });
        }

		/* --------------------------------------- */
		/* Home Portfolio Slider
		/* --------------------------------------- */
		if($('.home-portfolio-slider').length){
			$('.home-portfolio-slider-wrap').addClass('direction-next');
			$($('.home-portfolio-slider-wrap .entry-thumb').get(0)).addClass('current-slide');
			$('.home-portfolio-slider-wrap .entry-thumb:last,.home-portfolio-slider .portfolio:last').addClass('last-slide');

			$('.home-portfolio-slider').leanSlider({
				pauseTime: false,
				directionNav: '.home-portfolio-slider-nav',
				beforeChange: function(currentSlide){
					$('.home-portfolio-slider-wrap .entry-thumb').removeClass('last-slide');
					$($('.home-portfolio-slider-wrap .entry-thumb').get(currentSlide)).addClass('last-slide');
					$('.home-portfolio-slider .portfolio').removeClass('last-slide');
					$($('.home-portfolio-slider .portfolio').get(currentSlide)).addClass('last-slide');
				},
				afterChange: function(currentSlide){
					$('.home-portfolio-slider-wrap .entry-thumb').removeClass('current-slide');
					$($('.home-portfolio-slider-wrap .entry-thumb').get(currentSlide)).addClass('current-slide');
				}
			});

			$('.home-portfolio-slider-nav').on('click', '.lean-slider-prev', function(){
				$('.home-portfolio-slider-wrap').removeClass('direction-prev direction-next');
				$('.home-portfolio-slider-wrap').addClass('direction-prev');
			});

			$('.home-portfolio-slider-nav').on('click', '.lean-slider-next', function(){
				$('.home-portfolio-slider-wrap').removeClass('direction-prev direction-next');
				$('.home-portfolio-slider-wrap').addClass('direction-next');
			});
		}

		/* ------------------------------------------------- */
        /* Portfolio
        /* ------------------------------------------------- */
		$('.portfolio-container .type-portfolio:visible:odd').addClass('odd');

        if( $().isotope ) {
            if ($('body').hasClass('page-template-template-portfolio-php') || $('body').hasClass('post-type-archive-portfolio')) {
		        var $container = $('.portfolio-container');
	
	            if($container.length){
					$container.imagesLoaded(function(){
						$container.isotope({
							itemSelector: '.type-portfolio',
							layoutMode: 'vertical',
							hiddenStyle: {
								opacity: 0
							},
							visibleStyle: {
								opacity: 1
							}
						});
						$container.isotope('on', 'layoutComplete', function(){
							$container.find('.type-portfolio').removeClass('odd');
							$container.find('.type-portfolio:visible:odd').addClass('odd');
						});
						$('.portfolio-container.layout-2col .type-portfolio').css('visibility', 'visible');
					});
	
	                $('.portfolio-type-nav a').on('click', function(e){
	                    e.preventDefault();
	                    $container.isotope({
	                        filter: $(this).attr('data-filter')
	                    });
	
						$('.portfolio-type-nav a').removeClass('active');
						$(this).addClass('active');
	                });
	            }    
            }
        }

        /* --------------------------------------- */
		/* Comment Form
		/* --------------------------------------- */
		var $commentform = $('#commentform');
		if ( $commentform.length ) {
			var commentformHeight = $commentform.height(),
				$cancelComment = $('#cancel-comment'),
				$commentTextarea = $('#comment');

			$commentTextarea.css({
				height : 50
			});
			$commentform.css({
				height : 50,
				overflow : 'hidden'
			}).on('click', function() {
				var $this = $(this);
				$this.animate({
					height : commentformHeight,
					overflow : 'visible'
				}, 500);

				$commentTextarea.css({
					height : 'auto'
				});

				$cancelComment.on('click', function(e) {
					e.preventDefault();

					$this.animate({
						height : 50,
						overflow : 'hidden'
					}, 500, function(){
						$commentTextarea.css({
							height : 50
						});
					});

					return false;
				});
			});
		}

		/* --------------------------------------- */
		/* Misc
		/* --------------------------------------- */
		$('.site-header').height($('.header-area').outerHeight());

		$('.entry-navigation .top').on('click', function(e){
			e.preventDefault();
			$('html,body').animate({ scrollTop: 0 }, 500);
		});

	});

})(window.jQuery);
