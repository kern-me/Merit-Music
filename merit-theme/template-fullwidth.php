<?php
/**
 * Template Name: Full Width Template
 */
?>

    <div class="wrap" role="document">
      <div class="content ">
	      <div id="tribe-events-pg-template">
			<?php while (have_posts()) : the_post(); ?>
				<?php get_template_part('templates/content', 'page'); ?>
			<?php endwhile; ?>
	      </div>
      </div><!-- /.content -->
    </div><!-- /.wrap -->
