<?php

use Roots\Sage\Setup;
use Roots\Sage\Wrapper;

?>

<!doctype html>
<html <?php language_attributes(); ?>>
  <?php get_template_part('templates/head'); ?>
  <body <?php body_class(); ?>>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5K5SL5L"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
   <?php
      do_action('get_header');
 
      get_template_part('templates/announcements'); 

      get_template_part('templates/header');
      
      if(is_page_template('template-programs.php')){
	      get_template_part('templates/programs','header');
      }elseif(is_home()){
	      get_template_part('templates/news', 'header');
	  }elseif(is_search()){
	      get_template_part('templates/search', 'header');
	  }else{
	      get_template_part('templates/page', 'header');
      }

      
      include Wrapper\template_path(); 


      do_action('get_footer');
      get_template_part('templates/footer');
      wp_footer();
    ?>
  </body>
</html>
