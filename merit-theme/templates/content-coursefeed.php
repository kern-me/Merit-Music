<div class="wrap container clearfix">
<?php 
	the_content();
	content_blocks(); 
?>
</div>
<?php
	course_feed( array(
	    'course_feed_age'            => (object) array( 'post_name' => $_GET['age'] ),
	    'course_feed_program_type'   => (object) array( 'post_name' => $_GET['program'] ),
	    'course_feed_location'       => (object) array( 'post_name' => $_GET['location'] )
	));
?>