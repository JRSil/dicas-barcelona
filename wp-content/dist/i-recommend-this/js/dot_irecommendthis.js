jQuery(document).ready(function(d){d(document).on("click",".dot-irecommendthis",function(){var i=d(this);if(i.hasClass("active"))return!1;var t=d(this).attr("id"),e=i.find(".dot-irecommendthis-suffix").text();return d.post(dot_irecommendthis.ajaxurl,{action:"dot-irecommendthis",recommend_id:t,suffix:e},function(t){i.html(t).addClass("active").attr("title","You already recommended this")}),!1})});