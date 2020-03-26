<?php
// Remove junk files from header
// require get_parent_theme_file_path( '/inc/wp_remove_junk_files.php' );

function add_custom_styles () 
{
    wp_enqueue_style( 'maincss', get_template_directory_uri() . '/css/maincss.css', array(), '1.0.0', 'all' );
}
add_action('wp_enqueue_scripts', 'add_custom_styles');

function add_custom_scripts () 
{   
    wp_deregister_script( 'jquery' );
    wp_enqueue_script( 'JQuerySlim', 'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', array(), '3.3.1', false );
    wp_enqueue_script( 'PopperJs', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js', array(), '1.14.7', true );
    wp_enqueue_script( 'BootstrapJS', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', array(), '4.3.1', true );
    wp_enqueue_script( 'mainjs', get_template_directory_uri() . '/js/mainjs.js', array(), '1.0.0', true );

    // This code create javascript variables so it will be acecessable in mainjs file
    $script_vars = array( 'template_url' => get_template_directory_uri() , 'base_url' => esc_url( home_url( '/' )) );
    wp_localize_script( 'mainjs', 'script_vars', $script_vars );
}
add_action('wp_enqueue_scripts', 'add_custom_scripts');

function add_custom_theme_support ()
{
    add_theme_support('menus');
    register_nav_menu('primary', 'Primary Header Navigation');

    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
}
add_action('init', 'add_custom_theme_support');

/*function custom_title()
{
    $title = wp_title('') . " &#8211; " . get_bloginfo('description');

    if (is_front_page() || is_home()) {
        $title = get_bloginfo('name') . " &#8211; " . get_bloginfo('description');
    }

    return $title;
}*/

function register_my_session()
{
    if (!session_id()) {
        session_start();
    }
}
add_action('init', 'register_my_session');

function register_bs4navwalker(){
	require_once get_template_directory() . '/inc/bs4navwalker.php';
}
add_action( 'after_setup_theme', 'register_bs4navwalker' );

add_image_size('big', 800, 400, true);
add_image_size('medium', 400, 200, true);
add_image_size('small', 300, 150, true);
add_image_size('extra_small', 200, 100, true);
add_image_size('social', 600, 315, true);

function custom_sidebar()
{
    register_sidebar(
        [
            'name' => __( 'Custom Sidebar', 'eguidepk' ),
            'id' => 'custom_sidebar_id',
            'description' => __( '', 'eguidepk' ),
            'before_widget' => '<div class="col-md-12 mb-4"><div class="widget-content">',
            'after_widget' => "</div></div>",
            'before_title' => '<div class="heading mb-2">',
            'after_title' => '</div>',
        ]
    );
}
add_action( 'widgets_init', 'custom_sidebar' );
require get_parent_theme_file_path( '/inc/widget_recent_posts.php' );
require get_parent_theme_file_path( '/inc/widget_popular_posts.php' );

function wpb_change_search_url()
{
    if (is_search() && !empty($_GET['s'])) {
        wp_redirect(home_url("/search/") . urlencode(get_query_var('s')));
    }   
}
add_action( 'template_redirect', 'wpb_change_search_url' );

function getPostViews($postID)
{
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);

    if ($count == '') {
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, 0);
        return "0 views";
    }

    return $count > 1 || $count == 0 ? $count . ' views' : $count . ' view';
}

function setPostViews($postID)
{
    if (isset($_SESSION['post_views_count_'.$postID]) && $_SESSION['post_views_count_'.$postID]) {
        return true;
    }

    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, 0);
    } else {
        $count++;
        $_SESSION['post_views_count_'.$postID] = true;
        update_post_meta($postID, $count_key, $count);
    }
}

// Custom Admin (CMS) Functionalities
require get_parent_theme_file_path( '/functions_admin.php' );

// add_filter('redirect_canonical','pif_disable_redirect_canonical');
// function pif_disable_redirect_canonical($redirect_url) {
//     if (is_singular()) $redirect_url = false;
// return $redirect_url;
// }