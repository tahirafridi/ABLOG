<?php get_header(); ?>

<?php $page = (get_query_var('page')) ? get_query_var('page') : 1; ?>

<?php if ($page == 1): ?>
    <div class="row">
        <?php
        $args = [
            'post_type'         => 'post',
            'posts_per_page'    => 2,
            'meta_query'        => [
                [
                    'key'   => 'is_featured_post',
                    'value' => 1
                ]
            ]
        ];
        
        $featured_posts = new WP_Query($args);
        ?>

        <?php if ($featured_posts->have_posts()): ?>
            <?php while ($featured_posts->have_posts()): $featured_posts->the_post(); ?>
                <div class="col-md-6 mb-4">
                    <div class="post bg-white">
                        <?php if (has_post_thumbnail()): ?>
                            <div class="thumbnail">
                                <a href="<?= get_permalink(get_the_ID()); ?>" rel="bookmark">
                                    <img src="<?= get_the_post_thumbnail_url(get_the_ID(), 'big'); ?>" class="img-fluid" alt="<?= the_title(); ?>">
                                </a>
                            </div>
                        <?php endif; ?>
                        <div class="post-details text-center">
                            <div class="title my-2">
                                <h2 class="text-truncate">
                                    <a href="<?= get_permalink(get_the_ID()); ?>" title="<?= the_title(); ?>" rel="bookmark">
                                        <?= the_title(); ?>
                                    </a>
                                </h2>
                            </div>
                            <div class="description">
                                <?= wp_trim_words(get_the_content(), 15); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-md-12 mb-4">
                <p>No posts</p>
            </div>
        <?php endif; ?>
    </div>

    <hr>
<?php endif; ?>

<div class="row">
    <div class="col-md-8 mb-4">
        <div class="row">
            <?php
            $args = [
                'post_type'         => 'post',
                'posts_per_page'    => 10,
                'paged'             => $page,
                'meta_query'        => [
                    [
                        'key'       => 'is_featured_post',
                        'value'     => 1,
                        'compare'   => 'NOT EXISTS'
                    ]
                ]
            ];
            
            $posts = new WP_Query($args);
            ?>

            <?php if ($posts->have_posts()): ?>
                <?php while ($posts->have_posts()): $posts->the_post(); ?>
                    <div class="col-md-6 mb-4">
                        <div class="post bg-white">
                            <?php if (has_post_thumbnail()): ?>
                                <div class="thumbnail">
                                    <a href="<?= get_permalink(get_the_ID()); ?>" rel="bookmark">
                                        <img src="<?= get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>" class="img-fluid p-0" alt="<?= the_title(); ?>">
                                    </a>
                                </div>
                            <?php endif; ?>
                            <div class="post-details">
                                <div class="title my-2">
                                    <h2>
                                        <a href="<?= get_permalink(get_the_ID()); ?>" rel="bookmark">
                                            <?= wp_trim_words(get_the_title(), 4); ?>
                                        </a>
                                    </h2>
                                </div>
                                <div class="description">
                                    <?= wp_trim_words(get_the_content(), 10); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>

                <div class="col-md-12 mb-4">
                    <hr>
                    <div class="pagination justify-content-center">
                        <?= paginate_links([
                            'total'     => $posts->max_num_pages,
                            'current'   => max(1, get_query_var('page')),
                        ]); ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="col-md-12 mb-4">
                    <p>No posts</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>