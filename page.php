<?php get_header(); ?>

<div class="row">
    <div class="col-md-8 mb-4">
        <div class="page">
            <?php if (have_posts()): ?>
                <?php while (have_posts()): the_post(); ?>
                    <div class="col-md-12 mb-4">
                        <h1 class="mb-2"><?= the_title(); ?></h1>
                        <div class="description">
                            <?= the_content(); ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No posts</p>
            <?php endif; ?>
        </div>
    </div>

    <?= get_sidebar(); ?>
</div>

<?php get_footer(); ?>