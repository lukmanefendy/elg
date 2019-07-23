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

$lang = get_input('lang');
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
	
	<td width="35%" align="left">
		<a href="http://accsm-indonesia.bkn.go.id/" class="borderit2"><img src="images/LogoACCSM3.png"></a>
	</td>
	<td width="5%" align="right" class="leftborder">
	</br>
	English:</br>
		<a href="?lang=en" class="borderit"><img src="images/BenderaInggris.png" width="50px"></a>
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
				<a href="index?lang=id" class="a">Profile</a>
			</td>
		</tr>
		<tr>
			<td width="85%" height="40">
				<a href="rekomen?lang=id" class="a">Rekomendasi</a>
			</td>
		</tr>
		<tr>
			<td width="85%" height="40">
				<a href="kriteria?lang=id" class="a">Kriteria Pakar</a>
			</td>
		</tr>
		<tr>
			<td width="85%" height="40">
				<a href="area?lang=id" class="a">Area 
					Kepakaran
				</a>
			</td>
		</tr>
		<tr>
			<td width="85%" height="40">
				<a href="cara?lang=id" class="a">Cara Mendaftar</a>
			</td>
		</tr>
	</table>
</div>

<div class="col-md-6">
	<br><br>
    <font class="teks2">Area Kepakaran</font><br><br>
    
		<img src="images/areaexpertise.png" style="width:600px;height:500px;" /><br /><br />
    <!-- <img src="images/areaexpertise.png" vspace="1"><br> -->
</div>

__AEXP;

if ($lang == "en"){
	$aexp = <<<__AEXPE
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
		<td width="35%" align="left">
			<a href="http://accsm-indonesia.bkn.go.id/" class="borderit2"><img src="images/LogoACCSM3.png"></a>
		</td>
		<td width="5%" align="right" class="leftborder">
		</br>
		Indonesia:</br>
			<a href="?lang=id" class="borderit"><img src="images/BenderaIndonesia.png" width="50px"></a>
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
				<td width="85%" height="50" class="teks4" valign="top">Main Menu</td>
			</tr>
			<tr>
				<td width="85%" height="40">
					<a href=index"?lang=en" class="a">Profile</a>
				</td>
			</tr>
			<tr>
				<td width="85%" height="40">
					<a href="rekomen?lang=en" class="a">Recommendation</a>
				</td>
			</tr>
			<tr>
				<td width="85%" height="40">
					<a href="kriteria?lang=en" class="a">Criteria of Expertise</a>
				</td>
			</tr>
			<tr>
				<td width="85%" height="40">
					<a href="area?lang=en" class="a">Area of Expertise 
					</a>
				</td>
			</tr>
			<tr>
				<td width="85%" height="40">
					<a href="cara?lang=en" class="a">Registration Method</a>
				</td>
			</tr>
		</table>
	</div>
	<div class="col-md-6">
	<br><br>
    <font class="teks2">Area of Expertise</font><br><br>
    
		<img src="images/areaexpertise.png" style="width:600px;height:500px;" /><br /><br />
    <!-- <img src="images/areaexpertise.png" vspace="1"><br> -->
</div>
__AEXPE;
		
}

 
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
