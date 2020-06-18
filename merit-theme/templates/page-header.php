<?php use Roots\Sage\Titles; ?>
<? if(get_field('banner_image')){ $class = 'image'; }else{ $class= 'color '.get_field("banner_color"); } ?>
<div id="masthead" class="<?= $class ?>"
	<? $image = get_field('banner_image'); ?>
	<?= (get_field('banner_image')? 'style="background-image:url('.$image['sizes']['banner-image'].');"':'') ?>>
	<div class="container">
		<h1 id="page-title"><?= (get_field('headline') ? get_field('headline') : Titles\title()) ?></h1>
	</div>
</div>
