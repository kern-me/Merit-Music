<?php use Roots\Sage\Wrapper; ?>
<? if(get_field("news_section")=='true'){ ?>
<div class="news-section">
	<h2 class="maroon"><? the_field("news_section_headline") ?></h2>
	<div class="container">
		<div class="row">
			<? while(have_rows("news_blocks")){ the_row(); ?>
				<? if(get_sub_field("link_to") == 'internal'){
					  $link = get_sub_field("link_internal");
				   }elseif(get_sub_field("link_to") == 'pdf'){
					  $link = get_sub_field("file_upload");
				   }elseif(get_sub_field("link_to" == 'external')){
					  $link = get_sub_field("link_external");
				} 
				$image = get_sub_field("image");
			?>
			<div class="block col-sm-6">
				<a href="<?= $link ?>" target="_blank"><img class="img-responsive" src="<?= $image['sizes']['news-blocks'] ?>" /></a>
				<h3><? the_sub_field("title") ?></h3>
				<p><? the_sub_field("description") ?></p>
				<a class="button" href="<?= $link ?>" target="_blank"><? the_sub_field("link_text"); ?> <i class="fa fa-arrow-right"></i></a>
			</div>
			<? } ?>
		</div>
		<a class="button wide" href="/news"><? the_field("news_link_text"); ?> <i class="fa fa-arrow-right"></i></a>
	</div>
</div>
<? } ?>
<div class="wrap container clearfix">
	<main class="main">
		<? the_field("content"); ?>
	</main><!-- /.main -->
	<aside class="sidebar">
	  <?php include Wrapper\sidebar_path(); ?>
	</aside><!-- /.sidebar -->
</div>
<? if(get_field("upcoming_events")=='true'){ ?>
<div class="events-section">
	<h2 class="maroon"><? the_field("upcoming_events_headline") ?></h2>
	<div class="container">
		<div class="row clearfix">
		<?	if(get_field('events_category')){
			$tax_query = array(
							array(
								'taxonomy' 	=> 'tribe_events_cat',
								'field'		=> 'term_id',
								'terms'		=> get_field('events_category')
							),
						);
		}$events = tribe_get_events(
					array(
						'posts_per_page'=>  3, 
						'start_date'	=> 	date('now'),
						'tax_query' 	=> 	$tax_query
					)
				);
		if($events){
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

