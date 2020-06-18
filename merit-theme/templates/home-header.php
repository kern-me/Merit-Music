<?php
	$banners = get_field("banner_images");
	if(!empty($banners)){ 
		$rand = rand(0,count($banners)-1);
		$img = $banners[$rand]['sizes']['banner-image'];
	?>	<div id="masthead" class="home" style="background-image:url(<?= $img ?>);">
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
							<span class="link"><?= the_sub_field("link_text") ?> </span>
						</a>
					</div>
				<? } ?>
				</div>
			</div>
		</div>
	<? }
?>