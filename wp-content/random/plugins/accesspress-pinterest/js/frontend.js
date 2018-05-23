//function from https://halgatewood.com/how-to-customize-the-pin-it-button-for-pinterest

function pinIt()

{

  var e = document.createElement('script');

  e.setAttribute('type','text/javascript');

  e.setAttribute('charset','UTF-8');

  e.setAttribute('src','https://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);

  document.body.appendChild(e);

}



jQuery(document).ready(function($) {

	$(window).load(function(){

		var $container = $('.apsp-caption-disabled,.apsp-caption-enabled');

		$container.isotope({

			itemSelector: '.apsp-pinterest-latest-pin',

		});



	});

});