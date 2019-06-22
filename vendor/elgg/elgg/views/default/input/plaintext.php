<?php
/**
 * Elgg long text input (plaintext)
 * Displays a long text input field that should not be overridden by wysiwyg editors.
 *
 * @package Elgg
 * @subpackage Core
 *
 * @uses $vars['value']    The current value, if any
 * @uses $vars['name']     The name of the input field
 * @uses $vars['class']    Additional CSS class
 * @uses $vars['disabled']
 */
//diubah rows untuk declaration
$vars['class'] = elgg_extract_class($vars, 'elgg-input-plaintext');
$defaults = array(
	'value' => '',
	'rows' => '12',
	'cols' => '55',
	'disabled' => false,
);

if ($vars['name'] == declaration){
	$vars['value'] = "Dengan ini saya menyatakan telah dan sanggup memenuhi persyaratan sebagai expert:
a. Has experiences on civil service matters or has worked/ been working as civil service consultant in 
    national and/or international level, especially in ASEAN countries;
b. Recommended by the relevant government institution/ other professional agency;
c. Fulfil the code of conducts (coc) as an expert for example aviod plagiarism and criminal case;
d. Be able to work independently (Independent term should be interpreted as free from outside 
    interference with his/her work (integrity, truthful, etc); dan
e. Saya menyatakan bertanggung jawab atas kebenaran seluruh data yang saya masukkan dan dokumen
    yang saya unggah ke situs A-EXPECS. Segala bentuk kerugian negara dan pertanggungjawaban secara
    hukum yang terjadi sebagai akibat dari tindakan saya, baik sengaja maupun tidak disengaja akan
    menjadi tanggung jawab saya sesuai ketentuan peraturan perundang-undangan yang berlaku.";
$defaults['disabled'] = true; 
}

$vars = array_merge($defaults, $vars);

$value = htmlspecialchars($vars['value'], ENT_QUOTES, 'UTF-8');
unset($vars['value']);

echo elgg_format_element('textarea', $vars, $value);

//$input_vars['checked'] = true;
//$input_vars['value'] = '1';
//$input_vars['label'] = 'Wajib dicentang sebelum data disimpan.';
//$input = elgg_view('input/checkbox', $input_vars);