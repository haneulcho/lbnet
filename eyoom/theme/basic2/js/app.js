var App = function () {

    function handleViewport(){
		$("input, textarea, select").on({ 'touchstart' : function() {
			zoomDisable();
		}});
		$("input, textarea, select").on({ 'touchend' : function() {
			setTimeout(zoomEnable, 500);
		}});
		function zoomDisable(){
			//$('head meta[name=viewport]').remove();
			//$('head').prepend('<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">');
		}
		function zoomEnable(){
			//$('head meta[name=viewport]').remove();
			//$('head').prepend('<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=1">');
		}
	}
	function handleIEFixes() {
        //fix html5 placeholder attribute for ie7 & ie8
        if (jQuery.browser.msie && jQuery.browser.version.substr(0, 1) < 9) { // ie7&ie8
            jQuery('input[placeholder], textarea[placeholder]').each(function () {
                var input = jQuery(this);
                jQuery(input).val(input.attr('placeholder'));
                jQuery(input).focus(function () {
                    if (input.val() == input.attr('placeholder')) {
                        input.val('');
                    }
                });
                jQuery(input).blur(function () {
                    if (input.val() == '' || input.val() == input.attr('placeholder')) {
                        input.val(input.attr('placeholder'));
                    }
                });
            });
        }
    }
    function handleBootstrap() {
        /*Bootstrap Carousel*/
        jQuery('.carousel').carousel({
            interval: 15000,
            pause: 'hover'
        });
        /*Tooltips*/
        jQuery('.tooltips').tooltip();
        jQuery('.tooltips-show').tooltip('show');
        jQuery('.tooltips-hide').tooltip('hide');
        jQuery('.tooltips-toggle').tooltip('toggle');
        jQuery('.tooltips-destroy').tooltip('destroy');
        /*Popovers*/
        jQuery('.popovers').popover();
        jQuery('.popovers-show').popover('show');
        jQuery('.popovers-hide').popover('hide');
        jQuery('.popovers-toggle').popover('toggle');
        jQuery('.popovers-destroy').popover('destroy');
    }
    function handleSearch() {
        jQuery('.search').click(function () {
            if(jQuery('.search-btn').hasClass('fa-search')){
                jQuery('.search-open').fadeIn(200);
                jQuery('.search-btn').removeClass('fa-search');
                jQuery('.search-btn').addClass('fa-times');
                jQuery('.header-logo').addClass('logo-none');
            } else {
                jQuery('.search-open').fadeOut(200);
                jQuery('.search-btn').addClass('fa-search');
                jQuery('.search-btn').removeClass('fa-times');
                jQuery('.header-logo').removeClass('logo-none');
            }
        });
    }
    function handleToggle() {
        jQuery('.list-toggle').on('click', function() {
            jQuery(this).toggleClass('active');
        });
    }
    function handleSticky() {
	    jQuery(window).scroll(function() {
	        if (jQuery(window).scrollTop()>121){
              jQuery(".basic-body .basic-body-side.right-side").addClass('scrolled');
	        }
	        else {
              jQuery(".basic-body .basic-body-side.right-side").removeClass('scrolled');
	        }
	    });
	}
	/*Header Slider Carousel*/
	function handleHeaderSlider() {
		jQuery(document).ready(function() {
			jQuery("#owl-header-slider").owlCarousel({
				navigation : true,
				slideSpeed : 300,
				paginationSpeed : 400,
				singleItem: true,
				autoPlay: 16000
			});
		});
	}
	/*Main Banner Slider Carousel*/
	function handleOwlMainBanner() {
		jQuery(document).ready(function() {
			var owl = jQuery(".owl-slider-main-banner");
		    owl.owlCarousel({
		        autoPlay : 8000,
			    singleItem : true,
			    slideSpeed: 300,
		        pagination: false
		    });
		    jQuery(".next-main-banner").click(function(){
		        owl.trigger('owl.next');
		    })
		    jQuery(".prev-main-banner").click(function(){
		        owl.trigger('owl.prev');
		    })
		});
	}
	function handleSidebar() {
		jQuery(document).ready(function () {
		    var sides = ["left", "top", "right", "bottom"];
		    for (var i = 0; i < sides.length; ++i) {
		        var cSide = sides[i];
		        $(".sidebar." + cSide).sidebar({side: cSide});
		    }
		    $(".btn[data-action]").on("click", function () {
		        var $this = $(this);
		        var action = $this.attr("data-action");
		        var side = $this.attr("data-side");
		        $(".sidebar." + side).trigger("sidebar:" + action);
		        return false;
		    });
		});
	}

    return {
        init: function () {
	        handleViewport();
            handleBootstrap();
            handleIEFixes();
            handleSearch();
            handleToggle();
            handleSticky();
            handleHeaderSlider();
            handleOwlMainBanner();
            handleSidebar();
        },
        initSideSticky: function () {
			$(window).load(function(){
				$('.basic-body-main, .basic-body-side').theiaStickySidebar({additionalMarginTop: 70});
			});
	    },
    };

}();
