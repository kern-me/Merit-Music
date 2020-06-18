<?php
/**
 * Single Event Meta Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe-events/modules/meta.php
 *
 * @package TribeEventsCalendar
 */

do_action( 'tribe_events_single_meta_before' );

// Check for skeleton mode (no outer wrappers per section)
$not_skeleton = ! apply_filters( 'tribe_events_single_event_the_meta_skeleton', false, get_the_ID() );

// Do we want to group venue meta separately?
$set_venue_apart = true;
?>



<?php if ( $set_venue_apart ) : ?>
	<?php if ( $not_skeleton ) : ?>
		<div class="tribe-events-single-section tribe-events-event-meta secondary tribe-clearfix">
	<?php endif; ?>
	<?php
	do_action( 'tribe_events_single_event_meta_secondary_section_start' );

	tribe_get_template_part( 'modules/meta/venue' );
	tribe_get_template_part( 'modules/meta/map' );

	do_action( 'tribe_events_single_event_meta_secondary_section_end' );
	?>
	<?php
	if ( $not_skeleton ) : ?>
		</div>
	<?php endif; ?>
<?php
endif;
do_action( 'tribe_events_single_meta_after' );
