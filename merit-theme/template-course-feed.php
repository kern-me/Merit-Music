<?php use Roots\Sage\Wrapper; ?>
    <div class="wrap container clearfix" role="document">
      <div class="content row">
        <main class="main">
		<?php while (have_posts()) : the_post(); ?>
			<?php get_template_part('templates/content', 'page'); ?>
		<?php endwhile; ?>
        </main><!-- /.main -->
	    <aside class="sidebar">
	      <?php include Wrapper\sidebar_path(); ?>
	    </aside><!-- /.sidebar -->
      </div><!-- /.content -->
    </div><!-- /.wrap -->

<?php
	/* $filter_age = (get_field("filter_age_groups") ? cssSafe(get_field("filter_age_groups")) : "all" );
	$filter_program = (get_field("filter_program_types") ? cssSafe(get_field("filter_program_types")) : "all" );
	$filter_category = (get_field("filter_categories") ? 'category-'.cssSafe(get_field("filter_categories")) : "all" );
	$filter_instrument = (get_field("filter_instruments") ? 'instrument-'.get_field("filter_instruments") : "all" );

	course_feed( array(
	    'course_feed_age'            => (object) array( 'post_name' => $filter_age ),
	    'course_feed_program_type'   => (object) array( 'post_name' => $filter_program ),
	    'course_feed_category_type'  => (object) array( 'post_name' => $filter_category ),
	    'course_feed_instrument'     => (object) array( 'post_name' => $filter_instrument )
	)); */
?>