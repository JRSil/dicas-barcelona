<?php
/**
 * Feature Block Widget
 */
function setwood_feature_widget_widgets_init() {
	register_widget('Setwood_Feature_Widget');
}
add_action('widgets_init', 'setwood_feature_widget_widgets_init');

class Setwood_Feature_Widget extends WP_Widget {
	function __construct() {
		$widget_ops = array( 'description' => esc_html__('Add and customize your Promos.' , 'setwood' ) );
		parent::__construct( 'setwood_feature_block', esc_html__('Setwood: Feature Block' , 'setwood' ), $widget_ops );
	}

	function widget($args, $instance) {
		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		
		$image = esc_url( $instance['image'] );

        echo '<div class="feature-block" style="background-image:url('.$image.');">';
        
		if ( !empty($instance['title']) )
			$title = $args['before_title'] . $instance['title'] . $args['after_title'];

		
		$url = ! empty( $instance['url'] ) ? esc_url( $instance['url'] ) : '';
		

		if ( ! empty( $image ) ) {
			if ( !empty( $url ) )
				echo '<a class="img-hover" href="'.$url.'"></a>';
				echo $title;				
		}

		$allowed_html = array(
			'a' => array(
				'href' => array(),
				'title' => array(),
				'target' => array(),
			),
			'br' => array(),
			'em' => array(),
			'strong' => array(),
		);

        echo '</div>';
	}

	function update( $new_instance, $old_instance ) {
		$instance['title'] = strip_tags( stripslashes($new_instance['title']) );
		$instance['image'] = esc_url_raw( $new_instance['image'] );
		$instance['url'] = esc_url_raw( $new_instance['url'] );
		return $instance;
	}

	function form( $instance ) {
		$title = isset( $instance['title'] ) ? $instance['title'] : 'About Me!';
		$image = isset( $instance['image'] ) ? $instance['image'] : '';
		$imagestyle = '';
		if ( empty( $image ) )
			$imagestyle = ' style="display:none"';

		$style = isset( $instance['style'] ) ? $instance['style'] : 'none';
		$url = isset( $instance['url'] ) ? $instance['url'] : '';
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html__('Title:' , 'setwood' ) ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
		</p>
		<div class="wpc-widgets-image-field">
			<input class="widefat" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" type="text" value="<?php echo $image; ?>" />
			<a class="wpc-widgets-image-upload button inline-button" data-target="#<?php echo $this->get_field_id( 'image' ); ?>" data-preview=".wpc-widgets-preview-image" data-frame="select" data-state="wpc_widgets_insert_single" data-fetch="url" data-title="Insert Image" data-button="Insert" data-class="media-frame wpc-widgets-custom-uploader" title="Add Media">Add Media</a>
			<a class="button wpc-widgets-delete-image" data-target="#<?php echo $this->get_field_id( 'image' ); ?>" data-preview=".wpc-widgets-preview-image">Delete</a>
			<div class="wpc-widgets-preview-image"<?php echo $imagestyle; ?>><img src="<?php echo esc_attr($image); ?>" /></div>
		</div>
		<p>
			<label for="<?php echo $this->get_field_id('url'); ?>"><?php esc_html__('URL:' , 'setwood' ) ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('url'); ?>" name="<?php echo $this->get_field_name('url'); ?>" value="<?php echo $url; ?>" />
		</p>
		<?php
	}
}