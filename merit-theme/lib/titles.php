<?php

namespace Roots\Sage\Titles;

/**
 * Page titles
 */
function title() {
  if (is_home()) {
    if (get_option('page_for_posts', true)) {
      return get_the_title(get_option('page_for_posts', true));
    } else {
      return __('Latest Posts', 'sage');
    }
  }	elseif (is_search()) {
    return sprintf(__('Search Results for %s', 'sage'), get_search_query());
  } elseif ( tribe_is_month() || tribe_is_day() || tribe_is_event() && !is_single() ) {
	return __('Calendar of Events', 'sage');  
  } elseif ( get_post_type() == 'bios' ) {
  	return __('Faculty & Staff', 'sage');
  } elseif (is_archive()) {
    return get_the_archive_title();
  } elseif (is_404()) {
    return __('Not Found', 'sage');
  } else {
    return get_the_title();
  }
}
