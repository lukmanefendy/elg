<?php
/**
 * Elgg select input
 * Displays a select input field
 *
 * @warning Values of FALSE or NULL will match '' (empty string) but not 0.
 *
 * @package Elgg
 * @subpackage Core
 *
 * @uses $vars['value']          The current value or an array of current values if multiple is true
 * @uses $vars['options']        An array of strings or arrays representing the options
 *                               for the dropdown field. If an array is passed,
 *                               the "text" key is used as its text, all other
 *                               elements in the array are used as attributes.
 * @uses $vars['options_values'] An associative array of "value" => "option"
 *                               where "value" is the name and "option" is
 *                               the value displayed on the button. Replaces
 *                               $vars['options'] when defined. When "option"
 *                               is passed as an array, the same behaviour is used
 *                               as when the $vars['options'] is passed an array to.
 * @uses $vars['multiple']       If true, multiselect of values will be allowed in the select box
 * @uses $vars['class']          Additional CSS class
 */
//ditambahkan:select category expert
$vars['class'] = elgg_extract_class($vars, 'elgg-input-dropdown');
if (isset($vars['name']) && $vars['name'] == 'catexpert'){
	$vars['class'] = elgg_extract_class($vars, 'catexpert');
	$vars['options_values'] = 
		array(
			'0' => '',
			'Academic Expert' => 'Academic Expert',
			'Practitioners' => 'Practitioners',	
			'Both Categories' => 'Both Categories',	
		);
/* 		$areaexp =<<<__AE
		<div class="elgg-field">
		<label for="profile-areaexpert" class="elgg-field-label">Area of expertise</label>
		<select name="areaexpert" id="profile-areaexpert" class="areaexpert elgg-input-dropdown">
		<option value="0" selected="selected"></option>
		<option value="Human resources management">Human resources management</option>
		<option value="Public administration">Public administration</option>
		<option value="Both Areas">Both Areas</option>
		</select>
		</div>
__AE; */
	/* $varsch = array();
	$varsch['name'] = 'areaexpert';
	$varsch['class'] = elgg_extract_class($varsch, 'areaexpert hidden');
	$varsch['options'] = 
			array(
				'0' => '',
				'Human resources management' => 'Human resources management',
				'Public administration' => 'Public administration',
				'Both Areas' => 'Both Areas',
			); */
}
 else if (isset($vars['name']) && $vars['name'] == 'areaexpert'){
	$vars['class'] = elgg_extract_class($vars, 'areaexpert');
	$vars['options'] = 
		array(
			'0' => '',
			'Human resources management' => 'Human resources management',
			'Public administration' => 'Public administration',
			'Both Areas' => 'Both Areas',
		);
} 
else if (isset($vars['name']) && $vars['name'] == 'location'){
	$vars['options'] = 
		array(
			'0' => '',
			'Aceh' => 'Aceh',
			'Sumatera Utara' => 'Sumatera Utara',
			'Sumatera Barat' => 'Sumatera Barat',
			'Riau' => 'Riau',
			'Kepulauan Riau' => 'Kepulauan Riau',
			'Jambi' => 'Jambi',
			'Bengkulu' => 'Bengkulu',
			'Sumatera Selatan' => 'Sumatera Selatan',
			'Kepulauan Bangka Belitung' => 'Kepulauan Bangka Belitung',
			'Lampung' => 'Lampung',
			'Banten' => 'Banten',
			'Jawa Barat' => 'Jawa Barat',
			'DKI Jakarta' => 'DKI Jakarta',
			'Jawa Tengah' => 'Jawa Tengah',
			'Yogyakarta' => 'Yogyakarta',
			'Jawa Timur' => 'Jawa Timur',
			'Bali' => 'Bali',
			'Nusa Tenggara Barat' => 'Nusa Tenggara Barat',
			'Nusa Tenggara Timur' => 'Nusa Tenggara Timur',
			'Kalimantan Utara' => 'Kalimantan Utara',
			'Kalimantan Barat' => 'Kalimantan Barat',
			'Kalimantan Tengah' => 'Kalimantan Tengah',
			'Kalimantan Selatan' => 'Kalimantan Selatan',
			'Kalimantan Timur' => 'Kalimantan Timur',
			'Gorontalo' => 'Gorontalo',
			'Sulawesi Utara' => 'Sulawesi Utara',
			'Sulawesi Barat' => 'Sulawesi Barat',
			'Sulawesi Tengah' => 'Sulawesi Tengah',
			'Sulawesi Selatan' => 'Sulawesi Selatan',
			'Sulawesi Tenggara' => 'Sulawesi Tenggara',
			'Maluku Utara' => 'Maluku Utara',
			'Maluku' => 'Maluku',
			'Papua' => 'Papua',
			'Papua Barat' => 'Papua Barat',
		);
}

$defaults = array(
	'disabled' => false,
	'value' => '',
	'options_values' => array(),
	'options' => array(),
);

$vars = array_merge($defaults, $vars);

$options_values = $vars['options_values'];
unset($vars['options_values']);

$options = $vars['options'];
unset($vars['options']);

$value = is_array($vars['value']) ? $vars['value'] : array($vars['value']);
$value = array_map('strval', $value);
unset($vars['value']);

$vars['multiple'] = !empty($vars['multiple']);

// Add trailing [] to name if multiple is enabled to allow the form to send multiple values
if ($vars['multiple'] && !empty($vars['name']) && is_string($vars['name'])) {
    if (substr($vars['name'], -2) != '[]') {
        $vars['name'] = $vars['name'] . '[]';
    }
}

$options_list = '';

if ($options_values) {
	foreach ($options_values as $opt_value => $option) {

		$option_attrs = array(
			'value' => $opt_value,
			'selected' => in_array((string)$opt_value, $value),
		);

		if (is_array($option)) {
			$text = elgg_extract('text', $option, '');
			unset($option['text']);
			if (!$text) {
				elgg_log('No text defined for input/select option with value "' . $opt_value . '"', 'ERROR');
			}

			$option_attrs = array_merge($option_attrs, $option);
		} else {
			$text = $option;
		}

		$options_list .= elgg_format_element('option', $option_attrs, $text);
	}
} else {
	if (is_array($options)) {
		foreach ($options as $option) {

			if (is_array($option)) {
				$text = elgg_extract('text', $option, '');
				unset($option['text']);

				if (!$text) {
					elgg_log('No text defined for input/select option', 'ERROR');
				}

				$option_attrs = [
					'selected' => in_array((string)$text, $value),
				];
				$option_attrs = array_merge($option_attrs, $option);
			} else {
				$option_attrs = [
					'selected' => in_array((string)$option, $value),
				];

				$text = $option;
			}

			$options_list .= elgg_format_element('option', $option_attrs, $text);
		}
	}
}

echo elgg_format_element('select', $vars, $options_list);
//echo "<div>$areaexp</div>";
echo "</div><div>";
//ditambahkan:upload file utk bukti data update
/* if (isset($vars['name']) && $vars['name'] == 'location'){
	echo "<div><label>";
	echo elgg_echo("Please upload document to prove your update."); 
	echo "</label><br />";
	echo elgg_view("input/file",array('name' => 'tes'));
	echo "</div>";
} */

if (isset($vars['name']) && $vars['name'] == 'catexpert'){	
	$sc = <<<__SC
	<script>
	$(document).ready(function() {
		$('.areaexpert').change(function(){
			if($('.areaexpert').val() == "Both Areas"){
				$('.elgg-field-pubadmin').show();
				$('.elgg-field-hrm').show();
			}
			else if($('.areaexpert').val() == "Human resources management"){
				$('.elgg-field-pubadmin').hide();
				$('.elgg-field-hrm').show();
			}
			else if($('.areaexpert').val() == "Public administration"){
				$('.elgg-field-pubadmin').show();
				$('.elgg-field-hrm').hide();
			}
			if($('.areaexpert').val() == 0){
				$('.elgg-field-pubadmin').hide();
				$('.elgg-field-hrm').hide();
			}
		});
	});
	$(document).ready(function() {	
		$('.catexpert').change(function(){	
			$('.elgg-field-pubadmin').hide();
			$('.elgg-field-hrm').hide();
			for(i=0;i<18;i++)
				$('.elgg-input-checkbox')[i].checked = false;
			$('.label-aca').hide();
			$('.label-pra').hide();
			$('.label-file').hide();
		});
	});
	</script>
__SC;
echo $sc;
}
