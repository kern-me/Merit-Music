<?php 

course_feed( array(
    'course_feed_program_type' => (object) array( 'post_name' => $_GET['program'] ),
    'course_feed_instrument'   => (object) array( 'post_name' => $_GET['instrument'] )
));

?>