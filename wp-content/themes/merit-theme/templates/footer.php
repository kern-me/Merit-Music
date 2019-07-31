<script src="https://code.jquery.com/jquery-1.12.4.min.js"
  integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
  crossorigin="anonymous"></script>

<footer class="content-info">
<? if(have_rows("columns","option")){ ?>
	<!--div class="nav">
		<div class="container">
			<div class="row clearfix">
			<? while(have_rows("columns","option")){ the_row(); ?>
				<div class="col-md-3 col-sm-6">
					<h3><a href="<? the_sub_field("column_title_link"); ?>"><? the_sub_field("column_title") ?></a></h3>
					<ul>
					<? while(have_rows("links")){ the_row(); ?>
						<li><a href="<? the_sub_field('link') ?>"><? the_sub_field('link_title') ?></a>
					<? } ?>
					</ul>
				</div>
			<? }?>
			</div>
		</div>
	</div-->
<? } ?>

<? if(have_rows("social_icons","option")){ ?>
	<div class="social-bar">
		<h3>Sign Up for our Emails:</h3>
		<div class="email-form">
			<!-- Begin Constant Contact Inline Form Code -->
			<div class="ctct-inline-form" data-form-id="114be92e-9436-41f3-9fd9-ac0cc27a68ba"></div>
			<!-- End Constant Contact Inline Form Code -->
		</div> 
		
		<h3><? the_field("social_icons_title","option"); ?></h3>
	<? while(have_rows("social_icons","option")){ the_row(); ?>
		<a target="_blank" href="<? the_sub_field("link") ?>"><i class="fa <? the_sub_field("icon") ?>"></i></a>
	<? }?> 
	</div>
<? } ?>
<? $sponsors = get_field("sponsors","option");
	if($sponsors){ ?>
	<div class="sponsors container">
		<h3><? the_field("sponsor_title","option"); ?></h3>
		<div class="carousel">
			<? foreach($sponsors as $k=>$logo){ ?>
			<div class="slide">
				<a href="<?= $logo['link'] ?>" target="_blank"><img src="<?= $logo['logo'] ?>" alt="" /></a>
			</div>
			<? } ?>
		</div>	
	</div>
	<? } ?>	
	<p class="copyright"><? the_field("copyright_text","option"); ?></p>
<? if(have_rows("footer_logos","option")){ ?>
	<div class="awards">
		<? while(have_rows("footer_logos","option")){ the_row(); ?>
			<a target="_blank" href="<? the_sub_field("link") ?>"><img src="<? the_sub_field("logo") ?>" alt="" /></a>
		<? } ?>
	</div>	
<? } ?>
</footer>
<!-- Begin Constant Contact Active Forms -->
<script> var _ctct_m = "786023d1af9a728d8fe2950d24876b27"; </script>
<script id="signupScript" src="//static.ctctcdn.com/js/signup-form-widget/current/signup-form-widget.min.js" async defer></script>
<!-- End Constant Contact Active Forms -->
