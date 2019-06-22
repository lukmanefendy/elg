<?php
/**
 * Update profile river view
 */

$item = $vars['item'];
/* @var ElggRiverItem $item */

$subject = $item->getSubjectEntity();

//ditambahkan:guid utk menampilkan image verified
$subject_link = elgg_view('output/url', array(
	'href' => $subject->getURL(),
	'text' => $subject->name,
	'class' => 'elgg-river-subject',
	'is_trusted' => true,
	'guid' => $subject->guid,
));

$string = elgg_echo('river:update:user:profile', array($subject_link));

echo elgg_view('river/elements/layout', array(
	'item' => $item,
	'summary' => $string,

	// truthy value to bypass responses rendering
	'responses' => ' ',
));
