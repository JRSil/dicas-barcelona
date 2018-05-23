jQuery(document).ready(function($){



	$( '.apsp-tabs-trigger' ).click(function(){

        $( '.apsp-tabs-trigger' ).removeClass( 'apsp-active-tab' );

        $(this).addClass( 'apsp-active-tab' );

        var board_id = 'tab-'+$(this).attr('id');

        $('.apsp-tab-contents').hide();

        $('#'+board_id).show();

       });



	$('.widget-liquid-right').on('change', '.apsp-board-custom-sizes-options', function(){

		 var changed_value= $(this).val();

		 if(changed_value == 'custom'){

		 	$('.apsp-board-custom-size-values').fadeIn();

		 }else{

		 	$('.apsp-board-custom-size-values').fadeOut();

		 }

	});



	$('.widget-liquid-right'). on('change', '.apsp-profile-custom-sizes-selection', function(){

		var changed_value= $(this).val();

		 if(changed_value == 'custom'){

		 	$('.apsp-profile-custom-size-values').fadeIn();

		 }else{

		 	$('.apsp-profile-custom-size-values').fadeOut();

		 }

	});



	$('#apsp-pinterest-button-shape').change(function(){

		var changed_value= $(this).val();

		if(changed_value == 'rectangular'){

		 	$('.apsp-rectangular-options').fadeIn();

		 }else{

		 	$('.apsp-rectangular-options').fadeOut();

		 }

	});



	$('#apsp_js_enabled').click(function(){

		if($('#apsp_js_enabled').is(':checked')){

			$('.apsp-display-settings').fadeIn('fast', function() {

				// alert('done');

			});

		}else{

			$('.apsp-display-settings').fadeOut('fast', function() {

				// alert('done');

			});

		}

	});

});