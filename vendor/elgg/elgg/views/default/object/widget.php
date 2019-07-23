<?php
/**
 * Widget object
 *
 * @uses $vars['entity']      ElggWidget
 * @uses $vars['show_access'] Show the access control in edit area? (true)
 * @uses $vars['class']       Optional additional CSS class
 */

$widget = elgg_extract('entity', $vars);
if (!($widget instanceof \ElggWidget)) {
	return;
}

$handler = $widget->handler;

$widget_instance = preg_replace('/[^a-z0-9-]/i', '-', "elgg-widget-instance-$handler");

$widget_class = elgg_extract_class($vars, $widget_instance);
$widget_class[] = $widget->canEdit() ? 'elgg-state-draggable' : 'elgg-state-fixed';

//ditambahkan:filter widget control panel utk focal
$user = elgg_get_logged_in_user_entity();
if ($user->focal == 'no')
echo elgg_view_module('widget', '', elgg_view('object/widget/body', $vars), [
	'class' => $widget_class,
	'id' => "elgg-widget-$widget->guid",
	'header' => elgg_view('object/widget/header', $vars),
]);
else if ($user->focal == 'yes' && $handler != 'control_panel')
echo elgg_view_module('widget', '', elgg_view('object/widget/body', $vars), [
	'class' => $widget_class,
	'id' => "elgg-widget-$widget->guid",
	'header' => elgg_view('object/widget/header', $vars),
]);
