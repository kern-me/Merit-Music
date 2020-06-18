<div class="content search">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<?php 
				if(!empty($_POST['course_code'])){
					$course_code = $_POST['course_code'];
					$json_course_feed = file_get_contents(ABSPATH . 'wp-content/themes/merit-theme/assets/scripts/CourseFeed.json');
					$course_array = json_decode($json_course_feed);
					if( empty($course_array) ){
					    return "";
					}
					$sections = array();
					foreach($course_array->Courses as $v){
						foreach($v->Sections as $s){
							$sections[] = $s;
						}
					}
					$filter_result = array_filter( $sections, function( $var ) use ( $course_code ) {
					    if($var->ActiveNetId == $course_code){
					        return $var;
					    }
					});
					$the_course = array_shift( $filter_result );
						if($the_course){ ?>
						<h2>Success!</h2>
						<p>You will be redirected to the registration page automatically.</p>
						<p><a href="<?= $the_course->Url_To_Register ?>">Click here to continue</a></p>
						<script>
							setTimeout(function () {
							   window.location.href = "<?= $the_course->Url_To_Register ?>"; //will redirect to your blog page (an ex: blog.html)
							}, 2000);
						</script>
					<?	
					}else{ ?>
				 		<h2>Sorry!</h2>
				 		<p>The course you are looking for could not be found. Please re-enter the course code below and try again.</p>
				 		<? course_code_search(); ?>
				 	<?	
					}
					
				}else{ ?>
					<h2>Oops!</h2>
					<h3>You must've gotten here by mistake.</h3>
					<p>Go back <a href="/">Home</a>, or <a href="/search">search</a> for what you were looking for.</p>	
				
				<?
				}
				?>
			</div>
		</div>
	</div>
</div>