<?php
/**
 * Elgg checkbox input
 * Displays a checkbox input tag
 * 
 * @package Elgg
 * @subpackage Core
 *
 *
 * Pass input tag attributes as key value pairs. For a list of allowable
 * attributes, see http://www.w3schools.com/tags/tag_input.asp
 * 
 * @uses $vars['name']        Name of the checkbox
 * @uses $vars['value']       Value of the checkbox
 * @uses $vars['default']     The default value to submit if not checked.
 *                            Optional, defaults to 0. Set to false for no default.
 * @uses $vars['checked']     Whether this checkbox is checked
 * @uses $vars['label']       Optional label string
 * @uses $vars['class']       Additional CSS class
 * @uses $vars['label_class'] Optional class for the label
 * @uses $vars['label_tag']   HTML tag that wraps concatinated label and input. Defaults to 'label'.
 */

$labclass = str_replace(' ','',strtolower($vars['value']));
$vars['class'] = elgg_extract_class($vars, 'elgg-input-checkbox elgg-input-checkbox-'.$labclass);

$defaults = array(
	'default' => 0,
	'disabled' => false,
	'type' => 'checkbox'
);

$vars = array_merge($defaults, $vars);

$default = $vars['default'];
unset($vars['default']);

if (isset($vars['name']) && $default !== false) {
	echo elgg_view('input/hidden', ['name' => $vars['name'], 'value' => $default]);
}

$label = elgg_extract('label', $vars, false);
$label_class = (array) elgg_extract('label_class', $vars, []);
$label_class[] = 'elgg-input-single-checkbox';
unset($vars['label']);
unset($vars['label_class']);

$input = elgg_format_element('input', $vars);

//ditambahkan: labclass
if (strlen($labclass)>=10){
$cb = <<<__CB
&nbsp;&nbsp;&nbsp;&nbsp;
<label class = "$labclass-label-aca label-aca hidden"><input type="checkbox" value="article" name="hrm[]" class="elgg-input-checkbox-aca">Article </label> &nbsp;
<label class = "$labclass-label-aca label-aca hidden"><input type="checkbox" value="riset" name="hrm[]" class="elgg-input-checkbox-aca">Research </label> &nbsp;
<label class = "$labclass-label-aca label-aca hidden"><input type="checkbox" value="book" name="hrm[]" class="elgg-input-checkbox-aca">Book </label> &nbsp;
<label class = "$labclass-label-aca label-aca hidden"><input type="checkbox" value="brief" name="hrm[]" class="elgg-input-checkbox-aca">Brief policy </label> &nbsp;
<label class = "$labclass-label-pra label-pra hidden"><input type="checkbox" value="certi" name="pubadmin[]" class="elgg-input-checkbox-pra">Certificate </label> &nbsp;
<label class = "$labclass-label-pra label-pra hidden"><input type="checkbox" value="recom" name="pubadmin[]" class="elgg-input-checkbox-pra">Recommendation </label> &nbsp;
<label class = "$labclass-label-file label-file hidden"><input type="file" value="upload" name="files[]" class="elgg-input-file-upload elgg-button elgg-button-submit" multiple></label> &nbsp;
__CB;

$sc = <<<__SC
<script>
$(".elgg-input-checkbox-$labclass").click(function () {
	var testAca = ".$labclass-label-aca";
	var testPra = ".$labclass-label-pra";
	var testFile = ".$labclass-label-file";	

    if (this.checked && $('.catexpert').val() == "Academic Expert"){
		$(testAca).show();
		$(testFile).show();
	}
	else if (this.checked && $('.catexpert').val() == "Practitioners"){
		$(testPra).show();
		$(testFile).show();
	}
	else if (this.checked && $('.catexpert').val() == "Both Categories"){
		$(testAca).show();
		$(testPra).show();
		$(testFile).show();
	}
    else {
		$(testAca).hide();
		$(testPra).hide();
		$(testFile).hide();
	}
});
</script>
__SC;
}

if (!empty($label)) {
	$html_tag = elgg_extract('label_tag', $vars, 'label', false);
	echo elgg_format_element($html_tag, ['class' => $label_class], "$input $label");
} else {
	echo $input;
}

//if ($vars['name'] == 'hrm[]') 
	echo $cb;
	echo $sc;
	
//else if ($vars['name'] == 'pubadmin[]') 
//	echo $cb2;