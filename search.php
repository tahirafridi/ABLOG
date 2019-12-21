<?php get_header(); ?>

<div class="row">
    <div class="col-md-8 mb-4">
        <h1 class="category-heading mb-2">Search results for: <i><?= get_search_query(); ?></i></h1>
        <div class="row">
            <?php if (have_posts()): ?>
                <?php while (have_posts()): ?>
                    <?php the_post(); ?>
                    <div class="col-md-6 mb-4">
                        <div class="post">
                            <?php if (has_post_thumbnail()): ?>
                                <div class="thumbnail">
                                    <a href="<?= get_permalink(get_the_ID()); ?>" rel="bookmark">
                                        <img src="<?= get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>" class="img-fluid" alt="">
                                    </a>
                                </div>
                            <?php endif; ?>
                            <div class="post-details">
                                <div class="title mb-2">
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
                        <?= paginate_links(); ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="col-md-12 mb-4">
                    <p>No posts</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?= get_sidebar(); ?>
</div>

<?php get_footer(); ?>