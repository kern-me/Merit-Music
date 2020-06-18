<script type="text/javascript">
  (function(w,d,t,u,n,s,e){w['SwiftypeObject']=n;w[n]=w[n]||function(){
  (w[n].q=w[n].q||[]).push(arguments);};s=d.createElement(t);
  e=d.getElementsByTagName(t)[0];s.async=1;s.src=u;e.parentNode.insertBefore(s,e);
  })(window,document,'script','//s.swiftypecdn.com/install/v2/st.js','_st');
  
  _st('install','5g5QNAJKz8Stymq8BMqx','2.0.0');
</script>
    <div class="wrap" role="document">
      <div class="content search">
	      <div class="container">
		      <div class="row">
				<?php while (have_posts()) : the_post(); ?>
					<?php get_template_part('templates/content', 'searchpage'); ?>
				<?php endwhile; ?>
		      </div>
	      </div>
      </div><!-- /.content -->
    </div><!-- /.wrap -->