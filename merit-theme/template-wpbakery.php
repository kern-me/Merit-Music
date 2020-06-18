<?php
/**
 * Template Name: WP Bakery Page Builder Template
 */
?>

	<div id="wp-bakery-pg-template">
		<?php while (have_posts()) : the_post(); ?>
			<?php the_content(); ?>
		<?php endwhile; ?>
	</div>
