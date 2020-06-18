<?php
/**
 * Month View Template
 * The wrapper template for month view.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

do_action( 'tribe_events_before_template' );

// Tribe Bar
tribe_get_template_part( 'modules/bar' );

// Main Events Content
tribe_get_template_part( 'month/content' );

do_action( 'tribe_events_after_template' );

$today = date('Ymd');
$args = array(
	'numberposts'	=> 2,
	'post_type'		=> 'tribe_events',
	'meta_query'	=> array(
		'relation'		=> 'AND',
		array(
			'key'		=> 'feature_event',
			'value'		=> '"yes"',
			'compare'	=> 'LIKE'
		),
		array(
			'key'		=> 'from',
			'value'		=> $today,
			'compare'	=> '<='
		),
		array(
			'key'		=> 'to',
			'value'		=> $today,
			'compare'	=> '>='
		)
	)
);

$featured_events = new WP_Query( $args );

if($featured_events->have_posts()): ?>
<div id="featured_events">
	<h2>Featured Events</h2>
	<div class="row">
<?	while($featured_events->have_posts()) : $featured_events->the_post(); ?>
		<div class="event col-sm-6">
			<a href="<? the_permalink(); ?>"><? the_post_thumbnail('news-blocks'); ?></a>
			<h3><a href="<? the_permalink(); ?>"><? the_title(); ?></a></h3>
			<div class="content"><? the_excerpt(); ?></div>
			<a class="button" href="<? the_permalink();?>">Learn More <i class="fa fa-arrow-right"></i></a>
		</div>	
				
<?	endwhile; ?>
	</div>
</div>
<? endif; ?>