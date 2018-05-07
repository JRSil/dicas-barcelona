(function($){
    $(document).ready( function() {
        var mainImg= $('.post .entry-wrapper .post-thumbnail');
        var artigoGrade = $('.post .entry-wrapper');

        // $(artigoGrade).prepend(mainImg);

        var likeBox = $('.entry-meta-footer');
        var social = $('.entry-meta-footer .social-share');

        $(likeBox).prepend(social);

        $('.nav-previous .meta-nav').text('Matéria Anterior');
        $('.nav-next .meta-nav').text('Próxima Matéria');

        //$('.related-posts .block-title h3 span').text('Veja Outras Matérias Imperdíveis de Barcelona');

        $('.comment-respond .comment-reply-title').text('Deixe seu Comentário');

        var facebookChange = setInterval(function(){
            if(($('.related-posts').length > 0)&&($('.fb-comments').length > 0)){
                $('.fb-comments > span').removeAttr("style");
                $('.fb-comments > span').attr('class', "faceComm-wrapper");
                $('.fb-comments span').prepend('<div class="block-title"><div>');
                $('.fb-comments span .block-title').prepend('<h3><span>Comentários do Facebook</span></h3>');
                $('.fb-comments.fb_iframe_widget').insertAfter($('.related-posts'));
                $('.fb-comments').attr('style','display:block!important');
                clearInterval(facebookChange);
            }
        }, 1000);

        var facebookC = setInterval(function(){
            if($('.fb-comments > span').attr('style') != null){
                $('.fb-comments > span').removeAttr("style");
                clearInterval(facebookC);
            }
        }, 3000);

    });
})(jQuery);