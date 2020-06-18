  <article <?php post_class(); ?>>
    <div class="entry-content">
      <?php get_template_part('templates/entry-meta'); ?>
      <?php the_content(); ?>
      <?php content_blocks(); ?>
      <? if(in_category("news")){ ?>
        <a href="/news" class="button inverse">&laquo; Back to News</a>
      <? }elseif(in_category("press-release")){ ?>
      	<a href="/press-releases" class="button inverse">&laquo; Back to Press Releases</a>
      <? } ?>
    </div>
  </article>
