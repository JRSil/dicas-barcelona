(function($){
    $(document).ready( function() {

        //Pinterest box-shadow
        var pinterestBox = setInterval(function(){
            if($('.apsp-widget-free').length > 0){
                $('.apsp-widget-free > span').css('box-shadow', 'none');
                clearInterval(pinterestBox);
            }
        }, 1000);

        var header = $('.entry-wrapper .entry-header .entry-meta-header');
        var cat = $('.entry-wrapper .entry-header .cat-links');

        $.each( header, function(key, val){
            $(header[key]).insertAfter($(cat[key]));
        });

        var seguinte = $('a.next.page-numbers');
        seguinte.text('');
        $(seguinte).append('<i class="fa fa-angle-right" aria-hidden="true"></i>');

        var cssChange = setInterval(function(){
            $('.mega-sub-menu .slick-track').css('width','auto');
            $('.mega-sub-menu .slick-track .post').css('width','auto');
        }, 300);
        
        function classPost(){
            if($('#page').hasClass('post')){
                clearInterval(cssChange);
            }
        }

        var lista = $('.mega-sub-menu div.post-widget-list');
        
        // if(lista.length > 1){
        //     $.each(lista, function(key, val){
        //         lista.addClass("after");
        //     });
        // }
        

        var iconeEye = $('.views i');
        $(iconeEye).removeClass('fa');
        $(iconeEye).removeClass('fa-eye');
        $(iconeEye).addClass('icon-dc-views');

        var iconeComment = $('.comments-link i');
        $(iconeComment).removeClass('fa');
        $(iconeComment).removeClass('fa-comments');
        $(iconeComment).addClass('icon-dc-comments');

        var iconeShare = $('.share-toggle span i');
        $(iconeShare).removeClass('fa');
        $(iconeShare).removeClass('fa-share-alt');
        $(iconeShare).addClass('icon-dc-share');

        /*iconeShare.click(function(e){
            e.stopPropagation();
            $(this).closest('.entry-meta-footer').toggleClass('share-active');
        });*/

        var twitterInc = setInterval(function(){
            if($('.tp_recent_tweets').length > 0){
                $('.tp_recent_tweets .slick-initialized .slick-list .slick-track .slick-slide span').append(' via <a href="https://twitter.com/DicasBarcelona" target="_blank">@DicasBarcelona</a>');
                clearInterval(twitterInc);
            }
        }, 1000);

        $('.PIN_1522168003487_embed_grid').css("width","100%");

        $('.site-info .col-full').html('Tudo sobre Barcelona, Madri, Valencia, Ibiza e Espanha &nbsp;&nbsp;<span style="color:#505050;">|</span>&nbsp;&nbsp; © 2018 GrupoDicas. &nbsp;&nbsp;<span style="color:#505050;">|</span>&nbsp;&nbsp; Todos os Direitos reservados.');

        // MOBILE FUNCTIONS
        w = $(window).width();
        if(w <= 600){
            $('.mega-toggle-blocks-left').append($('.mega-toggle-block'));

            $('.header-top').slideUp(1);
            $('.slicknav_btn').fadeOut(1);
            $('.search-toggle').fadeOut(1);
            $(window).scroll(function(e){
                var scrollTop = $(window).scrollTop();
                var docHeight = $(document).height();
                var winHeight = $(window).height();
                var scrollPercent = (scrollTop) / (docHeight - winHeight);
                var scrollPercentRounded = Math.round(scrollPercent*100);
                if(scrollPercentRounded <= 7){
                    $('.search-toggle').fadeOut(300);
                    $('.slicknav_btn').fadeOut(300,  function(){
                        $('.header-top').slideUp(500, function(){
                            $('.header-top').css("display", "none");
                        });
                    });
                }else if(scrollPercentRounded > 7){
                    //$('.header-top').css("display", "block");
                    $('.header-top').slideDown(500, function(){
                        $('.slicknav_btn').fadeIn(300);
                        $('.search-toggle').fadeIn(300);
                    }).css("display", "block");
                }
            });
        }else if((w > 600) && (w <= 800)){
            $('.textwidget iframe').attr("height", "300");
            $('.header-top').slideUp(1);
            $('.slicknav_btn').fadeOut(1);
            $('.search-toggle').fadeOut(1);
            $(window).scroll(function(e){
                var scrollTop = $(window).scrollTop();
                var docHeight = $(document).height();
                var winHeight = $(window).height();
                var scrollPercent = (scrollTop) / (docHeight - winHeight);
                var scrollPercentRounded = Math.round(scrollPercent*100);
                if(scrollPercentRounded <= 7){
                    $('.search-toggle').fadeOut(300);
                    $('.slicknav_btn').fadeOut(300,  function(){
                        $('.header-top').slideUp(500, function(){
                            $('.header-top').css("display", "none");
                        });
                    });
                }else if(scrollPercentRounded > 7){
                    //$('.header-top').css("display", "block");
                    $('.header-top').slideDown(500, function(){
                        $('.slicknav_btn').fadeIn(300);
                        $('.search-toggle').fadeIn(300);
                    }).css("display", "block");
                }
            });
        }else if((w > 800) && (w <= 1000)){
            $('.textwidget iframe').attr("height", "450");
            $('.header-top').slideUp(1);
            $('.slicknav_btn').fadeOut(1);
            $('.search-toggle').fadeOut(1);
            $(window).scroll(function(e){
                var scrollTop = $(window).scrollTop();
                var docHeight = $(document).height();
                var winHeight = $(window).height();
                var scrollPercent = (scrollTop) / (docHeight - winHeight);
                var scrollPercentRounded = Math.round(scrollPercent*100);
                if(scrollPercentRounded <= 7){
                    $('.search-toggle').fadeOut(300);
                    $('.slicknav_btn').fadeOut(300,  function(){
                        $('.header-top').slideUp(500, function(){
                            $('.header-top').css("display", "none");
                        });
                    });
                }else if(scrollPercentRounded > 7){
                    //$('.header-top').css("display", "block");
                    $('.header-top').slideDown(500, function(){
                        $('.slicknav_btn').fadeIn(300);
                        $('.search-toggle').fadeIn(300);
                    }).css("display", "block");
                }
            });
        }

    });
})(jQuery);