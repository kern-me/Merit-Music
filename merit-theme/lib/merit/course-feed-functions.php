<?php
// Utility Functions

function add_query_vars_filter( $vars ){
    $vars[] = "id";
    return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter' );

function clean_up_course_text( $text ){
    $regex_array = array (
        '/(<font[^>]*>)|(<\/font>)/',
        '/color=[^\s]*/',
        '/color:[^;]*;/',
        '/background:[^;]*;/',
        '/mso-bidi-font-size:[^;]*;/',
        '/font-size:[^;]*;/',
        '/mso-fareast-font-family:[^;]*;/',
        '/font-family:[^;]*;/',
        '/mso-bidi-font-family:[^;]*;/',
        '/font-family:[^;]*;/',
    );
    foreach ($regex_array as $expr) {
        $text = preg_replace( $expr, '', $text );
    }
    return $text;
}

function localize_variable( $name, $value ){
    wp_localize_script('sage/js', $name, $value );
}

function cssSafe($name) {
	return preg_replace('/\W+/','',strtolower(strip_tags($name)));
}

// Load Filter Options from the Options Page into Select Fields
function program_field_choices($field){
    $field['choices'] = array();
    $choices = get_field('program_types', 'option', false);
    $choices = explode("\n", $choices);
    $choices = array_map('trim', $choices);
    if( is_array($choices) ) {
        foreach( $choices as $choice ) {
            $field['choices'][ $choice ] = $choice;
        }
    }
    return $field;
}
add_filter('acf/load_field/name=filter_program_types', 'program_field_choices');

function instrument_field_choices($field){
	$field['choices'] = array();
    if( have_rows('instruments', 'option') ) {
        while( have_rows('instruments', 'option') ) {
            the_row();
            $value = get_sub_field('value');
            $label = get_sub_field('label');
            $field['choices'][ $value ] = $label;
        }
    }
    return $field;
}
add_filter('acf/load_field/name=filter_instruments', 'instrument_field_choices');

function category_field_choices($field){
    $field['choices'] = array();
    $choices = get_field('categories', 'option', false);
    $choices = explode("\n", $choices);
    $choices = array_map('trim', $choices);
    if( is_array($choices) ) {
        foreach( $choices as $choice ) {
            $field['choices'][ $choice ] = $choice;
        }
    }
    return $field;
}
add_filter('acf/load_field/name=filter_categories', 'category_field_choices');

function age_group_field_choices($field){
    $field['choices'] = array();
    $choices = get_field('age_groups', 'option', false);
    $choices = explode("\n", $choices);
    $choices = array_map('trim', $choices);
    if( is_array($choices) ) {
        foreach( $choices as $choice ) {
            $field['choices'][ $choice ] = $choice;
        }
    }
    return $field;
}
add_filter('acf/load_field/name=filter_age_groups', 'age_group_field_choices');

function pluralize( $number, $singular, $plural ){
    if( 0 == $number ){
        return "";
    } elseif ( 1 == $number ){
        return $singular;
    } else {
        return $plural;
    }
}	

// Fix YOAST Cannonical Link in Header for Course pages
add_filter( 'wpseo_canonical', 'course_cannonical_links', 10, 1);
function course_cannonical_links( $base_link ){
    global $wp_the_query;
    $page_name = $wp_the_query->post->post_name;
    if( 'course' == $page_name && !empty( $_GET['id']) ){
        return $base_link . "?id=" . $_GET['id'];
    }
    return $base_link;
}

function merit_course_title( $title ) {
    if ( is_page( 'course' ) ) {
		global $json_course_feed;
		$query_id = get_query_var( "id" );
		$json_course_feed = file_get_contents(ABSPATH . 'wp-content/themes/merit-theme/assets/scripts/CourseFeed.json');
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
        $title = $the_course->Title.' - Merit School of Music';
    }
    return $title;
}
add_filter( 'pre_get_document_title', 'merit_course_title', 20 );

function course_feed($filters) {
    $json_course_feed = file_get_contents(ABSPATH . 'wp-content/themes/merit-theme/assets/scripts/CourseFeed.json');
    $course_array = json_decode($json_course_feed);
    localize_variable('selectedAge', $filters['course_feed_age']->post_name);
    localize_variable('selectedInstrument', $filters['course_feed_instrument']->post_name);
    localize_variable('selectedProgram', $filters['course_feed_program_type']->post_name);
    localize_variable('selectedCategory', $filters['course_feed_category_type']->post_name);
    ?>
    <div class="course-feed">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-push-8">
	                <div class="panel panel-default course-filters">
	                    <button id="clear-filters" class="button">show all</button>
	                    <h4>Filter By:</h4>
	                    <form class="">
	                         <div class="form-group">
	                            <label for="course-age-filter" class="course-filter-label">Age/Grade:</label>
	                            <select name="course-age-filter" id="course-age-filter"
	                                    class="course-filter form-control">
	                                <option value="all">All Ages / Grades</option>
	                                <?php
	                                $age_groups = get_field('age_groups','option');
	                                $age_groups = explode("\n", $age_groups);
	                                $age_groups = array_map('trim', $age_groups);
	                                foreach ($age_groups as $age_group) {
	                                    ?>
	                                    <option
	                                        value="<?php echo cssSafe($age_group); ?>"><?php echo $age_group ?></option>
	                                <?php
	                                }
	                                ?>
	                            </select>
	                        </div>
	                        <div class="form-group">
	                            <label for="course-instrument-filter"
	                                   class="course-filter-label pull-left">Instrument:</label>
	                            <select name="course-instrument-filter" id="course-instrument-filter"
	                                    class="course-filter form-control">
	                                <option value="all">All Instruments</option>
	                                <?php
	                                $instruments = array();
								    if( have_rows('instruments', 'option') ) {
								        while( have_rows('instruments', 'option') ) {
								            the_row();
								            $value = get_sub_field('value');
								            $label = get_sub_field('label');
											$instruments[ $value ] = $label;
										}
									}
	                                foreach ($instruments as $instrument=>$label) {
	                                    ?>
	                                    <option
	                                        value="<?php echo 'instrument-'.$instrument; ?>"><?php echo $label; ?></option>
	                                <?php
	                                }
	                                ?>
	                            </select>
	                        </div>
	                        <div class="form-group">
	                            <label class="course-filter-label">Program:</label>
	                                <?php
	                                $programs = get_field('program_types','option');
	                                $programs = explode("\n", $programs);
	                                $programs = array_map('trim', $programs); ?>
	                                <label class="radio-label"><input type="radio" name="course-program-filter" class="course-program-filter course-filter" value="all" checked /> All</label>
									<?
	                                foreach ($programs as $program) {
	                                    ?>
	                                    <label class="radio-label">
	                                    	<input type="radio" name="course-program-filter" class="course-program-filter course-filter"
	                                        	value="<?= cssSafe($program); ?>" id="<?= cssSafe($program); ?>">
	                                	
											<?php echo $program ?>
										</label>
	                                <?php
	                                }
	                                ?>
	                            </select>
	                        </div>
	                         <div class="form-group" style="display:none;">
	                            <label for="course-category-filter" class="course-filter-label"></label>
	                            <select name="course-category-filter" id="course-category-filter"
	                                    class="course-filter form-control">
	                                <?php
	                                $categories = get_field('categories','option');
	                                $categories = explode("\n", $categories);
	                                $categories = array_map('trim', $categories); ?>
	                                <option value="all">All Categories</option>
	                                <?
	                                foreach ($categories as $category) {
	                                    ?>
	                                    <option
	                                        value="<?php echo 'category-'.cssSafe($category); ?>"><?php echo $category ?></option>
	                                <?php
	                                }
	                                ?>
	                            </select>
	                        </div>
			            </form>
		                <hr />
                        <div class="course-code-form">
		                    <label class="course-filter-label">Course Code:</label>
		                    <p>Students that have received a course code from their instructors can use that code here:</p>
							<? course_code_search(); ?>
	                    </div>
                    </div>
                    <? if(get_field("display_upcoming_events")){ ?>
                    <div class="upcoming_events">
	                    <? 	if(get_field('events_category')){
								$tax_query = array(
												array(
													'taxonomy' 	=> 'tribe_events_cat',
													'field'		=> 'term_id',
													'terms'		=> get_field('events_category')
												),
											);
							}
							$events = tribe_get_events(
								array(
									'posts_per_page'=> 	3, 
									'start_date'	=> 	date('Y-m-d H:i:s'),
									'tax_query' 	=> 	$tax_query
								)
							);
							if(!empty($events)){ ?>
								<div class="widget events">
									<h3><?= get_field("upcoming_events_title") ?></h3>
									<? foreach($events as $k=>$event){
										format_event($event->ID, 'h4');
									 } ?>
								</div>
						<?	} ?>
                    </div>
                    <? } ?>
                </div>
                <div class="col-md-8 col-md-pull-4">
                    <div id="course-card-not-found" class="panel panel-default clearfix" style="display:none;">
                        <div class="panel-body">
                            <div class="course-card-title">Sorry, No Courses Found.</div>
                            <p>Try again by modifying the search filters.</p>
                        </div>
                    </div>
                    <?php
                    foreach ($course_array->Courses as $a_course) {
                        $sorting_classes = '';
                        foreach ($a_course->Instruments as $a_instrument) {
                            $sorting_classes .= ' instrument-' . $a_instrument->Id;
                        }
                        $age_display = '';
                        foreach ($a_course->Ages as $a_age) {
                            $sorting_classes .= ' '.cssSafe($a_age);
                        }
                        $sorting_classes .= ' '.cssSafe($a_course->Program);
                        $sorting_classes .= ' category-'.cssSafe($a_course->Category);
                        ?>
                        <div class="panel panel-default course-card clearfix <?php echo trim($sorting_classes); ?>">
                            <div class="panel-body">
                                <div class="course-card-title">
                                    <a href="/course/?id=<?php echo $a_course->ActiveNetId; ?>"><?php echo "$a_course->Title" ?></a>
                                </div>
                                <?php
                                $card_body = $a_course->Description;
                                if( !empty($a_course->Summary) ){
                                    $card_body = $a_course->Summary;
                                }
                                ?>
                                <div class="course-card-description"><?php echo clean_up_course_text($card_body); ?></div>
                                <a class="button"
                                   href="/course/?id=<?php echo $a_course->ActiveNetId; ?>">
                                    Details <i class="fa fa-arrow-right"></i>
                                </a>
                            </div>
                            <div class="course-price"><?= (!empty($a_course->Sections[0]->Price) ? '$'.$a_course->Sections[0]->Price : "&nbsp;") ?></div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php
}

function course_code_search(){ ?>
	<form action="/course-search/course-code" method="POST" id="course-code" class="clearfix">
		<input name="course_code" placeholder="Enter Course Code" required />
		<button type="submit">Go</button>
	</form>
<?php	
}

function contextual_course_search(){
    if( !empty($filters) ){
        $selected_age = $filters['course_search_age']->post_name;
        $selected_program = $filters['course_search_program_type']->post_name;
        $selected_instrument = $filters['course_search_instrument']->post_name;
    }
    ?>
    <div class="contextual-search-form">
        <form action="/course-search/" method="GET">
            <span>I am interested in
                <div class="select">
	                <select name="program" class="course-search-inpage-nav-select form-control">
	                    <option value="all" selected>any program</option>
	                    <?php
	                    $programs = get_field('program_types','option');
	                    $programs = explode("\n", $programs);
	                    $programs = array_map('trim', $programs); ?>
						<?
	                    foreach ($programs as $program) {
	                    ?>
	                        <option
	                            value="<?= cssSafe($program); ?>" id="<?= cssSafe($program); ?>"><?php echo $program ?></option>
	                    <?php
	                    }
	                    ?>
	                </select>
                </div>
            </span>
            <span>
                I want to learn how to play
                <div class="select">
	                <select name="instrument" class="course-search-inpage-nav-select form-control">
	                    <option value="all" selected>any instrument</option>
	                    <?php
	                    $instruments = array();
					    if( have_rows('instruments', 'option') ) {
					        while( have_rows('instruments', 'option') ) {
					            the_row();
					            $value = get_sub_field('value');
					            $label = get_sub_field('label');
								$instruments[ $value ] = $label;
							}
						}
	                    foreach ($instruments as $instrument=>$label) {
	                        ?>
	                        <option
	                            value="<?php echo 'instrument-'.$instrument; ?>"><?php echo $label; ?></option>
	                    <?php
	                    }
	                    ?>
	                </select>
                </div>
            </span>
           <button type="submit" class="button">Show Results</button>
        </form>
    </div>
<?php
}
?>