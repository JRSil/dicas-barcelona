jQuery(function(o){function n(n){n.options.height=jQuery(".w3tc_popup_form").height()+30,n.resize()}o("body").on("click",".w3tc_cdn_stackpath_fsd_authorize",function(){W3tc_Lightbox.open({id:"w3tc-overlay",close:"",width:800,height:300,url:ajaxurl+"?action=w3tc_ajax&_wpnonce="+w3tc_nonce+"&w3tc_action=cdn_stackpath_fsd_intro",callback:n})}).on("click",".w3tc_cdn_stackpath_fsd_list_zones",function(){var c=ajaxurl+"?action=w3tc_ajax&_wpnonce="+w3tc_nonce+"&w3tc_action=cdn_stackpath_fsd_list_zones";o(".w3tc_popup_form").find("input").each(function(n){var t=o(this).attr("name");t&&(c+="&"+encodeURIComponent(t)+"="+encodeURIComponent(o(this).val()))});W3tc_Lightbox.load(c,n)}).on("click",".w3tc_cdn_stackpath_fsd_view_zone",function(){var c=ajaxurl+"?action=w3tc_ajax&_wpnonce="+w3tc_nonce+"&w3tc_action=cdn_stackpath_fsd_view_zone";o(".w3tc_popup_form").find("input").each(function(n){var t=o(this).attr("name");("radio"!=o(this).attr("type")||o(this).prop("checked"))&&t&&(c+="&"+encodeURIComponent(t)+"="+encodeURIComponent(o(this).val()))});W3tc_Lightbox.load(c,n)}).on("click",".w3tc_cdn_stackpath_fsd_configure_zone",function(){var c=ajaxurl+"?action=w3tc_ajax&_wpnonce="+w3tc_nonce+"&w3tc_action=cdn_stackpath_fsd_configure_zone";o(".w3tc_popup_form").find("input").each(function(n){var t=o(this).attr("name");t&&(c+="&"+encodeURIComponent(t)+"="+encodeURIComponent(o(this).val()))});W3tc_Lightbox.load(c,n)}).on("click",".w3tc_cdn_stackpath_fsd_configure_zone_skip",function(){var c=ajaxurl+"?action=w3tc_ajax&_wpnonce="+w3tc_nonce+"&w3tc_action=cdn_stackpath_fsd_configure_zone_skip";o(".w3tc_popup_form").find("input").each(function(n){var t=o(this).attr("name");t&&(c+="&"+encodeURIComponent(t)+"="+encodeURIComponent(o(this).val()))});W3tc_Lightbox.load(c,n)}).on("click",".w3tc_cdn_stackpath_fsd_done",function(){window.location=window.location+"&"}).on("size_change","#cdn_cname_add",function(){n(W3tc_Lightbox)})});