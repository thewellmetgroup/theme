<header class="banner">
  <div class="container">
    <div class="row">
        <div class="col-md-4">
            <a class="brand" href="<?= esc_url(home_url('/')); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/dist/images/wellmet-logo.png" alt="<?php bloginfo('name'); ?>" width="250" height="250">
            </a>
        </div>
        <div class="col-md-8">
            <nav class="nav-primary">
              <?php
              if (has_nav_menu('primary_navigation')) :
                wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']);
              endif;
              ?>
            </nav>
            <div class="mission">
                <?php echo get_bloginfo('description'); ?>
            </div>
        </div>
    </div>
  </div>
</header>
