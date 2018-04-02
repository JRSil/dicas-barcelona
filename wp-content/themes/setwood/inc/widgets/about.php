<?php
/**
 * About Me Widget
 */
function setwood_about_me_widget_widgets_init() {
	register_widget('Setwood_About_Me_Widget');
}
add_action('widgets_init', 'setwood_about_me_widget_widgets_init');

class Setwood_About_Me_Widget extends WP_Widget {
	function __construct() {
		$widget_ops = array( 'description' => esc_html__('Add and customize your "About Me" information.', 'setwood') );
		parent::__construct( 'setwood_about_me', esc_html__('Setwood: About Me', 'setwood'), $widget_ops );
	}

	function widget($args, $instance) {
		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo $args['before_widget'];

		if ( !empty($instance['title']) )
			echo $args['before_title'] . $instance['title'] . $args['after_title'];

		$class = !empty( $instance['style'] ) ? $instance['style'] : 'none';

		$style = array();
		if ( 'circle' == $class ) {
			$style[] = 'border-radius:50%';
		}


		$url = ! empty( $instance['url'] ) ? esc_url( $instance['url'] ) : '';

		$name = ! empty( $instance['name'] ) ? stripslashes( $instance['name'] ) : '';

		$position = ! empty( $instance['position'] ) ? stripslashes( $instance['position'] ) : '';

		$image = esc_url( $instance['image'] );

		$signature = esc_url( $instance['signature'] );

		if ( ! empty( $image ) ) {
			if ( !empty( $url ) )
				echo '<a class="image-hover" href="'.$url.'">';

			echo '<img class="img-'.$class.'" src="'.$image.'" style="'.implode( ';', $style ).'" alt="author"/>';

			if ( !empty( $url ) )
				echo '</a>';
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

		if ( !empty( $instance['name'] ) ) :
		echo '<h4 class="name">'.$name.'</h4>';
		endif;

		if ( !empty( $instance['position'] ) ) :
		echo '<h5 class="position">'.$position.'</h5>';
		endif;

		if ( !empty( $instance['description'] ) ) :
			echo '<p class="sidebar-caption">'.wp_kses( $instance['description'], $allowed_html ).'</p>';
		endif;

		if ( !empty( $instance['signature'] ) ) :
		echo '<img class="signature" src="'.$signature.'" alt="signature"/>';
		endif;

		echo $args['after_widget'];
	}

	function update( $new_instance, $old_instance ) {
		$instance['title'] = strip_tags( stripslashes($new_instance['title']) );
		$instance['image'] = esc_url_raw( $new_instance['image'] );
		$instance['description'] = esc_textarea(stripslashes( $new_instance['description'] ));
		$instance['style'] = strip_tags( $new_instance['style'] );
		$instance['url'] = esc_url_raw( $new_instance['url'] );
		$instance['name'] = stripslashes( $new_instance['name'] );
		$instance['position'] = stripslashes( $new_instance['position'] );
		$instance['signature'] = esc_url_raw( $new_instance['signature'] );
		return $instance;
	}

	function form( $instance ) {
		$title = isset( $instance['title'] ) ? $instance['title'] : 'About Me!';
		$image = isset( $instance['image'] ) ? $instance['image'] : '';
		$signature = isset( $instance['signature'] ) ? $instance['signature'] : '';
		$imagestyle = '';
		if ( empty( $image ) )
			$imagestyle = ' style="display:none"';

		$description = isset( $instance['description'] ) ? $instance['description'] : '';
		$style = isset( $instance['style'] ) ? $instance['style'] : 'none';
		$url = isset( $instance['url'] ) ? $instance['url'] : '';
		$name = isset( $instance['name'] ) ? $instance['name'] : '';
		$position = isset( $instance['position'] ) ? $instance['position'] : '';
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title:', 'setwood' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
		</p>
		<div class="wpc-widgets-image-field">
		<label for="<?php echo $this->get_field_id('image'); ?>"><?php esc_html_e( 'Image:', 'setwood' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" type="text" value="<?php echo $image; ?>" />
			<a class="wpc-widgets-image-upload button inline-button" data-target="#<?php echo $this->get_field_id( 'image' ); ?>" data-preview=".wpc-widgets-preview-image" data-frame="select" data-state="wpc_widgets_insert_single" data-fetch="url" data-title="Insert Image" data-button="Insert" data-class="media-frame wpc-widgets-custom-uploader" title="Add Media">Add Media</a>
			<a class="button wpc-widgets-delete-image" data-target="#<?php echo $this->get_field_id( 'image' ); ?>" data-preview=".wpc-widgets-preview-image">Delete</a>
			<div class="wpc-widgets-preview-image"<?php echo $imagestyle; ?>><img src="<?php echo esc_attr($image); ?>" /></div>
		</div>
		<p>
			<label for="<?php echo $this->get_field_id('description'); ?>"><?php esc_html_e('Description:', 'setwood' ); ?></label>
			<textarea class="widefat" rows="4" cols="20" id="<?php echo $this->get_field_id('description'); ?>" name="<?php echo $this->get_field_name('description'); ?>"><?php echo $description; ?></textarea>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('style'); ?>"><?php esc_html_e( 'Select Style:', 'setwood' ); ?></label>
			<select id="<?php echo $this->get_field_id('style'); ?>" name="<?php echo $this->get_field_name('style'); ?>">
				<option value="none"<?php selected( $style, 'none' ); ?>>None</option>';
				<option value="circle"<?php selected( $style, 'circle' ); ?>>Circle</option>';
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('name'); ?>"><?php esc_html_e( 'Name:', 'setwood' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('name'); ?>" name="<?php echo $this->get_field_name('name'); ?>" value="<?php echo $name; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('position'); ?>"><?php esc_html_e( 'Position:', 'setwood' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('position'); ?>" name="<?php echo $this->get_field_name('position'); ?>" value="<?php echo $position; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('url'); ?>"><?php esc_html_e( 'URL:', 'setwood' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('url'); ?>" name="<?php echo $this->get_field_name('url'); ?>" value="<?php echo $url; ?>" />
		</p>
		<div class="wpc-widgets-image-field">
			<label for="<?php echo $this->get_field_id('signature'); ?>"><?php esc_html_e( 'Signature:', 'setwood' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'signature' ); ?>" name="<?php echo $this->get_field_name( 'signature' ); ?>" type="text" value="<?php echo $signature; ?>" />
			<a class="wpc-widgets-image-upload button inline-button" data-target="#<?php echo $this->get_field_id( 'signature' ); ?>" data-preview=".wpc-widgets-preview-image" data-frame="select" data-state="wpc_widgets_insert_single" data-fetch="url" data-title="Insert Image" data-button="Insert" data-class="media-frame wpc-widgets-custom-uploader" title="Add Media">Add Media</a>
			<a class="button wpc-widgets-delete-image" data-target="#<?php echo $this->get_field_id( 'signature' ); ?>" data-preview=".wpc-widgets-preview-image">Delete</a>
			<div class="wpc-widgets-preview-image"<?php echo $imagestyle; ?>><img src="<?php echo esc_attr($signature); ?>" /></div>
		</div>
		<?php
	}
}