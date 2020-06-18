<?	function format_event($id,$headline){ ?>
		<div class="single">
			<<?= $headline ?>><a href="<?= get_the_permalink($id) ?>"><?= get_the_title($id) ?></a></<?= $headline ?>>
			<p>
				Date: <?= tribe_get_start_date($id, false, 'l, F jS, Y'); ?><br />
				<? if(!tribe_event_is_all_day($id)){ ?>
				Time: <?= tribe_get_start_time($id); ?><br />
				<? } ?>
				<? if(tribe_get_venue($id)){ ?>
				<br />
				Location: <?= tribe_get_venue($id); ?>
				<br />
				<? } ?>
				<? if(tribe_get_cost($id)){ ?>
					Cost: <?= tribe_get_formatted_cost($id); ?>
					<br />
				<? } ?>
				<br /><a class="button" href="<?= get_the_permalink($id) ?>">More Information <i class="fa fa-arrow-right"></i></a>
			</p>
		</div>
<? } 
	
	function format_featured_event($id,$image=false,$desc=false){ ?>
		<div class="single">
			<? if($image){ ?>
			<img src="<?= $image ?>" />
			<? } ?>
			<h3><a href="<?= get_the_permalink($id) ?>"><?= get_the_title($id) ?></a></h3>
			<?= $desc; ?>
			<p>
				Date: <?= tribe_get_start_date($id, false, 'l, F jS, Y'); ?><br />
				<? if(!tribe_event_is_all_day($id)){ ?>
				Time: <?= tribe_get_start_time($id); ?>
				<? } ?>
				<? if(tribe_get_venue($id)){ ?>
				<br />
				Location: <?= tribe_get_venue($id); ?>
				<? } ?>
				<? if(tribe_get_cost($id)){ ?>
					<br />
					Cost: <?= tribe_get_formatted_cost($id); ?>
				<? } ?>
			</p>
			<? if(strtotime(tribe_get_end_date($id, true, 'l, F jS, Y h:i:s A', 'UTC')) > strtotime(date("l, F jS, Y h:i:s A"))){ ?>
				<a class="button" href="<?= get_the_permalink($id) ?>">More Information <i class="fa fa-arrow-right"></i></a>
			<? }else{ ?> 
				<a class="expired">This Event has Passed</a>
			<? } ?>		
		</div>
	<? }

add_action( 'pre_get_posts', 'exclude_events_category' );
function exclude_events_category( $query ) {
	if ( ! is_singular( 'tribe_events' ) &&  $query->query_vars['eventDisplay'] == 'month' && !is_tax(TribeEvents::TAXONOMY) || $query->query_vars['eventDisplay'] == 'month' && $query->query_vars['post_type'] == TribeEvents::POSTTYPE && !is_tax(TribeEvents::TAXONOMY) && empty( $query->query_vars['suppress_filters'] ) ) {
	 
	    $query->set( 'tax_query', array(
	 
	        array(
	            'taxonomy' => TribeEvents::TAXONOMY,
	            'field' => 'slug',
	            'terms' => array('main-calendar'),
	            'operator' => 'IN'
	        )
	        )
	    );
	}
	return $query;
}