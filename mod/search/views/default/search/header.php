<?php
/**
 * Search box in page header
 */
//tambahan utk menghilangkan search box sebelum login
if (elgg_is_logged_in()) {
    echo elgg_view('search/search_box', array('class' => 'elgg-search-header'));
}