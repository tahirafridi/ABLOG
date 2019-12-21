<div class="col-md-4 sidebar">
    <div class="row">
        <!-- <div class="col-md-12 mb-4">
            <div class="widget-content">
                <div class="heading mb-2">Recent Posts</div>
                <?php
                $recent_posts = wp_get_recent_posts([
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
                                <small><?= the_time('F j, Y'); ?></small>
                            </div>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <p class="text-danger text-center">No result found.</p>
                <?php } ?>
            </div>
        </div> -->
        <?php dynamic_sidebar('custom_sidebar_id'); ?>
    </div>
</div>