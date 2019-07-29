<?php

	function content_blocks(){
		$blocks = get_fields();
		
		if(!empty($blocks['content_blocks'])){
			foreach($blocks['content_blocks'] as $k=>$v){		
				switch($v['acf_fc_layout']){
					
					case "content":
						echo $v['content'];
					break;
					case "time-content":
						$today = date(Ymd);
						if($v['start_date'] <= $today && $today < $v['expires']){
							echo $v['content'];
						}elseif($today < $v['start_date']){
							echo $v['early_notice'];
						}
					break;
					case "event":
						switch($v['event_type']){
							case "upcoming": ?>
								<div class="events upcoming">
								<? if(!empty($v['event_category'])){
									$tax_query = array(
													array(
														'taxonomy' 	=> 'tribe_events_cat',
														'field'		=> 'term_id',
														'terms'		=> $v['event_category']
													),
												);
								}
								$events = tribe_get_events(
									array(
										'posts_per_page'=> 	$v['number_of_events'], 
										'start_date'	=> 	date('Y-m-d H:i:s'),
										'tax_query' 	=> 	$tax_query
									)
								);
								foreach($events as $event){ ?>
									<?= format_featured_event($event->ID); ?>
								<? } ?>	
								</div>			
						 <?	break;
							case "specific": ?>
								<div class="events specific">
									<? if($v['auto_hide'][0] == 'true'){
										$events = tribe_get_events(array('post__in'=>$v['event_to_display'], 'start_date'=>date('Y-m-d H:i:s')));
									}else{
										$events = tribe_get_events(array('post__in'=>$v['event_to_display']));
									}
									if(!empty($events)){
										format_featured_event($events[0]->ID, $v['event_image'], $v['event_description']);
									} ?>
								</div>
						 <?	break;
							case "custom": ?>
								<div class="events custom">
									<div class="single">
										<img src="<?= $v['event_image'] ?>" />
										<h3><?= $v['event_title'] ?></h3>
										<?= $v['event_description']; ?>
										<a class="button" href="<?= $v['link'] ?>"><?= $v['link_text'] ?> <i class="fa fa-arrow-right"></i></a>
									</div>
								</div>
						 <? break;
						}
					break;
					case "embed_code": ?>
						<div class="code">
							<?= $v['code']; ?>
						</div>
				 <? break;
					case "accordion":
						echo '<div class="accordion">'."\n";
						foreach($v['accordion'] as $k=>$item){
							echo '<h3><a href="#">'.$item['title'].'</a></h3>'."\n";
							echo '<div class="expand">'."\n";
							echo $item['content'];
							echo '</div>'."\n";
						}
						echo '</div>'."\n";
					break; 
				}
			}
		}
	}
	
	function display_testimonials(){
		 $display_testimonials = get_field("display_testimonial"); 
		 if($display_testimonials[0] == 'true' && have_rows("testimonials","option")){ ?>
		 <div class="testimonials">
		 	<div class="container">
			<? $testimonials = get_field("testimonials","option");
			   $rand = $testimonials[array_rand($testimonials)]; ?>
				<div class="image row" style="background-image:url(<?= $rand['image'] ?>)">
				   <div class="item col-md-7 col-sm-5">
						<h3><?= $rand["title"] ?></h3>
						<p><?= $rand["testimonial"] ?></p>
						<a class="button" href="<?= $rand["link"] ?>"><?= $rand["link_text"] ?> 
							<i class="fa fa-arrow-right"></i>
						</a>
				   </div>		
				</div>
			</div>
		</div>
	<? }
	} 
?>