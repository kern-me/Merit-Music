<?php use Roots\Sage\Wrapper; ?>
    <div class="wrap container clearfix" role="document">
      <div class="content row">
        <main class="main">
		<?php while (have_posts()) : the_post(); ?>
			<?php get_template_part('templates/content-single', get_post_type()); ?>
		<?php endwhile; ?>
        </main><!-- /.main -->
	    <aside class="sidebar">
	      <?php include Wrapper\sidebar_path(); ?>
	    </aside><!-- /.sidebar -->
      </div><!-- /.content -->
    </div><!-- /.wrap -->
	<? display_testimonials(); ?>