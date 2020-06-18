<div class="wrap container clearfix" role="document">
  <div class="content row">
    <main class="main">
		<?php get_search_form(); ?>
		<?php if (!have_posts()) : ?>
		  <div class="alert alert-warning">
		    <?php _e('Sorry, no results were found.', 'sage'); ?>
		  </div>
		<?php endif; ?>
		
		<?php while (have_posts()) : the_post(); ?>
		  <?php get_template_part('templates/content', 'search'); ?>
		<?php endwhile; ?>
		
		<?php the_posts_navigation(); ?>
    </main>
  </div>
</div>