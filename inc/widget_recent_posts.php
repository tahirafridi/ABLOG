<?php

class WidgetRecentPosts extends WP_Widget {
    public function __construct()
    {
        $widget_ops = [
            'classname' => 'custom_widget_recent_posts',
            'description' => 'This is custom widget for showing recent posts',
        ];

        parent::__construct( 'custom_widget_recent_posts', 'Recent Posts', $widget_ops );
    }
    
    // output the widget content on the front-end
    public function widget( $args, $instance )
    {
        echo $args['before_widget'];

        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }

        $recent_posts = wp_get_recent_posts([
            'post_status' => 'publish',
            'numberposts' => 5,
        ], 'OBJECT');

        if ($recent_posts) {
            foreach ($recent_posts as $recent) {
                $image = "https://via.placeholder.com/400x200";
                if (has_post_thumbnail( $recent->ID )) {
                    $image = get_the_post_thumbnail_url($recent->ID, 'small');
                }
            ?>
                <div class="post">
                    <div class="post-thumbnail mr-2">
                        <a href="<?= get_permalink($recent->ID); ?>" rel="bookmark">
                            <img src="<?= $image; ?>" class="img-fluid" alt="">
                        </a>
                    </div>
                    <div class="post-details text-truncate">
                        <a href="<?= get_permalink($recent->ID); ?>" rel="bookmark">
                            <strong><?= $recent->post_title ?></strong>
                        </a><br>
                        <small><?= the_time('M j, Y'); ?></small>
                    </div>
                </div>
            <?php } ?>
        <?php } else { ?>
            <p>No posts</p>
        <?php }

        echo $args['after_widget'];
    }

    // output the option form field in admin Widgets screen
    public function form( $instance )
    {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Recent Posts', 'text_domain' );
        $html = '
            <p>
                <label for="'.esc_attr( $this->get_field_id( 'title' ) ).'">'.esc_attr_e( 'Title:', 'text_domain' ).'</lable>
                <input class="widefat" id="'.esc_attr( $this->get_field_id( 'title' ) ).'" name="'.esc_attr( $this->get_field_name( 'title' ) ).'" type="text" value="'.esc_attr( $title ).'">
            </p>
        ';
        echo $html;
    }

    // save options
    public function update( $new_instance, $old_instance )
    {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
            
        $selected_posts = ( ! empty ( $new_instance['selected_posts'] ) ) ? (array) $new_instance['selected_posts'] : array();
        $instance['selected_posts'] = array_map( 'sanitize_text_field', $selected_posts );

        return $instance;
    }
}

add_action( 'widgets_init', function(){
    register_widget( 'WidgetRecentPosts' );
});