<?php use Roots\Sage\Wrapper; ?>
    <div class="wrap container clearfix" role="document">
      <div class="content">
	      <main class="main">
		    <?php query_posts('cat=1'); ?>
			<?php if (!have_posts()) : ?>
			  <div class="alert alert-warning">
			    <?php _e('Sorry, no results were found.', 'sage'); ?>
			  </div>
			  <?php get_search_form(); ?>
			<?php endif; ?>
			
			<?php while (have_posts()) : the_post(); ?>
			  <?php get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
			<?php endwhile; ?>
			
			<?php the_posts_navigation(); ?>
	      </main>
		  <?php wp_reset_query(); ?>
	      <aside class="sidebar">
	     	 <?php include Wrapper\sidebar_path(); ?>
	      </aside>
      </div><!-- /.content -->
    </div><!-- /.wrap -->