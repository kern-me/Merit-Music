    <div class="wrap" role="document">
      <div class="content ">
		<?php while (have_posts()) : the_post(); ?>
			<?php get_template_part('templates/content', 'home'); ?>
		<?php endwhile; ?>
      </div><!-- /.content -->
    </div><!-- /.wrap -->
    <? display_testimonials(); ?>