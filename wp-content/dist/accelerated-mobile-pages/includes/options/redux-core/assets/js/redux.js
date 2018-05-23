!function(x){"use strict";x.redux=x.redux||{},x(document).ready(function(){x.fn.isOnScreen=function(){if(window){var e=x(window),r={top:e.scrollTop()};r.right=r.left+e.width(),r.bottom=r.top+e.height();var i=this.offset();return i.right=i.left+this.outerWidth(),i.bottom=i.top+this.outerHeight(),!(r.right<i.left||r.left>i.right||r.bottom<i.top||r.top>i.bottom)}},x.redux.hideFields(),x.redux.checkRequired(),x.redux.initEvents(),x.redux.initQtip(),x.redux.tabCheck(),x.redux.notices(),x.redux.tabControl()}),x.redux.ajax_save=function(e){var i=x(document.getElementById("redux_ajax_overlay"));i.fadeIn(),jQuery(".redux-action_bar .spinner").addClass("is-active"),jQuery(".redux-action_bar input").attr("disabled","disabled");var t=jQuery(document.getElementById("redux_notification_bar"));t.slideUp(),jQuery(".redux-save-warn").slideUp(),jQuery(".redux_ajax_save_error").slideUp("medium",function(){jQuery(this).remove()});var r=jQuery(document.getElementById("redux-form-wrapper"));redux.fields.hasOwnProperty("editor")&&x.each(redux.fields.editor,function(e,r){if("undefined"!=typeof tinyMCE){var i=tinyMCE.get(e);i&&i.save()}});var a=r.serialize();r.find("input[type=checkbox]").each(function(){if(void 0!==x(this).attr("name")){var e=x(this).is(":checked")?x(this).val():"0";a+="&"+x(this).attr("name")+"="+e}}),"redux_save"!=e.attr("name")&&(a+="&"+e.attr("name")+"="+e.val());var n=r.attr("data-nonce");return jQuery.ajax({type:"post",dataType:"json",url:ajaxurl,data:{action:redux.args.opt_name+"_ajax_save",nonce:n,opt_name:redux.args.opt_name,data:a},error:function(e){window.console||(console={}),console.log=console.log||function(e,r){},console.log(redux.ajax.console),console.log(e.responseText),jQuery(".redux-action_bar input").removeAttr("disabled"),i.fadeOut("fast"),jQuery(".redux-action_bar .spinner").removeClass("is-active"),alert(redux.ajax.alert)},success:function(e){if(e.action&&"reload"==e.action)location.reload(!0);else if("success"==e.status){jQuery(".redux-action_bar input").removeAttr("disabled"),i.fadeOut("fast"),jQuery(".redux-action_bar .spinner").removeClass("is-active"),redux.options=e.options,redux.errors=e.errors,redux.warnings=e.warnings,t.html(e.notification_bar).slideDown("fast"),null===e.errors&&null===e.warnings||x.redux.notices();var r=x(document.getElementById("redux_notification_bar")).find(".saved_notice");r.slideDown(),r.delay(4e3).slideUp()}else jQuery(".redux-action_bar input").removeAttr("disabled"),jQuery(".redux-action_bar .spinner").removeClass("is-active"),i.fadeOut("fast"),jQuery(".wrap h2:first").parent().append('<div class="error redux_ajax_save_error" style="display:none;"><p>'+e.status+"</p></div>"),jQuery(".redux_ajax_save_error").slideDown(),jQuery("html, body").animate({scrollTop:0},"slow")}}),!1},x.redux.initEvents=function(){x(".redux-presets-bar").on("click",function(){window.onbeforeunload=null}),x("#toplevel_page_"+redux.args.slug+" .wp-submenu a, #wp-admin-bar-"+redux.args.slug+" a.ab-item, .extension-menu-call a").click(function(e){if((x("#toplevel_page_"+redux.args.slug).hasClass("wp-menu-open")||x(this).hasClass("ab-item"))&&!x(this).parents("ul.ab-submenu:first").hasClass("ab-sub-secondary")&&0<=x(this).attr("href").toLowerCase().indexOf(redux.args.slug+"&tab=")){e.preventDefault();var r=x(this).attr("href").split("&tab=");return x("#"+r[1]+"_section_group_li_a").click(),x(this).parents("ul:first").find(".current").removeClass("current"),x(this).addClass("current"),x(this).parent().addClass("current"),!1}}),x(".redux-action_bar input").on("click",function(e){if(x(this).attr("name")==redux.args.opt_name+"[defaults]"){if(!confirm(redux.args.reset_confirm))return!1}else if(x(this).attr("name")==redux.args.opt_name+"[defaults-section]"&&!confirm(redux.args.reset_section_confirm))return!1;!(window.onbeforeunload=null)===redux.args.ajax_save&&(x.redux.ajax_save(x(this)),e.preventDefault())}),x(".expand_options").click(function(e){e.preventDefault();var r=x(".redux-container");if(x(r).hasClass("fully-expanded")){x(r).removeClass("fully-expanded");var i=x.cookie("redux_current_tab");x(".redux-container:first").find("#"+i+"_section_group").fadeIn(200,function(){0!==x(".redux-container:first").find("#redux-footer").length&&x.redux.stickyInfo(),x.redux.initFields()})}return x.redux.expandOptions(x(this).parents(".redux-container:first")),!1}),x(".saved_notice").is(":visible")&&x(".saved_notice").slideDown(),x(document.body).on("change",".redux-field input, .redux-field textarea, .redux-field select",function(){x(this).hasClass("noUpdate")||redux_change(x(this))});var e=x("#redux-footer").height();x("#redux-sticky-padder").css({height:e}),x("#redux-footer-sticky").removeClass("hide"),0!==x("#redux-footer").length&&(x(window).scroll(function(){x.redux.stickyInfo()}),x(window).resize(function(){x.redux.stickyInfo()})),x(".saved_notice").delay(4e3).slideUp()},x.redux.hideFields=function(){x("label[for='redux_hide_field']").each(function(e,r){var i=x(this).parent().parent();x(i).addClass("hidden")})},x.redux.checkRequired=function(){x.redux.required(),x("body").on("change",".redux-main select, .redux-main radio, .redux-main input[type=checkbox], .redux-main input[type=hidden]",function(e){x.redux.check_dependencies(this)}),x("body").on("check_dependencies",function(e,r){x.redux.check_dependencies(r)}),x("td > fieldset:empty,td > div:empty").parent().parent().hide()},x.redux.initQtip=function(){if(x().qtip){var e="";!0===redux.args.hints.tip_style.shadow&&(e="qtip-shadow");var r="",i=redux.args.hints.tip_style.color;""!==i&&(r="qtip-"+i);var t="";!0===redux.args.hints.tip_style.rounded&&(t="qtip-rounded");var a="",n=redux.args.hints.tip_style.style;""!==n&&(a="qtip-"+n);var s=e+","+r+","+t+","+a+",redux-qtip";s=s.replace(/,/g," ");var d=redux.args.hints.tip_position.my,o=redux.args.hints.tip_position.at;d=x.redux.verifyPos(d.toLowerCase(),!0),o=x.redux.verifyPos(o.toLowerCase(),!1);var u=redux.args.hints.tip_effect.show.event,l=redux.args.hints.tip_effect.hide.event,f=redux.args.hints.tip_effect.show.effect,c=redux.args.hints.tip_effect.show.duration,p=redux.args.hints.tip_effect.hide.effect,h=redux.args.hints.tip_effect.hide.duration;x("div.redux-dev-qtip").each(function(){x(this).qtip({content:{text:x(this).attr("qtip-content"),title:x(this).attr("qtip-title")},show:{effect:function(){x(this).slideDown(500)},event:"mouseover"},hide:{effect:function(){x(this).slideUp(500)},event:"mouseleave"},style:{classes:"qtip-shadow qtip-light"},position:{my:"top center",at:"bottom center"}})}),x("div.redux-hint-qtip").each(function(){x(this).qtip({content:{text:x(this).attr("qtip-content"),title:x(this).attr("qtip-title")},show:{effect:function(){switch(f){case"slide":x(this).slideDown(c);break;case"fade":x(this).fadeIn(c);break;default:x(this).show()}},event:u},hide:{effect:function(){switch(p){case"slide":x(this).slideUp(h);break;case"fade":x(this).fadeOut(h);break;default:x(this).hide(h)}},event:l},style:{classes:s},position:{my:d,at:o}})}),x("input[qtip-content]").each(function(){x(this).qtip({content:{text:x(this).attr("qtip-content"),title:x(this).attr("qtip-title")},show:"focus",hide:"blur",style:s,position:{my:d,at:o}})})}},x.redux.tabCheck=function(){if(x(".redux-group-tab-link-a").click(function(){var e=x(this);if(e.parent().hasClass("empty_section")&&e.parent().hasClass("hasSubSections")){var r=x(this).closest("ul").find(".redux-group-tab-link-a"),i=r.index(this);e=r.slice(i+1,i+2)}var t=e.parents(".redux-container:first"),a=e.data("rel"),n=t.find(".redux-group-tab-link-li.active:first .redux-group-tab-link-a").data("rel");if(n!==a){if(x("#currentSection").val(a),e.parents(".postbox-container:first").length||x.cookie("redux_current_tab",a,{expires:7,path:"/"}),t.find("#"+a+"_section_group_li").parents(".redux-group-tab-link-li").length){var s=t.find("#"+a+"_section_group_li").parents(".redux-group-tab-link-li").attr("id").split("_");s=s[0]}if(t.find("#toplevel_page_"+redux.args.slug+" .wp-submenu a.current").removeClass("current"),t.find("#toplevel_page_"+redux.args.slug+" .wp-submenu li.current").removeClass("current"),t.find("#toplevel_page_"+redux.args.slug+" .wp-submenu a").each(function(){var e=x(this).attr("href").split("&tab=");e[1]!=a&&e[1]!=s||(x(this).addClass("current"),x(this).parent().addClass("current"))}),t.find("#"+n+"_section_group_li").find("#"+n+"_section_group_li").length)t.find("#"+n+"_section_group_li").addClass("activeChild"),t.find("#"+a+"_section_group_li").addClass("active").removeClass("activeChild");else if(t.find("#"+a+"_section_group_li").parents("#"+n+"_section_group_li").length||t.find("#"+n+"_section_group_li").parents("ul.subsection").find("#"+a+"_section_group_li").length)t.find("#"+a+"_section_group_li").parents("#"+n+"_section_group_li").length?t.find("#"+n+"_section_group_li").addClass("activeChild").removeClass("active"):(t.find("#"+a+"_section_group_li").addClass("active"),t.find("#"+n+"_section_group_li").removeClass("active")),t.find("#"+a+"_section_group_li").removeClass("activeChild").addClass("active");else if(t.find("#"+a+"_section_group_li").addClass("active").removeClass("activeChild").find("ul.subsection").slideDown(),t.find("#"+n+"_section_group_li").find("ul.subsection").length){t.find("#"+n+"_section_group_li").find("ul.subsection").slideUp("fast",function(){t.find("#"+n+"_section_group_li").removeClass("active").removeClass("activeChild")});var d=t.find("#"+a+"_section_group_li").parents(".hasSubSections:first");0<d.length&&(t.find("#"+a+"_section_group_li").removeClass("active"),a=d.find(".redux-group-tab-link-a:first").data("rel"),d.hasClass("empty_section")?(d.find(".subsection li:first").addClass("active"),t.find("#"+a+"_section_group_li").removeClass("active").addClass("activeChild").find("ul.subsection").slideDown(),d=d.find(".subsection li:first"),a=d.find(".redux-group-tab-link-a:first").data("rel")):t.find("#"+a+"_section_group_li").addClass("active").removeClass("activeChild").find("ul.subsection").slideDown())}else t.find("#"+n+"_section_group_li").parents("ul.subsection").length?t.find("#"+n+"_section_group_li").parents("#"+a+"_section_group_li").length?t.find("#"+n+"_section_group_li").removeClass("active"):t.find("#"+n+"_section_group_li").parents("ul.subsection").slideUp("fast",function(){t.find("#"+n+"_section_group_li").removeClass("active"),t.find("#"+n+"_section_group_li").parents(".redux-group-tab-link-li").removeClass("active").removeClass("activeChild"),t.find("#"+a+"_section_group_li").parents(".redux-group-tab-link-li").addClass("activeChild").find("ul.subsection").slideDown(),t.find("#"+a+"_section_group_li").addClass("active")}):(t.find("#"+n+"_section_group_li").removeClass("active"),t.find("#"+a+"_section_group_li").parents(".redux-group-tab-link-li").length&&(t.find("#"+a+"_section_group_li").parents(".redux-group-tab-link-li").addClass("activeChild").find("ul.subsection").slideDown(),t.find("#"+a+"_section_group_li").addClass("active")));t.find("#"+n+"_section_group").hide(),t.find("#"+a+"_section_group").fadeIn(0,function(){0!==t.find("#redux-footer").length&&x.redux.stickyInfo(),x.redux.initFields()}),x("#toplevel_page_"+redux.args.slug).find(".current").removeClass("current")}}),void 0===redux.last_tab){var e=decodeURI((new RegExp("tab=(.+?)(&|$)").exec(location.search)||[,""])[1]);""!==e?x.cookie("redux_current_tab_get")!==e&&(x.cookie("redux_current_tab",e,{expires:7,path:"/"}),x.cookie("redux_current_tab_get",e,{expires:7,path:"/"}),x("#"+e+"_section_group_li").click()):""!==x.cookie("redux_current_tab_get")&&x.removeCookie("redux_current_tab_get");var r=x("#"+x.cookie("redux_current_tab")+"_section_group_li_a");null===x.cookie("redux_current_tab")||void 0===x.cookie("redux_current_tab")||0===r.length?x(".redux-container").find(".redux-group-tab-link-a:first").click():r.click()}else x("#"+redux.last_tab+"_section_group_li_a").click()},x.redux.initFields=function(){x(".redux-group-tab:visible").find(".redux-field-init:visible").each(function(){var e=x(this).attr("data-type");if(void 0!==redux.field_objects&&redux.field_objects[e]&&redux.field_objects[e]&&redux.field_objects[e].init(),!redux.customizer&&x(this).hasClass("redux_remove_th")){var r=x(this).parents("tr:first").find("th:first");r.html()&&0<r.html().length&&(x(this).prepend(r.html()),x(this).find(".redux_field_th").css("padding","0 0 10px 0")),x(this).parent().attr("colspan","2"),r.remove()}})},x.redux.notices=function(){redux.errors&&redux.errors.errors&&(x.each(redux.errors.errors,function(e,r){x.each(r.errors,function(e,r){x("#"+redux.args.opt_name+"-"+r.id).addClass("redux-field-error"),0===x("#"+redux.args.opt_name+"-"+r.id).parent().find(".redux-th-error").length?x("#"+redux.args.opt_name+"-"+r.id).append('<div class="redux-th-error">'+r.msg+"</div>"):x("#"+redux.args.opt_name+"-"+r.id).parent().find(".redux-th-error").html(r.msg).css("display","block")})}),x(".redux-container").each(function(){var t=x(this);t.find(".redux-menu-error").remove();var e=t.find(".redux-field-error").length;0<e&&(t.find(".redux-field-errors span").text(e),t.find(".redux-field-errors").slideDown(),t.find(".redux-group-tab").each(function(){var e=x(this).find(".redux-field-error").length;if(0<e){var r=x(this).attr("id").split("_");r=r[0],t.find('.redux-group-tab-link-a[data-key="'+r+'"]').prepend('<span class="redux-menu-error">'+e+"</span>"),t.find('.redux-group-tab-link-a[data-key="'+r+'"]').addClass("hasError");var i=t.find('.redux-group-tab-link-a[data-key="'+r+'"]').parents(".hasSubSections:first");i&&i.find(".redux-group-tab-link-a:first").addClass("hasError")}}))})),redux.warnings&&redux.warnings.warnings&&(x.each(redux.warnings.warnings,function(e,r){x.each(r.warnings,function(e,r){x("#"+redux.args.opt_name+"-"+r.id).addClass("redux-field-warning"),0===x("#"+redux.args.opt_name+"-"+r.id).parent().find(".redux-th-warning").length?x("#"+redux.args.opt_name+"-"+r.id).append('<div class="redux-th-warning">'+r.msg+"</div>"):x("#"+redux.args.opt_name+"-"+r.id).parent().find(".redux-th-warning").html(r.msg).css("display","block")})}),x(".redux-container").each(function(){var t=x(this);t.find(".redux-menu-warning").remove();var e=t.find(".redux-field-warning").length;0<e&&(t.find(".redux-field-warnings span").text(e),t.find(".redux-field-warnings").slideDown(),t.find(".redux-group-tab").each(function(){var e=x(this).find(".redux-field-warning").length;if(0<e){var r=x(this).attr("id").split("_");r=r[0],t.find('.redux-group-tab-link-a[data-key="'+r+'"]').prepend('<span class="redux-menu-warning">'+e+"</span>"),t.find('.redux-group-tab-link-a[data-key="'+r+'"]').addClass("hasWarning");var i=t.find('.redux-group-tab-link-a[data-key="'+r+'"]').parents(".hasSubSections:first");i&&i.find(".redux-group-tab-link-a:first").addClass("hasWarning")}}))}))},x.redux.tabControl=function(){x(".redux-section-tabs div").hide(),x(".redux-section-tabs div:first").show(),x(".redux-section-tabs ul li:first").addClass("active"),x(".redux-section-tabs ul li a").click(function(){x(".redux-section-tabs ul li").removeClass("active"),x(this).parent().addClass("active");var e=x(this).attr("href");return x(".redux-section-tabs div").hide(),x(e).fadeIn("medium",function(){x.redux.initFields()}),!1})},x.redux.required=function(){x.each(redux.folds,function(e,r){var i=x("#"+redux.args.opt_name+"-"+e);if(i.parents("tr:first").addClass("fold"),"hide"==r){if(i.parents("tr:first").addClass("hide"),i.hasClass("redux-container-section")){var t=x("#section-"+e);t.hasClass("redux-section-indent-start")&&(x("#section-table-"+e).hide().addClass("hide"),t.hide().addClass("hide"))}if(i.hasClass("redux-container-info")&&x("#info-"+e).hide().addClass("hide"),i.hasClass("redux-container-divide")&&x("#divide-"+e).hide().addClass("hide"),i.hasClass("redux-container-raw"))i.parents().find("table#"+redux.args.opt_name+"-"+e).hide().addClass("hide")}})},x.redux.get_container_value=function(e){var r=x("#"+redux.args.opt_name+"-"+e).serializeForm();return null!==r&&"object"==typeof r&&r.hasOwnProperty(redux.args.opt_name)&&(r=r[redux.args.opt_name][e]),x("#"+redux.args.opt_name+"-"+e).hasClass("redux-container-media")&&(r=r.url),r},x.redux.check_dependencies=function(e){if(null!==redux.required){var r=x(e),i=r.parents(".redux-field:first").data("id");if(redux.required.hasOwnProperty(i)){var t=r.parents(".redux-field-container:first"),d=t.parents("tr:first").hasClass(".hide");t.parents("tr:first").length||(d=t.parents(".customize-control:first").hasClass(".hide")),x.each(redux.required[i],function(e,r){var i=x(this),t=!1,a=x("#"+redux.args.opt_name+"-"+e),n=a.parents("tr:first");if(d||(t=x.redux.check_parents_dependencies(e)),!0===t){if(a.hasClass("redux-container-section")){var s=x("#section-"+e);s.hasClass("redux-section-indent-start")&&s.hasClass("hide")&&(x("#section-table-"+e).fadeIn(300).removeClass("hide"),s.fadeIn(300).removeClass("hide"))}if(a.hasClass("redux-container-info")&&x("#info-"+e).fadeIn(300).removeClass("hide"),a.hasClass("redux-container-divide")&&x("#divide-"+e).fadeIn(300).removeClass("hide"),a.hasClass("redux-container-raw"))a.parents().find("table#"+redux.args.opt_name+"-"+e).fadeIn(300).removeClass("hide");n.fadeIn(300,function(){x(this).removeClass("hide"),redux.required.hasOwnProperty(e)&&x.redux.check_dependencies(x("#"+redux.args.opt_name+"-"+e).children().first()),x.redux.initFields()}),(a.hasClass("redux-container-section")||a.hasClass("redux-container-info"))&&n.css({display:"none"})}else!1===t&&n.fadeOut(100,function(){x(this).addClass("hide"),redux.required.hasOwnProperty(e)&&x.redux.required_recursive_hide(e)});i.find("select, radio, input[type=checkbox]").trigger("change")})}}},x.redux.required_recursive_hide=function(r){x("#"+redux.args.opt_name+"-"+r).parents("tr:first").fadeOut(50,function(){if(x(this).addClass("hide"),x("#"+redux.args.opt_name+"-"+r).hasClass("redux-container-section")){var e=x("#section-"+r);e.hasClass("redux-section-indent-start")&&(x("#section-table-"+r).fadeOut(50).addClass("hide"),e.fadeOut(50).addClass("hide"))}(x("#"+redux.args.opt_name+"-"+r).hasClass("redux-container-info")&&x("#info-"+r).fadeOut(50).addClass("hide"),x("#"+redux.args.opt_name+"-"+r).hasClass("redux-container-divide")&&x("#divide-"+r).fadeOut(50).addClass("hide"),x("#"+redux.args.opt_name+"-"+r).hasClass("redux-container-raw"))&&x("#"+redux.args.opt_name+"-"+r).parents().find("table#"+redux.args.opt_name+"-"+r).fadeOut(50).addClass("hide");redux.required.hasOwnProperty(r)&&x.each(redux.required[r],function(e){x.redux.required_recursive_hide(e)})})},x.redux.check_parents_dependencies=function(e){var t="";return redux.required_child.hasOwnProperty(e)?x.each(redux.required_child[e],function(e,r){if(x("#"+redux.args.opt_name+"-"+r.parent).parents("tr:first").hasClass(".hide"))t=!1;else if(!1!==t){var i=x.redux.get_container_value(r.parent);t=x.redux.check_dependencies_visibility(i,r)}}):t=!0,t},x.redux.check_dependencies_visibility=function(i,e){var r,d=!1,t=e.checkValue;switch(e.operation){case"=":case"equals":x.isArray(i)?x(i[0]).each(function(e,i){if(x.isArray(t))x(t).each(function(e,r){if(i==r)return d=!0});else if(i==t)return d=!0}):x.isArray(t)?x(t).each(function(e,r){i==r&&(d=!0)}):i==t&&(d=!0);break;case"!=":case"not":x.isArray(i)?x(i).each(function(e,i){if(x.isArray(t))x(t).each(function(e,r){if(i!=r)return d=!0});else if(i!=t)return d=!0}):x.isArray(t)?x(t).each(function(e,r){i!=r&&(d=!0)}):i!=t&&(d=!0);break;case">":case"greater":case"is_larger":parseFloat(i)>parseFloat(t)&&(d=!0);break;case">=":case"greater_equal":case"is_larger_equal":parseFloat(i)>=parseFloat(t)&&(d=!0);break;case"<":case"less":case"is_smaller":parseFloat(i)<parseFloat(t)&&(d=!0);break;case"<=":case"less_equal":case"is_smaller_equal":parseFloat(i)<=parseFloat(t)&&(d=!0);break;case"contains":x.isPlainObject(i)&&(i=Object.keys(i).map(function(e){return[e,i[e]]})),x.isPlainObject(t)&&(t=Object.keys(t).map(function(e){return[e,t[e]]})),x.isArray(t)?x(t).each(function(e,r){var a=!1,n=r[0],s=r[1];if(x(i).each(function(e,r){var i=r[0],t=r[1];if(n===i&&s==t)return!(a=d=!0)}),!0===a)return!1}):-1!==i.toString().indexOf(t)&&(d=!0);break;case"doesnt_contain":case"not_contain":x.isPlainObject(i)&&(r=Object.keys(i).map(function(e){return i[e]}),i=r),x.isPlainObject(t)&&(r=Object.keys(t).map(function(e){return t[e]}),t=r),x.isArray(t)?x(t).each(function(e,r){-1===i.toString().indexOf(r)&&(d=!0)}):-1===i.toString().indexOf(t)&&(d=!0);break;case"is_empty_or":""!==i&&i!=t||(d=!0);break;case"not_empty_and":""!==i&&i!=t&&(d=!0);break;case"is_empty":case"empty":case"!isset":i&&""!==i&&null!==i||(d=!0);break;case"not_empty":case"!empty":case"isset":i&&""!==i&&null!==i&&(d=!0)}return d},x.redux.verifyPos=function(e,r){if(""===(e=e.replace(/^\s+|\s+$/gm,""))||-1==e.search(" "))return!0===r?"top left":"bottom right";var i=e.split(" "),t=r?"top":"bottom";"top"!=i[0]&&"center"!=i[0]&&"bottom"!=i[0]||(t=i[0]);var a=r?"left":"right";return"left"!=i[1]&&"center"!=i[1]&&"right"!=i[1]||(a=i[1]),t+" "+a},x.redux.stickyInfo=function(){var e=x(".redux-main").innerWidth()-20;x("#info_bar").isOnScreen()||x("#redux-footer-sticky").isOnScreen()?(x("#redux-footer").css({background:"#eee",position:"inherit",bottom:"inherit",width:"inherit"}),x("#redux-sticky-padder").hide(),x("#redux-footer").removeClass("sticky-footer-fixed")):(x("#redux-footer").css({position:"fixed",bottom:"0",width:e,right:21}),x("#redux-footer").addClass("sticky-footer-fixed"),x(".redux-save-warn").css("left",x("#redux-sticky").offset().left),x("#redux-sticky-padder").show()),x("#info_bar").isOnScreen()?x("#redux-sticky").removeClass("sticky-save-warn"):x("#redux-sticky").addClass("sticky-save-warn")},x.redux.expandOptions=function(e){var r=e.find(".expand_options"),i=e.find(".redux-sidebar").width()-1,t=x(".redux-group-menu .active a").data("rel")+"_section_group";return r.hasClass("expanded")?(r.removeClass("expanded"),e.find(".redux-main").removeClass("expand"),e.find(".redux-sidebar").stop().animate({"margin-left":"0px"},500),e.find(".redux-main").stop().animate({"margin-left":i},500,function(){e.find(".redux-main").attr("style","")}),e.find(".redux-group-tab").each(function(){x(this).attr("id")!==t&&x(this).fadeOut("fast")})):(r.addClass("expanded"),e.find(".redux-main").addClass("expand"),e.find(".redux-sidebar").stop().animate({"margin-left":-i-113},500),e.find(".redux-main").stop().animate({"margin-left":"-1px"},500),e.find(".redux-group-tab").fadeIn("medium",function(){x.redux.initFields()})),!1},x.redux.scaleToRatio=function(e,r,i){var t=0,a=e.attr("data-width");a||(a=e.width(),e.attr("data-width",a));var n=e.attr("data-height"),s=e.height();(!n||n<s)&&(n=s,e.attr("data-height",n),e.css("width","auto"),e.attr("data-width",e.width()),a=e.width()),i<a?(t=i/a,e.css("width",i),e.css("height",n*t),n*=t,a*=t):e.css("width","auto"),r<n?(t=r/n,e.css("height",r),e.css("width",a*t),a*=t,n*=t):e.css("height","auto");var d=(x(document.getElementById("redux-header")).height()-e.height())/2;0<d?e.css("margin-top",d):e.css("margin-top",0),x("#redux-header .redux_field_search")&&x("#redux-header .redux_field_search").css("right",x(e).width()+20)}}(jQuery),jQuery.noConflict();var confirmOnPageExit=function(e){e=e||window.event;var r=redux.args.save_pending;return e&&(e.returnValue=r),window.onbeforeunload=null,r};function redux_change(e){jQuery("body").trigger("check_dependencies",e),e.hasClass("compiler")&&jQuery("#redux-compiler-hook").val(1);var r=jQuery(e).parents(".redux-container:first"),i=jQuery(e).closest(".redux-group-tab").attr("id"),t=i.split("_");t=t[0];var a=r.find('.redux-group-tab-link-a[data-key="'+t+'"]').parents(".redux-group-tab-link-li:first"),n=jQuery("#"+i+"_li").parents(".hasSubSections:first");if(jQuery(e).parents("fieldset.redux-field:first").hasClass("redux-field-error")){jQuery(e).parents("fieldset.redux-field:first").removeClass("redux-field-error"),jQuery(e).parent().find(".redux-th-error").slideUp();var s=parseInt(r.find(".redux-field-errors span").text())-1;if(s<=0)jQuery("#"+i+"_li .redux-menu-error").fadeOut("fast").remove(),jQuery("#"+i+"_li .redux-group-tab-link-a").removeClass("hasError"),jQuery("#"+i+"_li").parents(".inside:first").find(".redux-field-errors").slideUp(),jQuery(e).parents(".redux-container:first").find(".redux-field-errors").slideUp(),jQuery("#redux_metaboxes_errors").slideUp();else{var d=parseInt(a.find(".redux-menu-error:first").text())-1;d<=0?a.find(".redux-menu-error:first").fadeOut().remove():a.find(".redux-menu-error:first").text(d),r.find(".redux-field-errors span").text(s)}0!==n.length&&0===n.find(".redux-menu-error").length&&n.find(".hasError").removeClass("hasError")}if(jQuery(e).parents("fieldset.redux-field:first").hasClass("redux-field-warning")){jQuery(e).parents("fieldset.redux-field:first").removeClass("redux-field-warning"),jQuery(e).parent().find(".redux-th-warning").slideUp();var o=parseInt(r.find(".redux-field-warnings span").text())-1;if(o<=0)jQuery("#"+i+"_li .redux-menu-warning").fadeOut("fast").remove(),jQuery("#"+i+"_li .redux-group-tab-link-a").removeClass("hasWarning"),jQuery("#"+i+"_li").parents(".inside:first").find(".redux-field-warnings").slideUp(),jQuery(e).parents(".redux-container:first").find(".redux-field-warnings").slideUp(),jQuery("#redux_metaboxes_warnings").slideUp();else{var u=parseInt(a.find(".redux-menu-warning:first").text())-1;u<=0?a.find(".redux-menu-warning:first").fadeOut().remove():a.find(".redux-menu-warning:first").text(u),r.find(".redux-field-warning span").text(o)}0!==n.length&&0===n.find(".redux-menu-warning").length&&n.find(".hasWarning").removeClass("hasWarning")}0<r.find(".saved_notice:visible").length||(redux.customizer?redux.customizer.save(e,r,i):redux.args.disable_save_warn||(r.find(".redux-save-warn").slideDown(),window.onbeforeunload=confirmOnPageExit))}function colorValidate(e){var r=jQuery(e).val(),i=colorNameToHex(r);return i!==r.replace("#","")?i:r}function colorNameToHex(e){var r=e.replace(/^\s\s*/,"").replace(/\s\s*$/,"").replace("#",""),i={aliceblue:"#f0f8ff",antiquewhite:"#faebd7",aqua:"#00ffff",aquamarine:"#7fffd4",azure:"#f0ffff",beige:"#f5f5dc",bisque:"#ffe4c4",black:"#000000",blanchedalmond:"#ffebcd",blue:"#0000ff",blueviolet:"#8a2be2",brown:"#a52a2a",burlywood:"#deb887",cadetblue:"#5f9ea0",chartreuse:"#7fff00",chocolate:"#d2691e",coral:"#ff7f50",cornflowerblue:"#6495ed",cornsilk:"#fff8dc",crimson:"#dc143c",cyan:"#00ffff",darkblue:"#00008b",darkcyan:"#008b8b",darkgoldenrod:"#b8860b",darkgray:"#a9a9a9",darkgreen:"#006400",darkkhaki:"#bdb76b",darkmagenta:"#8b008b",darkolivegreen:"#556b2f",darkorange:"#ff8c00",darkorchid:"#9932cc",darkred:"#8b0000",darksalmon:"#e9967a",darkseagreen:"#8fbc8f",darkslateblue:"#483d8b",darkslategray:"#2f4f4f",darkturquoise:"#00ced1",darkviolet:"#9400d3",deeppink:"#ff1493",deepskyblue:"#00bfff",dimgray:"#696969",dodgerblue:"#1e90ff",firebrick:"#b22222",floralwhite:"#fffaf0",forestgreen:"#228b22",fuchsia:"#ff00ff",gainsboro:"#dcdcdc",ghostwhite:"#f8f8ff",gold:"#ffd700",goldenrod:"#daa520",gray:"#808080",green:"#008000",greenyellow:"#adff2f",honeydew:"#f0fff0",hotpink:"#ff69b4","indianred ":"#cd5c5c","indigo ":"#4b0082",ivory:"#fffff0",khaki:"#f0e68c",lavender:"#e6e6fa",lavenderblush:"#fff0f5",lawngreen:"#7cfc00",lemonchiffon:"#fffacd",lightblue:"#add8e6",lightcoral:"#f08080",lightcyan:"#e0ffff",lightgoldenrodyellow:"#fafad2",lightgrey:"#d3d3d3",lightgreen:"#90ee90",lightpink:"#ffb6c1",lightsalmon:"#ffa07a",lightseagreen:"#20b2aa",lightskyblue:"#87cefa",lightslategray:"#778899",lightsteelblue:"#b0c4de",lightyellow:"#ffffe0",lime:"#00ff00",limegreen:"#32cd32",linen:"#faf0e6",magenta:"#ff00ff",maroon:"#800000",mediumaquamarine:"#66cdaa",mediumblue:"#0000cd",mediumorchid:"#ba55d3",mediumpurple:"#9370d8",mediumseagreen:"#3cb371",mediumslateblue:"#7b68ee",mediumspringgreen:"#00fa9a",mediumturquoise:"#48d1cc",mediumvioletred:"#c71585",midnightblue:"#191970",mintcream:"#f5fffa",mistyrose:"#ffe4e1",moccasin:"#ffe4b5",navajowhite:"#ffdead",navy:"#000080",oldlace:"#fdf5e6",olive:"#808000",olivedrab:"#6b8e23",orange:"#ffa500",orangered:"#ff4500",orchid:"#da70d6",palegoldenrod:"#eee8aa",palegreen:"#98fb98",paleturquoise:"#afeeee",palevioletred:"#d87093",papayawhip:"#ffefd5",peachpuff:"#ffdab9",peru:"#cd853f",pink:"#ffc0cb",plum:"#dda0dd",powderblue:"#b0e0e6",purple:"#800080",red:"#ff0000",redux:"#01a3e3",rosybrown:"#bc8f8f",royalblue:"#4169e1",saddlebrown:"#8b4513",salmon:"#fa8072",sandybrown:"#f4a460",seagreen:"#2e8b57",seashell:"#fff5ee",sienna:"#a0522d",silver:"#c0c0c0",skyblue:"#87ceeb",slateblue:"#6a5acd",slategray:"#708090",snow:"#fffafa",springgreen:"#00ff7f",steelblue:"#4682b4",tan:"#d2b48c",teal:"#008080",thistle:"#d8bfd8",tomato:"#ff6347",turquoise:"#40e0d0",violet:"#ee82ee",wheat:"#f5deb3",white:"#ffffff",whitesmoke:"#f5f5f5",yellow:"#ffff00",yellowgreen:"#9acd32"};return"undefined"!==i[r.toLowerCase()]?i[r.toLowerCase()]:e}function redux_hook(e,r,i,t){var a;a=e[r],e[r]=function(){!0===t&&i.apply(this,[e,a,arguments]);var e=a.apply(this,arguments);return!0!==t&&i.apply(this,[e,a,arguments]),e}}