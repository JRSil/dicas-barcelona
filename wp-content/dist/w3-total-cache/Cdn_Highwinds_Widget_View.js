var w3tchw_graph_data;function w3tchw_load(){jQuery(".w3tchw_loading").removeClass("w3tc_hidden"),jQuery(".w3tchw_content").addClass("w3tc_hidden"),jQuery(".w3tchw_error").addClass("w3tc_none"),jQuery.getJSON(ajaxurl+"?action=w3tc_ajax&_wpnonce="+w3tc_nonce+"&w3tc_action=cdn_highwinds_widgetdata",function(e){if(e&&e.error)return jQuery(".w3tchw_error").removeClass("w3tc_none"),jQuery(".w3tchw_error_details").html(e.error),void jQuery(".w3tchw_loading").addClass("w3tc_hidden");for(p in e){var a=e[p];jQuery(".w3tchw_"+p).html(a)}e=google.visualization.arrayToDataTable(e.graph);new google.charts.Bar(document.getElementById("w3tchw_chart")).draw(e,{legend:{position:"none"},bars:"horizontal"}),jQuery(".w3tchw_content").removeClass("w3tc_hidden"),jQuery(".w3tchw_loading").addClass("w3tc_hidden")}).fail(function(){jQuery(".w3tchw_error").removeClass("w3tc_none"),jQuery(".w3tchw_content").addClass("w3tc_hidden"),jQuery(".w3tchw_loading").addClass("w3tc_hidden")})}google.load("visualization","1.1",{packages:["bar"]}),google.setOnLoadCallback(w3tchw_load);