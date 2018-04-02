<?php
/**
 * Post Widget
 */

class Setwood_Posts_Widget extends WP_Widget {

	var $defaults;

	function __construct() {
		$widget_ops = array( 'classname' => 'setwood_posts_widget', 'description' => esc_html__( 'Display your posts with this widget', 'setwood' ) );
		$control_ops = array( 'id_base' => 'setwood_posts_widget' );
        parent::__construct( 'setwood_posts_widget',$name= esc_html__( 'Setwood: Posts', 'setwood' ), $widget_ops, $control_ops );

		$this->defaults = array(
			'title' => esc_html__( 'Posts', 'setwood' ),
			'style' => 'slider',
			'numposts' => 5,
			'image_size' => 'post-thumbnail',
			'category' => array(),
			'orderby' => 0,
			'date_limit' => 0,
			'auto_detect' => 0,
			'meta' => array( 'date'),
			'manual' => array()
		);
	}


	function widget( $args, $instance ) {
		extract( $args );
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		echo $before_widget;

		$title = apply_filters( 'widget_title', $instance['title'] );

		if ( !empty( $title ) ) {
			echo $before_title . $title . $after_title;
		}

		$q_args = array(
			'post_type'=> 'post',
			'posts_per_page' => $instance['numposts'],
			'ignore_sticky_posts' => 1,
			'orderby' => $instance['orderby']
		);


		if ( !empty( $instance['manual'] ) && !empty( $instance['manual'][0] ) ) {
			$q_args['posts_per_page'] = absint( count( $instance['manual'] ) );
			$q_args['orderby'] =  'post__in';
			$q_args['post__in'] =  $instance['manual'];
			$q_args['post_type'] = array_keys( get_post_types( array( 'public' => true ) ) ); //support all existing public post types

		} else {

			if ( !empty( $instance['auto_detect'] ) && is_single() ) {

				$cats = get_the_category();

				if ( !empty( $cats ) ) {
					foreach ( $cats as $k => $cat ) {
						$q_args['category__in'][] = $cat->term_id;
					}
				}

			} else {

				if ( !empty( $instance['category'] ) ) {
					$q_args['category__in'] = (array)$instance['category'];
				}
			}

			if ( $instance['orderby'] == 'views' && function_exists( 'the_views' ) ) {
				$q_args['orderby'] = 'meta_value_num';
				$q_args['meta_key'] = 'views';
			}


			if ( !empty( $instance['date_limit'] ) ) {
				$q_args['date_query'] = array(
					'after' => date( 'Y-m-d', strtotime( $instance['date_limit'] ) )
				);
			}
		}

		$setwood_posts = new WP_Query( $q_args );

		if ( $setwood_posts->have_posts() ): ?>
		<div class="post-widget-<?php echo $instance['style'];?>">
	    <div class="post-<?php echo $instance['style'];?>">
	        <?php while ( $setwood_posts->have_posts() ) : $setwood_posts->the_post(); ?>
				<?php include( locate_template( 'inc/widgets/posts-templates/content-'.$instance['style'].'.php' ) ); ?>
	        <?php endwhile; ?>
		</div>
		</div>
    <?php endif; ?>

        <?php wp_reset_postdata(); ?>

            <?php
		echo $after_widget;
	}


	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['orderby'] = $new_instance['orderby'];
		$instance['category'] = $new_instance['category'];
		$instance['numposts'] = absint( $new_instance['numposts'] );
		$instance['style'] = $new_instance['style'];
		$instance['image_size']	= $new_instance['image_size'];
		$instance['date_limit'] = $new_instance['date_limit'];
		$instance['auto_detect'] = isset( $new_instance['auto_detect'] ) ? 1 : 0;
		$instance['meta'] = !empty($new_instance['meta']) ? $new_instance['meta'] : array();
		$instance['manual'] = !empty( $new_instance['manual'] ) ? explode( ",", $new_instance['manual'] ) : array();

		return $instance;
	}

	function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, $this->defaults ); ?>

                <p>
                    <label for="<?php echo $this->get_field_id( 'title' ); ?>">
                        <?php esc_html_e( 'Title', 'setwood' ); ?>:</label>
                    <input id="<?php echo $this->get_field_id( 'title' ); ?>" type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" />
                </p>

                <p>
	  				<?php $this->widget_style( $this, $instance['style'] ); ?>
				</p>

				<p>
					<?php $this->widget_image_size( $this, $instance['image_size'] ); ?>
				</p>

                <p>
                    <label for="<?php echo $this->get_field_id( 'numposts' ); ?>">
                        <?php esc_html_e( 'Number of posts to show', 'setwood' ); ?>:</label>
                    <input id="<?php echo $this->get_field_id( 'numposts' ); ?>" type="text" name="<?php echo $this->get_field_name( 'numposts' ); ?>" value="<?php echo absint( $instance['numposts'] ); ?>" class="small-text" />
                </p>

                <p>
                    <?php $this->widget_tax( $this, 'category', $instance['category'] ); ?>
                </p>

                <p>
                    <input id="<?php echo $this->get_field_id( 'auto_detect' ); ?>" type="checkbox" name="<?php echo $this->get_field_name( 'auto_detect' ); ?>" value="1" <?php checked( 1, $instance[ 'auto_detect'] ); ?>/>
                    <label for="<?php echo $this->get_field_id( 'auto_detect' ); ?>">
                        <?php esc_html_e( 'Auto detect category', 'setwood' ); ?>
                    </label>
                    <small class="howto"><?php esc_html_e( 'If sidebar is used on single post template, display posts from current post category ', 'setwood' ); ?></small>
                </p>

                <p>
                    <?php $this->widget_orderby( $this, $instance['orderby'] ); ?>
                </p>

                <p>
                    <label for="<?php echo $this->get_field_id( 'date_limit' ); ?>">
                        <?php esc_html_e( 'Only select posts which are not older than', 'setwood' ); ?>:</label>
                    <select id="<?php echo $this->get_field_id( 'date_limit' ); ?>" type="text" name="<?php echo $this->get_field_name( 'date_limit' ); ?>" class="widefat">
                        <?php $dates = $this->dates_q(); ?>
                            <?php foreach ( $dates as $key => $value ): ?>
                                <option value="<?php echo esc_attr($key); ?>" <?php selected( $instance[ 'date_limit'], $key, true ); ?>>
                                    <?php echo $value;?>
                                </option>
                                <?php endforeach; ?>
                    </select>
                </p>

                <p>
                    <label for="<?php echo $this->get_field_id( 'manual' ); ?>">
                        <?php esc_html_e( 'Choose manually', 'setwood' ); ?>:</label>
                    <input id="<?php echo $this->get_field_id( 'manual' ); ?>" type="text" name="<?php echo $this->get_field_name( 'manual' ); ?>" value="<?php echo esc_attr(implode( " , ", $instance['manual'] )); ?>" class="widefat" />
                    <small class="howto"><?php esc_html_e( 'Specify post ids separated by comma if you want to select only those posts. i.e. 213,32,12,45 Note: you can also choose pages as well as custom post types', 'setwood' ); ?></small>
                </p>

                <p>
                    <?php $this->widget_meta( $this, $instance['meta'] ); ?>
                </p>



                <?php
	}

	function dates_q() {
		$dates = array(
			'-1 day' => esc_html__( '1 Day', 'setwood' ),
			'-1 week' => esc_html__( '1 Week', 'setwood' ),
			'-1 month' => esc_html__( '1 Month', 'setwood' ),
			'-3 months' => esc_html__( '3 Months', 'setwood' ),
			'-6 months' => esc_html__( '6 Months', 'setwood' ),
			'-1 year' => esc_html__( '1 Year', 'setwood' ),
			'0' => esc_html__( 'Select all posts', 'setwood' )
		);

		return $dates;
	}

	function widget_orderby( $widget_instance = false, $orderby = false ) {

		$orders['date'] = esc_html__( 'Published date', 'setwood' );
		$orders['comment_count'] = esc_html__( 'Number of comments', 'setwood' );
		$orders['rand'] = esc_html__( 'Random', 'setwood' );
		$orders['views'] = esc_html__( 'Views', 'setwood' );

		if ( !empty( $widget_instance ) ) { ?>
                    <label for="<?php echo $widget_instance->get_field_id( 'orderby' ); ?>">
                        <?php esc_html_e( 'Order by:', 'setwood' ); ?>
                    </label>
                    <select id="<?php echo $widget_instance->get_field_id( 'orderby' ); ?>" name="<?php echo $widget_instance->get_field_name( 'orderby' ); ?>" class="widefat">
                        <?php foreach ( $orders as $key => $order ) { ?>
                            <option value="<?php echo $key; ?>" <?php selected( $orderby, $key );?>>
                                <?php echo $order; ?>
                            </option>
                            <?php } ?>
                    </select>
                    <?php }
	}

	function widget_tax( $widget_instance, $taxonomy, $selected_taxonomy = false ) {
		if ( !empty( $widget_instance ) && !empty( $taxonomy ) ) {
			$categories = get_terms( $taxonomy, 'orderby=name&hide_empty=0' );
?>
            <label for="<?php echo $widget_instance->get_field_id( 'category' ); ?>">
                <?php esc_html_e( 'Choose from:', 'setwood' ); ?>
            </label>
                        <br/>
                        <?php foreach ( $categories as $category ) { ?>
                            <input type="checkbox" name="<?php echo $widget_instance->get_field_name( 'category' ); ?>[]" value="<?php echo $category->term_id; ?>" <?php echo in_array( $category->term_id, (array)$selected_taxonomy ) ? 'checked': ''?> />
                            <?php echo $category->name; ?>
                                <br/>
                                <?php } ?>
                                    <?php }
	}

	function widget_style( $widget_instance = false, $current = false ) {

		$styles = array(
			'list' => esc_html__( 'List', 'setwood' ),
			'slider' => esc_html__( 'Slider', 'setwood' ),
		);

		if ( !empty( $widget_instance ) ) { ?>
				<label for="<?php echo esc_attr($widget_instance->get_field_id( 'style' )); ?>"><?php esc_html_e( 'Widget style:', 'setwood' ); ?></label>
				<select id="<?php echo esc_attr($widget_instance->get_field_id( 'style' )); ?>" name="<?php echo esc_attr($widget_instance->get_field_name( 'style' )); ?>" class="widefat">
					<?php foreach ( $styles as $id => $title ) { ?>
						<option value="<?php echo esc_attr($id); ?>" <?php selected( $current, $id );?>><?php echo $title; ?></option>
					<?php } ?>
				</select>
		<?php }
	}

	function widget_image_size ($widget_instance = false, $current = false) {
		$image_sizes = get_intermediate_image_sizes();
		if ( ! empty( $widget_instance ) ) { ?>
			<label for="<?php echo esc_attr( $widget_instance->get_field_id( 'image_size' )); ?>"><?php esc_html_e( 'Image Size:', 'heset' ); ?></label>
			<select id="<?php echo esc_attr( $widget_instance->get_field_id( 'image_size' )); ?>" name="<?php echo esc_attr( $widget_instance->get_field_name( 'image_size' )); ?>" class="widefat">
				<?php foreach ( $image_sizes as $id => $title ) { ?>
					<option value="<?php echo esc_attr( $title ); ?>" <?php selected( $current, $title );?>><?php echo esc_html( $title ); ?></option>
				<?php } ?>
			</select>
		<?php
		}
	}


	function widget_meta( $widget_instance = false, $current = false ) {

		$meta = setwood_get_meta_opts();

		if ( !empty( $widget_instance ) ) : ?>
				<label for="<?php echo esc_attr($widget_instance->get_field_id( 'meta' )); ?>"><?php esc_html_e( 'Display meta data:', 'setwood' ); ?></label><br/>
				<?php foreach ( $meta as $id => $title ) : ?>
				<?php $checked = in_array($id, $current ) ? 'checked="checked"' : ''; ?>
				<input type="checkbox" id="<?php echo esc_attr($widget_instance->get_field_id( 'meta' )); ?>" name="<?php echo esc_attr($widget_instance->get_field_name( 'meta' )); ?>[]" value="<?php echo esc_attr($id); ?>" <?php echo $checked; ?>> <?php echo $title; ?><br/>
				<?php endforeach; ?>
		<?php endif; ?>
            <?php }


}

function macrodreams_post_widget_init() {
	register_widget('Setwood_Posts_Widget');
}
add_action('widgets_init', 'macrodreams_post_widget_init');

?>
