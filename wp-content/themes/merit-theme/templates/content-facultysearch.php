	<div class="container">
		<? 
		if(have_rows("faculty")){ ?>
		<div id="faculty-search">
			<h2>Search For Faculty</h2>
			<div class="filters">
				<select id="department-select" name="department-select">
					<option value="none">Select Department</option>
					<? while(have_rows("faculty")){ the_row();
						 $class = preg_replace('/\W+/','',strtolower(get_sub_field("department"))); ?>
						 <option value="<?= $class ?>"><? the_sub_field("department"); ?></option>
					<? } ?>
				</select>
				<input type="submit" id="view-all" name="view_all" value="View all" />
			</div>
			<? while(have_rows("faculty")){ the_row(); ?>
				<? $class = preg_replace('/\W+/','',strtolower(get_sub_field("department"))); ?>
				<div class="faculty <?= $class ?>">
					<h3><? the_sub_field("department"); ?></h3>
					<? if(get_sub_field("members")){
						 foreach(get_sub_field("members") as $k=>$v){?>
						 	<div class="member row">
							 	<div class="col-sm-3">
								 	<a href="<?= get_the_permalink($v->ID); ?>"><?= get_the_title($v->ID); ?></a>
							 	</div>
							 	<div class="col-sm-6">
								 	<?= get_field("title",$v->ID); ?>
							 	</div>
							 	<div class="col-sm-3 right">
								 	<a href="<?= get_the_permalink($v->ID); ?>">See More <i class="fa fa-arrow-right"></i></a>
							 	</div>
						 	</div>
					<?	} 
					} ?>
				</div>
			<? } ?>
			<div class="faculty none">
				<p>Please select a department from the dropdown above to view faculty listings.</p>
			</div>
		</div>
		<? } ?>
		<div class="separator"></div>
		<? 
		if(have_rows("staff")){ ?>
		<div id="staff-listing">
			<h2>Staff</h2>
			<? while(have_rows("staff")){ the_row(); ?>
				<? $class = preg_replace('/\W+/','',strtolower(get_sub_field("department"))); ?>
				<div class="staff <?= $class ?>">
					<h3><? the_sub_field("department"); ?></h3>
					<? if(get_sub_field("members")){
						 foreach(get_sub_field("members") as $k=>$v){?>
						 	<div class="member row">
							 	<div class="col-sm-3">
								 	<a href="<?= get_the_permalink($v->ID); ?>"><?= get_the_title($v->ID); ?></a>
							 	</div>
							 	<div class="col-sm-6">
								 	<?= get_field("title",$v->ID); ?>
							 	</div>
							 	<div class="col-sm-3 right">
								 	<a href="<?= get_the_permalink($v->ID); ?>">See More <i class="fa fa-arrow-right"></i></a>
							 	</div>
						 	</div>
					<?	} 
					} ?>
				</div>
			<? } ?>
		</div>
	<?	} ?>
    </div>