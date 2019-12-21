<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php wp_head(); ?>
    </head>
    <body>
        <div id="sidebarNav" class="sidebarNav">
            <div class="text-center text-secondary mb-5">
                <strong><?php bloginfo('name'); ?></strong>
            </div>
            <?php
            wp_nav_menu([
                'theme_location'  => 'primary',
                'depth'           => 2, // 1 = no dropdowns, 2 = with dropdowns.
                'container'       => 'div',
                'container_class' => '',
                'container_id'    => '',
                'menu_class'      => 'navbar-nav mr-auto',
                'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
                'walker'          => new WP_Bootstrap_Navwalker(),
            ]);
            ?>
        </div>
    
        <div id="searchform" class="position-fixed w-100 text-center d-none">
            <?php get_search_form(); ?>
        </div>

        <nav class="navbar sticky-top mx-auto">
            <a href="javascript:void(0);" class="sidebartoggler">
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
                    <a class="text-muted" href="javascript:void(0);" title="Open Search" onclick="$('#searchform').removeClass('d-none'); $('#searchform input').focus();">
                        <i class="fa fa-search"></i>
                    </a>
                </li>
            </ul>
        </nav>

        <div class="container mt-3">
            <div class="row d-none d-sm-block">
                <div class="col-md-12">
                    <div class="main-nav-menu">
                        <?php
                        wp_nav_menu([
                            'theme_location'  => 'primary',
                            'depth'           => 2, // 1 = no dropdowns, 2 = with dropdowns.
                            'container'       => 'div',
                            'container_class' => '',
                            'container_id'    => '',
                            'menu_class'      => 'navbar-nav mr-auto',
                            'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
                            'walker'          => new WP_Bootstrap_Navwalker(),
                        ]);
                        ?>
                    </div>
                </div>
            </div>