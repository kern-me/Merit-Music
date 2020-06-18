<?php
$query_id = get_query_var( "id" );
$today = date('U');
global $json_course_feed;
$course_array = json_decode($json_course_feed);
if( empty($course_array) ){
    return "";
}
$filter_result = array_filter( $course_array->Courses, function( $var ) use ( $query_id ) {
    if($var->ActiveNetId == $query_id){
        return $var;
    }
});
$the_course = array_shift( $filter_result );

$page_course_title = $the_course->Title;
wp_localize_script( 'sage/js', 'courseTitle', $page_course_title );
localize_variable('selectedProgram', $filters['course_feed_program_type']->post_name);
$program_type = cssSafe($the_course->Program);

if(!empty($the_course)){
?>

<div class="container course-info-page">
    <div class="row">
        <div class="col-md-8">
            <h1 id="course-detail-title"><?php echo $the_course->Title; ?></h1>
            <div class="section-selection">
            <?php
            $register_url = $the_course->Url_To_Register;
            $register_text = $the_course->Url_To_Register_Label; ?>
            
            <? 
			if(!empty($the_course->Sections[0]->Price)){  ?>
            <h2>Price: $<?= $the_course->Sections[0]->Price; ?></h2>
            <?
			} ?>
            <?
            if( !empty($the_course->Sections) ){
                ?>
                <p>Select your preferred section:</p>
                <?php
                $first_item = true;
                foreach ($the_course->Sections as $the_section) {
                    $price = money_format('$%i', $the_section->Price );
                ?>
                    <div class="radio">
                        <label>
                            <input type="radio" name="course-detail-section"
                                   value="<?php echo $the_section->ActiveNetId; ?>"
                                   data-url="<?php echo $the_section->Url_To_Register; ?>"
                                    <?php if($first_item){ echo 'checked'; $register_url = $the_section->Url_To_Register; $first_item = false;} ?> />
                            <?php echo (!empty($the_section->Title) ? '<strong>'.$the_section->Title.'</strong>&nbsp; - ':'').$the_section->Summary; ?>
                        </label>
                    </div>
                <?php
                }
            }
            
            $register_open =			'<a target="_blank" href="'.$register_url.'" class="button course-register-button">Register <i class="fa fa-arrow-right"></i></a>';
            $register_return = 			'<a target="_blank" href="'.$register_url.'" class="button course-register-button">Returning Student <i class="fa fa-arrow-right"></i></a>';
            $register_return_closed = 	'<a href="#register-closed" class="register-popup button">Returning Student <i class="fa fa-arrow-right"></i></a>';
            $register_new = 			'<a target="_blank" href="'.$register_url.'" class="button course-register-button">New Student <i class="fa fa-arrow-right"></i></a>';
            $register_new_closed = 		'<a href="#register-new" class="register-popup button">New Student <i class="fa fa-arrow-right"></i></a>';
            $register_closed = 			'<p>Online registration is closed. Please contact <a href="mailto:studentservices@meritmusic.org">Student Services</a> to learn about other registration opportunities.</p>';
            //$register_closed = 			'<a class="button expired">Registration is Closed.</a>';
            
            $course_id_required = false;

            if($the_course->Program == "Conservatory"){
	            $reg_info = '<a class="button" href="/alice-s-pfaelzer-tuition-free-conservatory">How to Audition <i class="fa fa-arrow-right"></i></a>';
            }elseif($the_course->Program == "Private Lessons"){
	            $reg_info = '<a class="button" href="/classes-and-lessons/private-lessons">How to Register <i class="fa fa-arrow-right"></i></a>';
            }elseif($the_course->Program == "Instrumental Music" || $the_course->Program == "Instrumental & Vocal Music" || $the_course->Program == "Summer Camp" || $the_course->Program == "Early Childhood"){
            	if(!empty($the_course->RegistrationDeadline) && strtotime($the_course->RegistrationDeadline ."+ 1 day") >= $today){
	            	// Registration Isn't Closed Yet
	            	if($the_course->AllowPriorityRegistration == true){
		            	if(strtotime($the_course->PriorityRegStart) <= $today && strtotime($the_course->RegistrationStart) >= $today){
		            		// Priority Registration Window
		            		$reg_info .= '<p>'.$register_return_closed.'</p>';
							$course_id_required = true;
		            	}elseif(strtotime($the_course->PriorityRegStart) > $today){ 
			            	// Before Priority Registration begins 
							$reg_info .= '<p class="reg-begins">Priority registration begins '.date('F j, Y', strtotime($the_course->PriorityRegStart)).'.</p>';
		            	}
					}
					if(strtotime($the_course->RegistrationStart) <= $today){
						// Open Registration Window
						if($the_course->Level == "Beginner"){
							// Single-Button Open Registration
							$reg_info .= '<p>'.$register_open.'</p>';
						}elseif($the_course->Program == "Early Childhood" || $the_course->SummerCamp == "open"){
							// New / Returning Registration Buttons direct to ActiveNet
							$reg_info .= '<p>Register As:</p>';
							$reg_info .= '<p>'.$register_return.' '.$register_new.'</p>';
						}else{
							// Course ID Required to Register
							$reg_info .= '<p>Register As:</p>';
							$reg_info .= '<p>'.$register_return_closed.' '.$register_new_closed.'</p>';
							$course_id_required = true;
						}
			}elseif(strtotime($the_course->RegistrationStart) > $today){
						// Before Open Registration begins 
						if($the_course->Level == 'Beginner' || $the_course->Program == "Early Childhood" || $the_course->SummerCamp == "open"){
							$reg_info .= '<p class="reg-begins">Open registration begins '.date('F j, Y', strtotime($the_course->RegistrationStart)).'.</p>';
						}
					}
	            }elseif(!empty($the_course->RegistrationDeadline) && strtotime($the_course->RegistrationDeadline) < $today){
		            // Registration Closed
		            $reg_info = '<p>'.$register_closed.'</p>';
	            }
            }
            echo $reg_info;

		    ?>
            </div>
            <?

	            if( !empty($the_course->Description) ){
                $body = $the_course->Description;
                $body = clean_up_course_text( $body );
                ?>
                <div>
                    <h2>Description</h2>
                    <p><?php echo $body; ?></p>
                </div>
                <?php
            } ?>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default course-details">
                <div class="course-detail-label">PROGRAM:</div>
                <div class="course-detail-info"><?php echo $the_course->Program; ?></div>
                <div class="course-detail-label">LOCATION:</div>
                <div class="course-detail-info"><?php echo $the_course->Location; ?></div>
                <? if($the_course->Program !== 'Conservatory' && $the_course->Program !== 'Private Lessons'){ ?>
                <div class="course-detail-label">START:</div>
                <div class="course-detail-info"><?php echo date( 'F j, Y', strtotime($the_course->Course_Start) ); ?></div>
                <div class="course-detail-label">ENDS:</div>
                <div class="course-detail-info"><?php echo date( 'F j, Y', strtotime($the_course->Course_End) ); ?></div>
                <? } ?>
                <?php
                if( !empty($the_course->RegistrationDeadline) ) {
                    ?>
                    <div class="course-detail-label course-detail-deadline">REGISTRATION DEADLINE:</div>
                    <div class="course-detail-info course-detail-deadline"><?php echo date( 'F j, Y', strtotime($the_course->RegistrationDeadline) ); ?></div>
                <?php
                }
                ?>
            </div>
            <?php
                $acfields = get_fields( $program_page->ID );
                if( !empty($acfields['page_primary_nav']) ){
                    print_inpage_nav( $acfields['page_primary_nav'] );
                }
                if( !empty($acfields['page_secondary_nav']) ){
                    print_inpage_nav( $acfields['page_secondary_nav'] );
                }
            ?>
        </div>
        <? $args = array(
	        		'numberposts' 	=> 1, 
	        		'post_type' 	=> 'course_info', 
	        		'meta_query' 	=> array( 
		        		'relation'	=> 'AND',
	        			array(
		        			'key'		=> 'program',
		        			'value'		=> cssSafe($the_course->Program),
		        			'compare' 	=> 'LIKE'
	        			)
	        		) 
	        	); ?>
        <? $course_query = new WP_Query($args); ?>
        <? 
	        if( $course_query->have_posts()){
		        while($course_query->have_posts()){ $course_query->the_post(); ?>
					<div class="content">
				        <main class="main">
					        <div class="course_info">
					        <? the_field("content"); ?>
					        </div>
				        </main>
				        <aside class="sidebar">
					        <? display_widgets(); ?>
				        </aside>
				    </div>
			<?
				}
	        }
	    ?>


	    <?
		    wp_reset_query(); 
        ?>
    </div>
</div>
<div class="inline-contextual-search">
	<div class="container">
		<h2 class="center">
			Not sure what you are looking for?<br />
			Let us help you out!
		</h2>
		<? contextual_course_search(); ?>
	</div>
</div>

<? if($course_id_required){ ?>
<div style="display:none;">
	<div id="register-closed" class="popup-module">
		<h2>Returning Students</h2>
		<p>Returning students are provided with course code recommendations via email.<br/>
		Please enter your recommended course code to continue to register.</p>
		<? course_code_search(); ?>
	</div>
	<div id="register-new" class="popup-module">
		<h2>New Students</h2>
		<p>Please contact Student Services (<a href="mailto:studentservices@meritmusic.org">studentservices@meritmusic.org</a> or 312-786-9428) to register.</p>
	</div>
</div>
<?	
}
}else{ ?>
<div class="content search">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h2>Oops!</h2>
				<h3>You must've gotten here by mistake.</h3>
				<p>Go back <a href="/">Home</a>, or <a href="/search">search</a> for what you were looking for.</p>
			</div>
		</div>
	</div>
</div>
<?
}
?>