<div class="container bios">
	<div class="col-sm-6">
		<h2><? the_title(); ?></h2>
		<? if(get_field("title")){ ?>
			<h3><? the_field("title"); ?></h3>
		<? } ?>
		
		<? if(get_field("instruments")){ ?>
			<p><? the_field("instruments"); ?></p>
		<? } ?>
		<? if(get_field("education")){ ?>
			<h3>Education:</h3>
			<p><? the_field("education"); ?></p>
		<? } ?>
		<? if(get_field("start_date")){ ?>
			<!--h3>Tenure at Merit:</h3>
			<p>
			<? $start_date = get_field("start_date"); ?>
			<? $today = date("Ymd"); ?>
			<? $months = round(abs(strtotime($today) - strtotime($start_date)) / 2629746); ?>
			<? if($months < 12){
				echo '< 1 year';
			}else{
				$years = floor($months / 12);
				$remain = $months - ($years * 12);
				echo $years.' year'.($years > 1 ? "s":"").($remain >= 1 ? ", $remain month" : "").($remain >=2 ? "s" : "");
			} ?>
			</p-->
		<? } ?>	
		<? if(get_field("website")){ ?>
			<h3>Website:</h3>
			<p><a href="<? the_field("website"); ?>"><? the_field("website"); ?></a></p>
		<? } ?>
		<? if(get_field("bio")){ ?>
			<h3>Bio:</h3>
			<? the_field("bio"); ?>
		<? } ?>

        <? if( get_field('facebook') || get_field('twitter') || get_field('linkedin') || get_field('instagram') || get_field('additional_link') ): ?>
            <h3>My Links:</h3>

            <ul class="list-inline bio-links">
            <? if( get_field('facebook') ): ?>
                <li><a target="_blank" href="<? echo the_field('facebook'); ?>"><i class="fa fa-facebook"></i></a></li>
            <? endif; ?>
            <? if( get_field('twitter') ): ?>
                <li><a target="_blank" href="<? echo the_field('twitter'); ?>"><i class="fa fa-twitter"></i></a></li>
            <? endif; ?>
            <? if( get_field('linkedin') ): ?>
                <li><a target="_blank" href="<? echo the_field('linkedin'); ?>"><i class="fa fa-linkedin"></i></a></li>
            <? endif; ?>
            <? if( get_field('instagram') ): ?>
                <li><a target="_blank" href="<? echo the_field('instagram'); ?>"><i class="fa fa-instagram"></i></a></li>
            <? endif; ?>
            </ul>

            <? if( get_field('additional_link')): ?>
                <a target="_blank" title="Visit <? echo the_field('additional_link'); ?>" href="<? echo the_field('additional_link'); ?>"><? echo the_field('additional_link'); ?></a>
            <? endif; ?>

        <? else: ?>
        <? endif; ?>

        <p><a class="button inverse" href="/about-merit/faculty-staff/">&laquo; Back to Faculty & Staff</a></p>
	</div>
	<div class="col-sm-6">
		<? if(get_field("image")){ ?>
			<? $img = get_field("image"); ?>
			<img class="img-responsive" src="<?= $img['sizes']['large']; ?>" />
		<? } ?>
		<div class="contact-info clearfix">
			<h2>Contact Information</h2>
			<div class="row">
			<? if(get_field("email")){ ?>
				<div class="col-md-6">
					<h3><i class="fa fa-envelope"></i> <a href="mailto:<? the_field("email"); ?>">Send Email</a></h3>
				</div>
			<? }else{ ?>
				<div class="col-md-6">
					<h3><i class="fa fa-envelope"></i> <a href="mailto:studentservices@meritmusic.org?subject=Attn: <? the_title() ?>">Send Email</a></h3>
				</div>
			<? } ?>
			<? if(get_field("phone_number")){ ?>
				<div class="col-md-6">
					<h3><i class="fa fa-phone"></i> <? the_field("phone_number"); ?></h3>
				</div>
			<? } ?>
			</div>
		</div>
		<? if(get_field("quote")){ ?>
		<div class="quote">
			<? the_field("quote"); ?>
		</div>
		<? } ?>
	</div>
</div>