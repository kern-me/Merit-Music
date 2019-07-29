<form role="search" class="search-form form-inline">
  <label class="sr-only"><?php _e('Search for:', 'sage'); ?></label>
  <div class="input-group">
    <input id="st-search-input" type="search" name="s" class="search-field form-control" placeholder="<?php _e('Search', 'sage'); ?> <?php bloginfo('name'); ?>" required>
    <span class="input-group-btn">
      <button type="submit" class="search-submit btn btn-default"><?php _e('Search', 'sage'); ?></button>
    </span>
  </div>
</form>
<div id="st-results-container" class="primary-content"></div>