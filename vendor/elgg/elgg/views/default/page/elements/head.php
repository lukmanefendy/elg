<?php
/**
 * The HTML head
 *
 * @internal It's dangerous to alter this view.
 * 
 * @uses $vars['title'] The page title
 * @uses $vars['metas'] Array of meta elements
 * @uses $vars['links'] Array of links
 */

$metas = elgg_extract('metas', $vars, array());
$links = elgg_extract('links', $vars, array());

echo elgg_format_element('title', array(), $vars['title'], array('encode_text' => true));
foreach ($metas as $attributes) {
	echo elgg_format_element('meta', $attributes);
}
foreach ($links as $attributes) {
	echo elgg_format_element('link', $attributes);
}

$stylesheets = elgg_get_loaded_css();

foreach ($stylesheets as $url) {
	echo elgg_format_element('link', array('rel' => 'stylesheet', 'href' => $url));
}

//ditambahkan utk tampilan sebelum login
if (!elgg_is_logged_in() && $vars['title'] != "Choose Nation: : ARC: A-EXPECS"){
	echo elgg_format_element('link', array('rel' => 'stylesheet', 'href' => "http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"));
	echo elgg_format_element('link', array('rel' => 'stylesheet', 'href' => "css/style.css"));
	echo elgg_format_element('link', array('rel' => 'stylesheet', 'href' => "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"));
		
	}
// A non-empty script *must* come below the CSS links, otherwise Firefox will exhibit FOUC
// See https://github.com/Elgg/Elgg/issues/8328
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
$(document).ready(function(){
  $(".indoflag").click(function(){
    $(".hideshow").toggle();
    $(".rdo1").toggle();
    $(".rdo2").toggle();
    $(".spanval").toggle();
  });
});

$(document).ready(function(){
  $(".rdo1").click(function(){
    $(".elgg-field.elgg-field-required").show();
    $(".elgg-button.elgg-button-submit").show();
  });
});
</script>

<script>
	<?php // Do not convert this to a regular function declaration. It gets redefined later. ?>
	require = function () {
		// handled in the view "elgg.js"
		_require_queue.push(arguments);
	};
	_require_queue = [];
</script>

