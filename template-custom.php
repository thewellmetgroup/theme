<?php
/**
 * Template Name: Full Width Template
 */
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <?php get_template_part('templates/content', 'page-fullwidth'); ?>
<?php endwhile; ?>
