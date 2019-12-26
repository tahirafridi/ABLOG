<?php

class WidgetPopularPosts extends WP_Widget {
    public function __construct()
    {
        $widget_ops = [
            'classname' => 'custom_widget_popular_posts',
            'description' => 'This is custom widget for showing popular posts',
        ];

        parent::__construct( 'custom_widget_popular_posts', 'Popular Posts', $widget_ops );
    }
    
    // output the widget content on the front-end
    public function widget( $args, $instance )
    {
        echo $args['before_widget'];

        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }

        $popularpost = new WP_Query([
            'post_status'       => 'publish',
            'posts_per_page'    => 5,
            'meta_key'          => 'post_views_count',
            'orderby'           => 'meta_value_num',
            'order'             => 'DESC',
        ]);

        if ($popularpost->have_posts()) { ?>
            <ul class="list-unstyled">
                <?php
                while ($popularpost->have_posts()) {
                    $popularpost->the_post();
                ?>
                    <div class="post">
                        <div class="post-thumbnail mr-2">
                            <a href="<?= get_permalink(get_the_ID()); ?>" rel="bookmark">
                                <?php if (has_post_thumbnail()) { ?>
                                    <img src="<?= the_post_thumbnail_url('big'); ?>" class="img-fluid" alt="">
                                <?php } else { ?>
                                    <img src="https://via.placeholder.com/400x200" class="img-fluid" alt="">
                                <?php } ?>
                            </a>
                        </div>
                        <div class="post-details text-truncate">
                            <a href="<?= get_permalink(get_the_ID()); ?>" rel="bookmark">
                                <strong><?= the_title(); ?></strong>
                            </a><br>
                            <small><?= the_time('M j, Y'); ?></small>
                        </div>
                    </div>
                <?php } ?>
            </ul>
        <?php } else { ?>
            <p>No posts</p>
        <?php }

        echo $args['after_widget'];
    }

    // output the option form field in admin Widgets screen
    public function form( $instance )
    {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Popular Posts', 'text_domain' );
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
    register_widget( 'WidgetPopularPosts' );
});