jQuery(document).ready(function($) {
    var setwood_retina_logo_done = false;
    var setwood_retina_logo_mini_done = false;
    setwood_retina_check();
    blog_grid_layout();
    $(window).resize(function() {
        setwood_retina_check();
    });
    $(window).on("click", function() {
        $(".entry-meta-footer").removeClass("share-active");
    });
    // Add focus to cart dropdown
    $(window).load(function() {
        $('.site-header-cart').find('a').on('focus.setwood blur.setwood', function() {
            $(this).parents().toggleClass('focus');
        });
    });
    // Initialize FitVids (applied only to videos that appear in posts & pages)
    $('.entry-media').fitVids();
    /*  Go to top */
    /* ------------------------------------ */
    $('.go-to-top').on('click', function() {
        $('html, body').animate({
            scrollTop: 0
        }, 700);
        return false;
    });

    /*  Feaured Slider */
    /* ------------------------------------ */
    if ($().slick) {
        $('.featured-carousel').each(function() {
            var $this = $(this),
                autoplay = $this.data('auto'),
                autotime = $this.data('autotime'),
                autospeed = $this.data('speed');
            if ($this.hasClass('carousel')) {
                $this.slick({
                    dots: true,
                    infinite: true,
                    speed: autospeed,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    autoplay: autoplay,
                    autoplaySpeed: autotime,
                    centerMode: true,
                    centerPadding: 0,
                    variableWidth: true,
                    nextArrow: '<button type="button" class="slick-next slick-nav"><i class="fa fa-angle-right"></i></button>',
                    prevArrow: '<button type="button" class="slick-prev slick-nav"><i class="fa fa-angle-left"></i></button>',
                    responsive: [{
                        breakpoint: 960,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            centerMode: false,
                            variableWidth: false
                        }
                    }]
                });
            } else if ($this.hasClass('full-width')) {
                $this.slick({
                    dots: true,
                    infinite: true,
                    speed: autospeed,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    autoplay: autoplay,
                    autoplaySpeed: autotime,
                    centerMode: false,
                    variableWidth: false,
                    adaptiveHeight: true,
                    cssEase: 'ease-in-out',
                    nextArrow: '<button type="button" class="slick-next slick-nav"><i class="fa fa-angle-right"></i></button>',
                    prevArrow: '<button type="button" class="slick-prev slick-nav"><i class="fa fa-angle-left"></i></button>',
                    responsive: [{
                        breakpoint: 960,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }]
                }); // slick
            } else { // Default Box Slider
                $this.slick({
                    dots: true,
                    infinite: true,
                    speed: autospeed,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    autoplay: autoplay,
                    autoplaySpeed: autotime,
                    centerMode: false,
                    variableWidth: false,
                    adaptiveHeight: true,
                    cssEase: 'ease-in-out',
                    nextArrow: '<button type="button" class="slick-next slick-nav"><i class="fa fa-angle-right"></i></button>',
                    prevArrow: '<button type="button" class="slick-prev slick-nav"><i class="fa fa-angle-left"></i></button>',
                    responsive: [{
                        breakpoint: 960,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }]
                }); // slick
            }
            $this.on('setPosition', function(event, slick, direction) {
                $this.parent().addClass('loaded');
                $(window).load(function() {
                    $this.parent().addClass('loaded-wait');
                });
            });
        }); // each
    } // if slick
    /*  Gallery Popup */
    /* ------------------------------------ */
    $('.gallery').each(function() {
        $(this).find('.gallery-icon a.setwood-popup').magnificPopup({
            type: 'image',
            gallery: {
                enabled: true
            },
            image: {
                titleSrc: function(item) {
                    var $caption = item.el.closest('.gallery-item').find('.gallery-caption');
                    if ($caption != 'undefined') {
                        return $caption.text();
                    }
                    return '';
                }
            }
        });
    });
    $('.gallery-columns-1').slick({
        dots: false,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        centerMode: false,
        variableWidth: false,
        adaptiveHeight: true,
        nextArrow: '<button type="button" class="slick-next slick-nav"><i class="fa fa-angle-right"></i></button>',
        prevArrow: '<button type="button" class="slick-prev slick-nav"><i class="fa fa-angle-left"></i></button>'
    }); // slick
    $('.gallery-columns-1').on('setPosition', function(event, slick, direction) {
        $('.gallery-columns-1').parent().addClass('loaded');
        $(window).load(function() {
            $('.gallery-columns-1').parent().addClass('loaded-wait');
        });
    });
    $('.tp_recent_tweets ul').slick({
        dots: true,
        fade: true,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        speed: 600,
        autoplaySpeed: 6000,
        autoplay: true,
        centerMode: false,
        variableWidth: false,
        adaptiveHeight: true,
        nextArrow: '<button type="button" class="slick-next slick-nav"><i class="fa fa-angle-right"></i></button>',
        prevArrow: '<button type="button" class="slick-prev slick-nav"><i class="fa fa-angle-left"></i></button>'
    }); // slick
    $('.post-slider').slick({
        dots: true,
        arrows: false,
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 4,
        autoplay: false,
        centerMode: false,
        variableWidth: false,
        adaptiveHeight: true,
        nextArrow: '<button type="button" class="slick-next slick-nav"><i class="fa fa-angle-right"></i></button>',
        prevArrow: '<button type="button" class="slick-prev slick-nav"><i class="fa fa-angle-left"></i></button>',
        responsive: [{
            breakpoint: 960,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3
            }
        }, {
            breakpoint: 768,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }]
    }); // slick
    $('.post-slider').on('setPosition', function(event, slick, direction) {
        $('.post-slider').parent().addClass('loaded');
        $(window).load(function() {
            $('.post-slider').parent().addClass('loaded-wait');
        });
    });
    /*  Dropdown menu animation
    /* ------------------------------------ */
    $('.nav-menu ul.sub-menu').hide();
    $('.nav-menu li').hover(function() {
        $(this).children('ul.sub-menu').fadeIn('fast');
    }, function() {
        $(this).children('ul.sub-menu').hide();
    });
    //* Responsive Navigation
    /* Menu Button */
    if ($('#site-navigation').children('.handheld-navigation').length !== 0) {
        $('#handheld-navigation').slicknav({
            prependTo: '.menu-mobile',
            allowParentLinks: true,
            closedSymbol: '<i class="fa fa-angle-right" style="font-size: 16px;"></i>',
            openedSymbol: '<i class="fa fa-angle-down" style="font-size: 16px;"></i>',
            label: '',
        });
    } else {
        $('#primary-navigation').slicknav({
            prependTo: '.menu-mobile',
            allowParentLinks: true,
            closedSymbol: '<i class="fa fa-angle-right" style="font-size: 16px;"></i>',
            openedSymbol: '<i class="fa fa-angle-down" style="font-size: 16px;"></i>',
            label: '',
        });
    }

    /*Reverse submenu ul if out of the screen */

        $(".menu li").on('mouseenter mouseleave', function (e) {
        if ($('ul', this).length) {
            var elm = $('ul:first', this);
            var off = elm.offset();
            var l = off.left;
            var w = elm.width();
            var docH = $(".site").height();
            var docW = $(".site").width();

            var isEntirelyVisible = (l + w <= docW);

            if (!isEntirelyVisible) {
                $(this).addClass('edge');
            } else {
                $(this).removeClass('edge');
            }
        }
    });

    /*  Header search */
    /* ------------------------------------ */
    $(document).on('click', '.search-toggle span', function(e) {
        e.preventDefault();
        $(this).toggleClass('fa-times', 'fa-search');
        $(this).parent().toggleClass('search-active');
    });

    /*  Share Toggle */
    /* ------------------------------------ */
    $(document).on('click', '.share-toggle span', function(e) {
        e.stopPropagation();
        $(this).closest('.entry-meta-footer').toggleClass('share-active');
    });

    /*  Retina */
    /* ------------------------------------ */
    function setwood_retina_check() {
        //Retina logo
        if (window.devicePixelRatio > 1) {
            if (!setwood_retina_logo_done && setwood_js_settings.logo_retina && $('.setwood-logo').length) {
                $('.setwood-logo').imagesLoaded(function() {
                    $('.setwood-logo').each(function() {
                        if ($(this).is(':visible')) {
                            //var height = $(this).height();
                            var width = $(this).width();
                            $(this).attr('src', setwood_js_settings.logo_retina).css('width', width + 'px');
                        }
                    });
                });
                setwood_retina_logo_done = true;
            }
            if (!setwood_retina_logo_mini_done && setwood_js_settings.logo_retina_mini && $('.setwood-logo-mini').length) {
                $('.setwood-logo-mini').imagesLoaded(function() {
                    $('.setwood-logo-mini').each(function() {
                        if ($(this).is(':visible')) {
                            //var height = $(this).height();
                            var width = $(this).width();
                            $(this).attr('src', setwood_js_settings.logo_retina_mini).css('width', width + 'px');
                        }
                    });
                });
                setwood_retina_logo_mini_done = true;
            }
        }
    }
    /*  Sticky Header */
    /* ------------------------------------ */
    if (setwood_js_settings.header_sticky) {
        var setwood_last_top;
        setwood_js_settings.header_sticky_offset = 500;
        $(window).scroll(function() {
            var top = $(window).scrollTop();
            if (top >= setwood_js_settings.header_sticky_offset) {
                $("body").addClass("sticky-header-visible");
            } else {
                $("body").removeClass("sticky-header-visible");
            }
            setwood_last_top = top;
        });
    }
    /*  Sticky Sidebar */
    /* ------------------------------------ */
    $('.widget-area').theiaStickySidebar({
        containerSelector: '.site-main',
        additionalMarginTop: ($('#wpadminbar').length && $('.main-navigation').length) ? 120 + $('#wpadminbar').height() : 120,
        additionalMarginBottom: 0,
        minWidth: 977
    });

    function blog_grid_layout() {

        var grid_item = $('.site-main.grid');

        grid_item.imagesLoaded(function() {
            grid_item.find('.grid-item .entry-wrapper').not('.slick-slide').matchHeight();
        });
    };
});