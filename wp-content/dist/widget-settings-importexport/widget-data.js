!function(l){"use strict";var s=function(e,t){var i=l("div#notifier").empty().removeClass("error updated");i.html("<p>"+e+"</p>"),i.addClass(t),i.fadeIn("slow"),jQuery("body,html").animate({scrollTop:0},800)},e=l("<div/>").css({height:0,width:0,overflow:"hidden"});l(function(){var t=l("#widget-upload-file").wrap(e),i=l(".widget-data .widget-checkbox"),a=l(".widget-data p.widget-selection-error");l(".widget-data").on("click",".select-all, .unselect-all, .upload-button",function(e){e.preventDefault(),l(this).hasClass("select-all")?i.not(":checked").each(function(){l(this).attr("checked",!0)}):l(this).hasClass("unselect-all")?i.filter(":checked").each(function(){l(this).attr("checked",!1)}):l(this).hasClass("upload-button")&&t.click()}),l("form#widget-export-settings").submit(function(e){if(0===i.filter(":checked").length)return e.preventDefault(),void s("Please select a widget to continue.","error");l("form#widget-export-settings").fadeOut("slow"),window.setTimeout(function(){window.location.replace(widgets_url)},4e3),s("All of the requested widgets have been exported.","updated")}),l("form#import-widget-data").submit(function(e){if(e.preventDefault(),0===i.filter(":checked").length)return a.fadeIn("slow").delay(2e3).fadeOut("slow"),!1;l.post(ajaxurl,l("#import-widget-data").serialize(),function(e){wpAjax.parseAjaxResponse(e,"notifier")&&(l(".import-wrapper").fadeOut("slow"),s("All widgets with registered sidebars have been imported successfully.","updated"))})}),t.change(function(){var e=l("#upload-widget-data .file-name"),t=l(this).val().lastIndexOf("\\")+1,i=l(this).val().substring(t);e.val(i)})})}(window.jQuery);