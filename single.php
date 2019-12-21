<?php get_header(); ?>

<div class="row">
    <div class="col-md-8 mb-4">
        <?php if (have_posts()): ?>
            <?php while (have_posts()): the_post(); setPostViews(get_the_ID()); ?>
                <div class="post">
                    <?php if (has_post_thumbnail()) { ?>
                        <div class="thumbnail">
                            <img src="<?= the_post_thumbnail_url('big'); ?>" class="img-fluid p-0" alt="">
                        </div>
                    <?php } ?>
                    <div class="date text-secondary text-right">
                        <span><?= the_date(); ?> <?= the_time(); ?></span>
                    </div>

                    <div class="author">
                    <?php echo nl2br(get_the_author_meta('nickname')); ?>
                    </div>
                    
                    <div class="title">
                        <h1><?= the_title(); ?></h1>
                    </div>

                    <div class="description mt-2">
                        <?= the_content(); ?>
                    </div>

                    <hr>

                    <div class="footer">
                        <div>
                            <span>Views: </span>
                            <?= getPostViews(get_the_ID()); ?>
                        </div>
                        <div>
                            <span>Category: </span>
                            <?php the_category(' '); ?>
                        </div>
                        <div>
                            <span>Tags: </span>
                            <?php the_tags('', ' '); ?>
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

    <?= get_sidebar(); ?>
</div>

<?php get_footer(); ?>