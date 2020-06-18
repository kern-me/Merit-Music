<!--div class="search-module">
	<div class="container">
		<div class="row">
			<h2 class="center"><? the_field("search_headline") ?></h2>
		</div>
	</div>
</div-->
<? if(get_field("news_section")=='true'){ ?>
<div class="news-section">
	<h2 class="maroon"><? the_field("news_section_headline") ?></h2>
	<div class="container">
		<div class="row">
			<? while(have_rows("news_blocks")){ the_row(); ?>
				<? if(get_sub_field("link_to") == 'internal'){
					  $link = 'href="'.get_sub_field("link_internal").'"';
				   }elseif(get_sub_field("link_to") == 'pdf'){
					  $link = 'href="'.get_sub_field("file_upload").'" target="_blank"';
				   }elseif(get_sub_field("link_to") == 'external'){
					   echo '<!-- External Link-->';
					  $link = 'href="'.get_sub_field("link_external").'" target="_blank"';
				} 
				$image = get_sub_field("image");
			?>
			<div class="block col-sm-6 nh">
				<a <?= $link ?>><img class="img-responsive" src="<?= $image['sizes']['news-blocks'] ?>" /></a>
				<h3><? the_sub_field("title") ?></h3>
				<p><? the_sub_field("description") ?></p>
				<a class="button" <?= $link ?>><? the_sub_field("link_text"); ?> <i class="fa fa-arrow-right"></i></a>
			</div>
			<? } ?>
		</div>
		<? if(get_field("display_news_section_button")){ ?>
		<a class="button wide" href="/news"><? the_field("news_link_text"); ?> <i class="fa fa-arrow-right"></i></a>
		<? } ?>
	</div>
</div>
<? } ?>
<? if(get_field("upcoming_events")=='true'){ ?>
<div class="events-section">
	<h2 class="maroon"><? the_field("upcoming_events_headline") ?></h2>
	<div class="container">
		<div class="row clearfix">
		<? 	
		$events = tribe_get_events(
			array(
				'posts_per_page'=>  3, 
				'start_date'	=> 	date('Y-m-d H:i:s')
			)
		);
		if(!empty($events)){
			foreach($events as $k=>$event){ ?>
				<div class="col-md-4 item">
				<? format_event($event->ID,'h3'); ?>
				</div>
		<?	}
		}							
	?>
		</div>
		<a class="button wide" href="/events"><? the_field("events_link_text"); ?> <i class="fa fa-arrow-right"></i></a>
	</div>
</div>
<? } ?>