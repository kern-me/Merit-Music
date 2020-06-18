<?php
	
	function get_widget_ids(){
		if(is_home()){
			$page_for_posts = get_option( 'page_for_posts' );
			$widget_ids = get_fields($page_for_posts);
		}else{
			$widget_ids = get_fields();
		}
		return $widget_ids['widgets'];
	}
	function display_widgets(){
		$widgets = get_widget_ids();
		if(!empty($widgets)){
			foreach($widgets as $k=>$id){
				$widget_content = get_fields($id);
				$widget_type = $widget_content['widget_type'];
				echo format_widget($widget_type, $widget_content);
			}
		}else{
			return false;
		}
	}
	function format_widget($type, $content){
		switch($type){
			case 'links': ?>
				<div class="widget related_links <?= $content['background_color']; ?>">
					<h3><?= $content['title']; ?></h3>
					<ul>
					<? 
					foreach($content['links'] as $k=>$link){
						if($link['link_type'] == 'internal'){
							echo '<li><a href="'.$link['link_internal'].'">';
						}elseif($link['link_type'] == 'external'){
							echo '<li><a target="_blank" href="'.$link['link_external'].'">';
						}elseif($link['link_type'] == 'pdf'){
							echo '<li><a target="_blank" href="'.$link['file_upload'].'">';
						}
						echo $link['link_text'].'</a></li>';
					}
					?>	
					</ul>
				</div>
		<?	break;
			case 'content': ?>
				<div class="widget related_links <?= $content['background_color']; ?>">
					<?= $content['content']; ?>
					<? if($content['button_link']){ ?>
						<a target="_blank" class="button" href="<?= $content['button_link']; ?>"><?= (!empty($content['content_button_text']) ? $content['content_button_text'] : $content['button_link']); ?> <i class="fa fa-arrow-right"></i></a>
					<? } ?>
				</div>
		<?	break;
			// Events Widget(s) require Plugin: The Events Calendar by Tribe
			case 'events': ?>
					<? switch($content['events_to_display']){
						case 'upcoming':
							$event_count = $content['event_count'];
							if(!empty($content['event_category'])){
								$tax_query = array(
												array(
													'taxonomy' 	=> 'tribe_events_cat',
													'field'		=> 'term_id',
													'terms'		=> $content['event_category']
												),
											);
							}
							$events = tribe_get_events(
								array(
									'posts_per_page'=> 	$event_count, 
									'start_date'	=> 	date('Y-m-d H:i:s'),
									'tax_query' 	=> 	$tax_query
								)
							);
							if(!empty($events)){ ?>
								<div class="widget events">
									<h3><?= $content['title']; ?></h3>
									<? foreach($events as $k=>$event){
										format_event($event->ID, 'h4');
									 } ?>
								</div>
						<?	}
						break;
						case 'specific':
							if($content['auto_hide'][0] == 'true'){
								$events = tribe_get_events(array('post__in'=>$content['event_ids'], 'start_date'=>date('Y-m-d H:i:s')));
							}else{
								$events = tribe_get_events(array('post__in'=>$content['event_ids']));
							}
							if(!empty($events)){ ?>
								<div class="widget events">
									<h3><?= $content['title']; ?></h3>
									<? foreach($events as $k=>$event){ 
										  format_event($event->ID, 'h4');
									} ?>
								</div>
							<? }
						break;
					} ?>
		<?	break;
			case 'advertisement': ?>
				<div class="widget image" style="background-image:url(<?= $content['ad_image']; ?>);">
					<a href="<?= $content['link'];?>" style="top:<?= $content['button_position']; ?>%">
						<?= $content['button_text']; ?>
						<i class="fa fa-arrow-right"></i>
					</a>
				</div>
		<?	break;
		}
	}
?>