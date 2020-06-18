<?
$today = date('Ymd');
$args = array(
	'numberposts'	=> 1,
	'post_type'		=> 'announcement',
	'meta_query'	=> array(
		'relation'		=> 'AND',
		array(
			'key'		=> 'start_date',
			'value'		=> $today,
			'compare'	=> '<='
		),
		array(
			'key'		=> 'expiration',
			'value'		=> $today,
			'compare'	=> '>'
		)
	)
);
$the_query = new WP_Query( $args );
if( $the_query->have_posts() ): ?>
	<?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
	<div id="announcement" class="<? the_field("color"); ?>">
		<p><? the_field("announcement"); ?>
		<? if(get_field("button_link")){ ?>
			<a href="<? the_field("button_link"); ?>"><? the_field("button_text"); ?> &raquo;</a>
		<? } ?>
		</p>
		<!--a class="close">x</a-->
		<script>
			$("body").addClass("haveAnnouncement");
		</script>
	</div>
	<? endwhile; ?>
<? endif; ?>
<? wp_reset_query(); ?>