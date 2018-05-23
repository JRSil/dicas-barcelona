<?php
/**
 * setwood hooks
 *
 * @package setwood
 */

/**
 * General
 */
add_action( 'setwood_before_header',     'setwood_facebook_page',			10 );
add_action( 'setwood_before_content',    'setwood_featured',				20 );
add_action( 'setwood_content_top',	     'setwood_featured_widgets',	    25 );
add_action( 'setwood_before_content',    'setwood_header_widget_region',	30 );
add_action( 'setwood_sidebar',			 'setwood_get_sidebar',				40 );

/**
 * Header
 */

add_action( 'setwood_header_1', 'setwood_skip_links',				0 );
add_action( 'setwood_header_1', 'setwood_sticky_header',			5 );
add_action( 'setwood_header_1', 'setwood_header_top', 				10 );
add_action( 'setwood_header_1', 'setwood_header_social_icons',  	30 );
add_action( 'setwood_header_1', 'setwood_search_toggle',			40 );
add_action( 'setwood_header_1', 'setwood_header_cart',				45 );
add_action( 'setwood_header_1', 'setwood_secondary_navigation',		50 );
add_action( 'setwood_header_1', 'setwood_header_top_close',			60 );
add_action( 'setwood_header_1', 'setwood_site_branding',			70 );
add_action( 'setwood_header_1', 'setwood_nav_wrapper',				80 );
add_action( 'setwood_header_1', 'setwood_primary_navigation',		90 );
add_action( 'setwood_header_1', 'setwood_nav_wrapper_close',		100 );

add_action( 'setwood_header_2', 'setwood_skip_links',				0 );
add_action( 'setwood_header_2', 'setwood_sticky_header',			5 );
add_action( 'setwood_header_2', 'setwood_header_top', 				10 );
add_action( 'setwood_header_2', 'setwood_primary_navigation',		20 );
add_action( 'setwood_header_2', 'setwood_search_toggle',			30 );
add_action( 'setwood_header_2', 'setwood_header_cart',				40 );
add_action( 'setwood_header_2', 'setwood_header_social_icons',  	45 );
add_action( 'setwood_header_2', 'setwood_header_top_close',			50 );
add_action( 'setwood_header_2', 'setwood_site_branding',			60 );


add_action( 'setwood_header_3', 'setwood_skip_links',				0 );
add_action( 'setwood_header_3', 'setwood_sticky_header',			5 );
add_action( 'setwood_header_3', 'setwood_header_top', 				10 );
add_action( 'setwood_header_3', 'setwood_search_toggle',			20 );
add_action( 'setwood_header_3', 'setwood_header_cart',				25 );
add_action( 'setwood_header_3', 'setwood_header_social_icons',  	30 );
add_action( 'setwood_header_3', 'setwood_header_top_close', 		40 );
add_action( 'setwood_header_3', 'setwood_header_middle',			80 );
add_action( 'setwood_header_3', 'setwood_site_branding',			90 );
add_action( 'setwood_header_3', 'setwood_primary_navigation',		120 );
add_action( 'setwood_header_3', 'setwood_header_middle_close',		130 );


/**
 * Footer
 */
add_action( 'setwood_footer', 'setwood_footer_widgets',     10 );
add_action( 'setwood_footer', 'setwood_instagram_footer',	20 );
add_action( 'setwood_footer', 'setwood_footer_social_icons',30 );
add_action( 'setwood_footer', 'setwood_credit',             40 );

/**
 * Homepage
 */
add_action( 'homepage', 'setwood_homepage_content',		10 );
add_action( 'homepage', 'setwood_product_categories',	20 );
add_action( 'homepage', 'setwood_recent_products',		30 );
add_action( 'homepage', 'setwood_featured_products',	40 );
add_action( 'homepage', 'setwood_popular_products',		50 );
add_action( 'homepage', 'setwood_on_sale_products',		60 );

/**
 * Posts
 */

/* Standard Loop */
add_action( 'setwood_loop_post',			'setwood_entry_wrapper',            05 );
add_action( 'setwood_loop_post',			'setwood_post_thumbnail',           10 );
add_action( 'setwood_loop_post',			'setwood_post_header',		        20 );
add_action( 'setwood_loop_post',			'setwood_loop_content',             30 );
add_action( 'setwood_loop_post',			'setwood_init_structured_data',		40 );
add_action( 'setwood_loop_post',			'setwood_wide_post_meta_footer',	50 );
add_action( 'setwood_loop_post',			'setwood_entry_wrapper_close',      60 );

/* Grid Loop */
add_action( 'setwood_grid_loop_post',			'setwood_entry_wrapper',             05 );
add_action( 'setwood_grid_loop_post',			'setwood_post_thumbnail',            10 );
add_action( 'setwood_grid_loop_post',			'setwood_post_header',		         20 );
add_action( 'setwood_grid_loop_post',			'setwood_loop_content',              30 );
add_action( 'setwood_grid_loop_post',         	'setwood_init_structured_data',		 40 );
add_action( 'setwood_grid_loop_post',			'setwood_post_meta_footer',          50 );
add_action( 'setwood_grid_loop_post',			'setwood_entry_wrapper_close',       60 );

/* List Loop */
add_action( 'setwood_list_loop_post',			'setwood_entry_wrapper',			10 );
add_action( 'setwood_list_loop_post',			'setwood_list_item_col_alpha',		20 );
add_action( 'setwood_list_loop_post',			'setwood_post_thumbnail',			30 );
add_action( 'setwood_list_loop_post',			'setwood_list_item_col_alpha_close',40 );
add_action( 'setwood_list_loop_post',			'setwood_list_item_col_omega',		45 );
add_action( 'setwood_list_loop_post',			'setwood_post_header',				50 );
add_action( 'setwood_list_loop_post',			'setwood_loop_content',				70 );
add_action( 'setwood_list_loop_post',         	'setwood_init_structured_data',		90 );
add_action( 'setwood_list_loop_post',			'setwood_list_item_col_omega_close',100 );
add_action( 'setwood_list_loop_post',			'setwood_newline',					110 );
add_action( 'setwood_list_loop_post',			'setwood_wide_post_meta_footer',	120 );
add_action( 'setwood_list_loop_post',			'setwood_entry_wrapper_close',		140 );


add_action( 'setwood_loop_after',   		'setwood_paging_nav',       		10 );

add_action( 'setwood_single_post',			'setwood_entry_wrapper',            05 );
add_action( 'setwood_single_post',  		'setwood_post_header',      		10 );
add_action( 'setwood_single_post',  		'setwood_post_thumbnail',			25 );
add_action( 'setwood_single_post',  		'setwood_post_content',				30 );
add_action( 'setwood_single_post',         	'setwood_init_structured_data',		35 );
add_action( 'setwood_single_post',  		'setwood_post_tag',   				40 );
add_action( 'setwood_single_post',			'setwood_wide_post_meta_footer',  	50 );
add_action( 'setwood_single_post',			'setwood_entry_wrapper_close',      60 );

add_action( 'setwood_single_post_after',	'setwood_post_author',				20 );
add_action( 'setwood_single_post_after',	'setwood_post_nav',					30 );
add_action( 'setwood_single_post_after',	'setwood_get_related_posts',		35 );
add_action( 'setwood_single_post_after',	'setwood_display_comments',			40 );

/**
 * Pages
 */
add_action( 'setwood_page',				'setwood_entry_wrapper',        	05 );
add_action( 'setwood_page', 			'setwood_page_header',				10 );
add_action( 'setwood_page',  			'setwood_post_thumbnail',			15 );
add_action( 'setwood_page', 			'setwood_page_content',				20 );
add_action( 'setwood_page',         	'setwood_init_structured_data',		25 );
add_action( 'setwood_page_after', 	    'setwood_display_comments',			10 );
add_action( 'setwood_page_after',			'setwood_entry_wrapper_close',  20 );