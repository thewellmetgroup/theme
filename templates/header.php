<header class="banner">
  <div class="container">
    <div class="row">
        <div class="col-sm-4">
            <a class="brand" href="<?= esc_url(home_url('/')); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/dist/images/wellmet-logo.png" alt="<?php bloginfo('name'); ?>" width="250" height="250">
            </a>
        </div>
        <div class="col-sm-8">
            <nav class="navbar nav-primary" role="navigation">
              <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#wellmet-navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  
                </div>
            
                    <?php
                        wp_nav_menu( array(
                            'menu'              => 'primary_navigation',
                            'theme_location'    => 'primary_navigation',
                            'depth'             => 2,
                            'container'         => 'div',
                            'container_class'   => 'collapse navbar-collapse',
                    		'container_id'      => 'wellmet-navbar',
                            'menu_class'        => 'nav navbar-nav',
                            'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                            'walker'            => new wp_bootstrap_navwalker())
                        );
                    ?>
                </div>
            </nav>
            
            
            
           
            <div class="mission">
                <?php echo get_bloginfo('description'); ?>
            </div>
        </div>
    </div>
  </div>
</header>
