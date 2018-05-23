<?php
/**
 * 300x250 Advertisement Ads Widget
 */
function widget_banner() {
	register_widget('Setwood_banner_widget');
}
add_action('widgets_init', 'widget_banner');

class Setwood_banner_widget extends WP_Widget {
	function __construct() {
		$widget_ops = array( 'description' => esc_html__('Add your Advertisement here', 'setwood' ) );
		parent::__construct( 'setwood_banner', esc_html__('Setwood: Banner Advertisement', 'setwood' ), $widget_ops );
	}

	function widget($args, $instance) {
		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
        
        echo $args['before_widget'];

		if ( !empty($instance['title']) )
			echo $args['before_title'] . $instance['title'] . $args['after_title'];
        
        echo '<div class="ad-block">';
        
		if ( !empty($instance['title']) )
			$title = $args['before_title'] . $instance['title'] . $args['after_title'];
        
		$url = ! empty( $instance['url'] ) ? esc_url( $instance['url'] ) : '';
		$image = esc_url( $instance['image'] );

		if ( ! empty( $image ) ) {
			if ( !empty( $url ) )
				echo '<a class="image-hover" href="'.$url.'" target="_blank">';

			echo '<img src="'.$image.'" alt="'.$instance['title'].'" />';

			if ( !empty( $url ) )
				echo '</a>';
		}

        echo '</div>';
        echo $args['after_widget'];
	}

	function update( $new_instance, $old_instance ) {
		$instance['title'] = strip_tags( stripslashes($new_instance['title']) );
		$instance['image'] = esc_url_raw( $new_instance['image'] );
		$instance['url'] = esc_url_raw( $new_instance['url'] );
		return $instance;
	}

	function form( $instance ) {
		$title = isset( $instance['title'] ) ? $instance['title'] : 'Advertisement';
		$image = isset( $instance['image'] ) ? $instance['image'] : '';
		$url = isset( $instance['url'] ) ? $instance['url'] : '';
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title:', 'setwood' ) ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
		</p>
		<div class="wpc-widgets-image-field">
		<label for="<?php echo $this->get_field_id('image'); ?>"><?php esc_html_e( 'Image:', 'setwood' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" type="text" value="<?php echo $image; ?>" />
			<a class="wpc-widgets-image-upload button inline-button" data-target="#<?php echo $this->get_field_id( 'image' ); ?>" data-preview=".wpc-widgets-preview-image" data-frame="select" data-state="wpc_widgets_insert_single" data-fetch="url" data-title="Insert Image" data-button="Insert" data-class="media-frame wpc-widgets-custom-uploader" title="Add Media">Add Media</a>
			<a class="button wpc-widgets-delete-image" data-target="#<?php echo $this->get_field_id( 'image' ); ?>" data-preview=".wpc-widgets-preview-image">Delete</a>
			<div class="wpc-widgets-preview-image"><img src="<?php echo esc_attr($image); ?>" /></div>
		</div>
		<p>
			<label for="<?php echo $this->get_field_id('url'); ?>"><?php esc_html_e('URL:', 'setwood' ) ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('url'); ?>" name="<?php echo $this->get_field_name('url'); ?>" value="<?php echo $url; ?>" />
		</p>
		<?php
	}
}