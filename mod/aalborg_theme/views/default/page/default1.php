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
				<a href="" class="a">Profile</a>
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
	<font class="teks2">Welcome to ASEAN Resource Centre (ARC)</font><br><br>
	<p align="justify" class="teks3">Wakil-wakil negara anggota ASEAN menyambut baik konsep yang dikembangkan Indonesia mengenai A-EXPECS guna memperkuat kerja sama bidang kepegawaian ASEAN. Pandangan tersebut disampaikan oleh para peserta "ASEAN Research Center Workshop on Formulating Concept: ASEAN Pool of Experts on Civil Service" yang diselenggarakan oleh Badan Kepegawaian Negara (BKN) tanggal 19-20 September 2018 di Yogyakarta.<br><br>

Wakil Indonesia terdiri dari unsur BKN, Kemenpora, Kemenkes, Kemen PUPR, Kemenko PMK, Balai Pengukuran Kompetensi Pegawai Pemprov Yogyakarta, BKD Pemkot Bogor, BKD Pemkot Sumbar, BKD Pemprov Sumut dan BKPP Kabupaten Banyuwangi. Kemlu diwakili Dit. KSBA Ditjen Kerja Sama ASEAN.<br><br>

A-EXPECS merupakan pengembangan skema ASEAN Resource Center, yang telah digagas BKN sejak tahun 1985, yang diarahkan untuk membangun kapasitas sumber daya manusia. Mekanisme A-EXPECS diharapkan dapat menyediakan data dan informasi mengenai para ahli di berbagai bidang yang dibutuhkan negara-negara ASEAN guna melaksanakan berbagai kegiatan yg direncanakan. A-EXPECS juga dapat menjadi media tukar informasi mengenai berbagai kegiatan di bidang pelayanan sektor publik.<br><br>

BKN merencanakan akan meluncurkan program A-EXPECS pada tahun 2019 setelah melakukan perbaikan sesuai dengan masukan yang disampaikan para peserta workshop, yang antara lain mencakup definisi dan kriteria seorang ahli, bidang keahlian, mekanisme pengumpulan dan verifikasi nama-nama para ahli serta pemeliharaan dan pengembangan sistemnya.<br><br>

BKN juga akan melaporkan hasil workshop pada pertemuan tingkat pejabat tinggi (SOM) dan tingkat Kepala (Head) badan sektoral ASEAN Cooperation on Civil Service Matters (ACCSM) yang akan berlangsung tanggal 23-25 Oktober 2018 di Singapura.<br><br>

Workshop secara resmi dibuka oleh Kepala BKN, Bima Haria Wibisana, dan diawali dengan jamuan makan malam oleh Wakil Gubernur Yogyakarta, Paku Alam X, di Kompleks Kepatihan/Kantor Gubernur Yogyakarta. Workshop ditutup oleh Deputi Pembinaan Manajemen Kepegawaian BKN, Haryomo Dwi Putranto (Sumber: Direktorat Kerja Sama Sosial Budaya ASEAN).<br><br>
</p>
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
if ($vtit != "Web Service" && $vtit != "Choose Nation:" && $vtit != "Register" && !elgg_is_logged_in()){
$body .= <<<__BODY
		$aexp
		$content
__BODY;
}
else if (!elgg_is_logged_in())
	$body .= $content;


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
