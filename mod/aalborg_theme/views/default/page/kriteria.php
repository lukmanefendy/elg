<?php
/**
 * Elgg pageshell
 * The standard HTML page shell that everything else fits into
 *
 * @package Elgg
 * @subpackage Core
 *
 * @uses $vars['head']        Parameters for the <head> element
 * @uses $vars['body_attrs']  Attributes of the <body> tag
 * @uses $vars['body']        The main content of the page
 * @uses $vars['sysmessages'] A 2d array of various message registers, passed from system_messages()
 */

// render content before head so that JavaScript and CSS can be loaded. See #4032

$messages = elgg_view('page/elements/messages', array('object' => $vars['sysmessages']));


//ditambahkan apa yang diperlukan untuk halaman selain halaman depan
//membuat isi keluaran halaman depan
if (elgg_is_logged_in()) {
	$header = elgg_view('page/elements/header', $vars);
	$navbar = elgg_view('page/elements/navbar', $vars);
	$content = elgg_view('page/elements/body', $vars);
	//$footer = elgg_view('page/elements/footer', $vars);
}
  else {
	$header = elgg_view('page/elements/header', $vars);	
	$content = elgg_view('page/elements/body', $vars);
}  

//ditambahkan utk membuat halaman depan aexpecs, $header jadi $front

$aexp = <<<__AEXP
<script>
	var imageSources = ["images/111.png", "images/ExpertRev.png"]
	var index = 0;
	setInterval (function(){
	  if (index === imageSources.length) {
		index = 0;
	  }
	  document.getElementById("image").src = imageSources[index];
	  index++;
	} , 5000);
</script>
<table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0">
<tr>
	<td width="35%" align="center">
		<img src="images/ARCKAL.png">
	</td>
	<td width="25%">
		<img src="images/kontak.png">
	</td>
	<td width="40%" align="left">
		<a href="index.php" class="borderit2"><img src="images/LogoACCSM3.png"></a>
	</td>
</tr>
</table>
<table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0">
<tr>
	<td width="100%" height="310">
		<img id="image" src="images/1Rev.png" width="100%" height="311">
	</td>
</tr>
</table>
<div class="col-md-2">
	<br />
	<table border="0" width="100%" height="170" cellpadding="0" cellspacing="0">
		<tr>
			<td width="15%" height="50" rowspan="40"></td>
			<td width="85%" height="50" class="teks4" valign="top">Menu Utama</td>
		</tr>
		<tr>
			<td width="85%" height="40">
				<a href="profile" class="a">Profile</a>
			</td>
		</tr>
		<tr>
			<td width="85%" height="40">
				<a href="rekomen" class="a">Rekomendasi</a>
			</td>
		</tr>
		<tr>
			<td width="85%" height="40">
				<a href="kriteria" class="a">Kriteria Pakar</a>
			</td>
		</tr>
		<tr>
			<td width="85%" height="40">
				<a href="area" class="a">Area 
					Kepakaran
				</a>
			</td>
		</tr>
		<tr>
			<td width="85%" height="40">
				<a href="cara" class="a">Cara Mendaftar</a>
			</td>
		</tr>
	</table>
</div>

<div class="col-md-6">
	<br><br>
    <font class="teks2">Kriteria Kepakaran</font><br><br>
    <font class="teks2">A. General criteria:</font><br><br>
    <!-- <p align="justify" class="teks3">A. General criteria:<br><br> -->
    <font class="text3"><b>(1) Mandatory</b></font><br><br>
a. Has experiences on civil service matters or has worked/ been
working as civil service consultant in national and/or international
level, especially in ASEAN countries.<br><br>
b. Recommended by the relevant government institution/ other
professional agency.<br><br>
c. Fulfil the code of conducts (coc) as an expert for example aviod
plagiarism and criminal case.<br><br>
d. Be able to work independently (Independent term should be
interpreted as free from outside interference with his/her work
(integrity, truthful, etc).<br><br>


<font class="text3"><b>(2) Optional</b></font><br><br>
a. Be able to communicate in foreign language(s).
b. Has experiences as a speaker(s) or presenter(s) in
national/international forum which is relevant to his/her expertise,
especially in ASEAN.<br><br>


<!-- <p align="justify" class="teks3">B. Specific criteria:<br><br> -->
<font class="teks2">B. Specific criteria:</font><br><br>
1) For academic expert: has scientific publication (research, article, book,
policy brief) that has been published in media/national/international
journal that is relevant to his/her expertise.<br><br>
2) For practitioners: has a life time certificate/recommendation without
renewal and experiences of Involvement in some event and agendas
which is validated by authorities that is relevant with his/her expertise.
</p><br><br>
</div>

__AEXP;


 
//$content .= $aexp;
//View halaman pertama
$body = <<<__BODY
<div class="elgg-page elgg-page-default">
	<div class="elgg-page-messages">
		$messages
	</div>
__BODY;

$body .= elgg_view('page/elements/topbar_wrapper', $vars);

if (elgg_is_logged_in()) 
 $body .= <<<__BODY
	<div class="elgg-page-header">
		<div class="elgg-inner">
			$header
		</div>
	</div>
	<div class="elgg-page-navbar">
		<div class="elgg-inner">
			$navbar
		</div>
	</div>
	<div class="elgg-page-body">
		<div class="elgg-inner">
			$content
		</div>
	</div>
	<div class="elgg-page-footer">
		<div class="elgg-inner">
			$footer
		</div>
	</div>
</div>
__BODY;
 
else
/* $body .= <<<__BODY
		$aexp
	<div class="col-md-4">
		$content
   </div>
__BODY;
 */
$vtit=$vars['title'];
if ($vtit != "Web Service" && $vtit != "Choose Nation:" && $vtit != "Register"){
$body .= <<<__BODY
		$aexp
		$content
__BODY;
}
else $body .= $content;


$body .= elgg_view('page/elements/foot');

	$head = elgg_view('page/elements/head', $vars['head']);

$params = array(
	'head' => $head,
	'body' => $body,
);

if (isset($vars['body_attrs'])) {
	$params['body_attrs'] = $vars['body_attrs'];
}

echo elgg_view("page/elements/html", $params);
