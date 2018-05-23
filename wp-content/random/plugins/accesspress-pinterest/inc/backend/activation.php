<?php defined('ABSPATH') or die('No script kiddies please!');
$apsp_settings 						= array();
$apspp_settings['display_options'] = array('post', 'page');
$apsp_settings['pinit_js_disable'] 	= 'off';
$apsp_settings['js_enabled'] 		= 'off';
$apsp_settings['size'] 				= 'small';
$apsp_settings['shape'] 			= 'rectangular';
$apsp_settings['color'] 			= 'gray';
$apsp_settings['language'] 			= 'eng';

//update of a option table
update_option( APSP_SETTINGS, $apsp_settings );
