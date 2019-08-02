<header class="banner">
  <div class="container">
    <a class="brand" href="<?= esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
    <nav class="primary">
    	<a href="#" id="menu-icon"><span></span></a>
    	<?php echo wp_nav_menu(array('theme_location'=>'primary_navigation')); ?>
    </nav>
    <div class="util">
	    <a href="/search"><i class="fa fa-search"></i> <span>Search</span></a> 
	    <a class="translate" href="#"><i class="fa fa-globe"></i> <span>Language</span></a>
		    <div class="google_translate">
			    <div id="google_translate_element"></div><script type="text/javascript">
				function googleTranslateElementInit() {
				  new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'es,pl,zh-CN,zh-TW', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
				}
				</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
		    </div>
		<a href="https://meritmusic.asapconnected.com/"><i class="fa fa-gear"></i> <span>My Account</span></a>
	    <br /><a class="donate" target="_blank" href="https://www.meritmusic.org/donate"><i class="fa fa-money"></i> <span>Donate</span></a>
    </div>
  </div>
</header>
