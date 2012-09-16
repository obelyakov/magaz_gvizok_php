$(function() {
	primaryNav();
	setMarkup();
	carousel();
	carousel1();
	setInputPlaceholder();
	if ($('.gallery').length) $('.gallery a').prettyPhoto({
		overlay_gallery: false,
		deeplinking: false,
		opacity: 0.7
	});
});


function setInputPlaceholder() {
	var inputs = $('input[data-placeholder]');

	inputs.each(function() {
		var $this = $(this),
			wrapper = $this.wrap('<div class="input-wrapper ' + $this.attr('class') + '_input-wrapper">');

		var placeholder = $('<input type="text">')
			.val($this.attr('data-placeholder'))
			.addClass('input-placeholder ' + $this.attr('class') + '_input-placeholder')
			.removeAttr('data-placeholder')
			.appendTo(wrapper.parent())
			.css({
				'height': $this.outerHeight()
			});

		if ($this.val() != '') placeholder.addClass('input-placeholder_hidden');

		placeholder.focus(function() {
			$this.focus();
			placeholder.addClass('input-placeholder_hidden');
		});

		$this
			.focus(function() {
				placeholder.addClass('input-placeholder_hidden');
			})
			.blur(function() {
				if ($this.val() == '') placeholder.removeClass('input-placeholder_hidden')
			}
		)
	})
}


function setMarkup() {
	var footer = $('footer');

	if (footer.length) {
		var footerHeight = footer.outerHeight(true);
		footer.height(footerHeight);
		$('.container')
			.append('<div class="footer-helper" style="height: ' + footerHeight +'px"></div>')
			.css('marginBottom', -footerHeight);
	}
}


function primaryNav() {
	$(window).load(function() {
		var nav = $('nav.primary > ul'),
			nav_initial_width = nav.width(),
			links = nav.find('> li > a, > li > span'),
			links_length = links.length,
			free_space,
			paddings;

		function setPaddings() {
			links.removeAttr('style');
			free_space = nav.parent().width() - nav_initial_width;
			paddings = (((free_space / links_length) / 2).toFixed(2)) - 0.1;
			links.css({'paddingLeft': paddings + 'px', 'paddingRight': paddings + 'px'});
		}

		var items = nav.find('> li');

		items.hover(
			function() {
				var submenu = $(this).find('div');

				if (submenu.length) {
					if (items.index($(this)) == items.length - 1) {
						var $this = $(this);

						if (submenu.offset().left + submenu.width() > nav.width()) {
							submenu
								.addClass('hidden')
								.css({'left': $this.position().left + $this.width() - submenu.width() - 13})
								.stop()
								.slideDown(100);
						}
					} else {
						submenu.addClass('hidden').stop().slideDown(100)
					}
				}
			},
			function() {
				$(this).stop().find('div').removeClass('hidden').stop().fadeOut(100, function() {
					$(this).removeAttr('style')
				})
			}
		);

		setPaddings();
		$(window).resize(function() {
			setPaddings()
		});
	});
}


function carousel() {
	var carousel = $('.carousel'),
		full_image = carousel.find('.full-image'),
		thumbs = carousel.find('.thumbs'),
		thumbs_scroller = carousel.find('.thumbs-scroller');

	if (carousel.length) {
		if (carousel.find('li').length > 1) {
			var items = thumbs.find('li'),
				current = 0;

			items.eq(0).addClass('active');
			thumbs_scroller.jCarouselLite({
				btnNext: '.carousel .icon-next1',
				btnPrev: '.carousel .icon-prev1',
				visible: 4,
				speed: 100,
				mouseWheel: true,
				circular: false,
				vertical: false,
				timeout: 4000,
				scroll: 1,
				easing: 'easeInOutCubic'
			});

			thumbs.mousewheel(function() {return false});

			var changePicture = function(source) {
				var src = $(source);
				full_image.find('img').hide(0);
				full_image.find('img').attr('src', src.attr('href')).fadeIn(200);
			};

			thumbs_scroller.find('a').click(function() {
				var source = $(this);
				current = items.index($(this).parent());
				items.removeClass('active');
				source.parent().addClass('active');
				changePicture(source);
				return false;
			});
		}
	}
}


function carousel1() {
	var carousel = $('.carousel1'),
		scroller = carousel.find('.scroller');

	if (carousel.length) {
		if (carousel.find('li').length > 1) {
			scroller.jCarouselLite({
				btnNext: '.carousel1 .icon-next2',
				btnPrev: '.carousel1 .icon-prev2',
				visible: 1,
				speed: 100,
				mouseWheel: true,
				circular: true,
				vertical: false,
				scroll: 1,
				easing: 'easeInOutCubic'
			});

			scroller.mousewheel(function() {return false});
		}
	}
}