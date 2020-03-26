<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php wp_head(); ?>
    </head>
    <body>
        <div id="searchform" class="position-fixed w-100 text-center d-none shadow">
            <?php get_search_form(); ?>
        </div>

        <nav class="navbar navbar-light bg-faded mx-auto">
            <a href="javascript:void(0);" class="" data-toggle="collapse" data-target="#bs4navbar" aria-controls="bs4navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="fa fa-bars"></span>
            </a>

            <ul id="logo" class="nav navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="navbar-brand" href="<?php bloginfo('url'); ?>" title="<?php bloginfo('title'); ?>">
                        <strong><?php bloginfo('name'); ?></strong>
                    </a>
                </li>
            </ul>
            
            <ul class="nav navbar-nav">
                <li class="nav-item">
                    <a href="javascript:void(0);" title="Open Search" onclick="$('#searchform').removeClass('d-none'); $('#searchform input').focus();">
                        <i class="fa fa-search"></i>
                    </a>
                </li>
            </ul>

            <?php
            wp_nav_menu([
                'menu'            => 'top',
                'theme_location'  => 'primary',
                'container'       => 'div',
                'container_id'    => 'bs4navbar',
                'container_class' => 'collapse navbar-collapse',
                'menu_id'         => false,
                'menu_class'      => 'navbar-nav mr-auto',
                'depth'           => 2,
                'fallback_cb'     => 'bs4navwalker::fallback',
                'walker'          => new bs4navwalker()
            ]);
            ?>
        </nav>

        <div class="container mt-3">