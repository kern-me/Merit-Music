<?php
	$img = get_field("banner_image");
	if(!empty($img)){ 
	?>	<div id="masthead" class="home programs" style="background-image:url(<?= $img ?>);">
			<div class="content">
				<? the_field("banner_content"); ?>
			</div>
		</div>
	<? }
	if(have_rows("links")){ ?>
		<div class="section-links">
			<div class="container">
				<div class="row">
				<? 
				$link_count = count(get_field("links")); 
			    if($link_count == '3'){ 
					$class = "col-sm-4"; 
				}elseif($link_count == '4'){
					$class = "col-sm-3";
				}
				while(have_rows("links")){ the_row(); ?>
					<div class="<?= $class ?>">
						<a href="<?= the_sub_field("link") ?>" class="button <? the_sub_field("color") ?>">
							<?= the_sub_field("link_text") ?> 
						</a>
					</div>
				<? } ?>
				</div>
			</div>
		</div>
	<? }
?>