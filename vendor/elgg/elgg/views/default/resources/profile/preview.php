<!DOCTYPE html>
<html>
<head>
	<title>My Resume</title>
  <?php
// API BKN
$stylesheets = elgg_get_loaded_css();

  foreach ($stylesheets as $url) {
  echo elgg_format_element('link', array('rel' => 'stylesheet', 'href' => $url));
}
?>
</head>
<body>

<?php
//ditambahkan:nip dan user agar bisa GET utk PDF Review
$nip = get_input('preview');
$guid = (int)get_input('page');
$user = get_user($guid);

$tmplahir = '';
$tgllahir = '';
$email = '';
$alamat = '';
$jnspegawai = '';
$jnskelamin = '';
$instansiinduk = '';
$tkPendidikanNamaS1 = '';
$tglLulusS1 = '';
$namaSekolahS1 = '';
$tkPendidikanNamaS2 = '';
$tglLulusS2 = '';
$namaSekolahS2 = '';
$tkPendidikanNamaS3 = '';
$tglLulusS3 = '';
$namaSekolahS3 = '';
$kursus = '';
$jabatan = '';
$contact = $user->hp;

$profile_fields = elgg_get_config('profile_fields');
if (is_array($profile_fields) && count($profile_fields) > 0) {
	foreach ($profile_fields as $shortname => $valtype) {
		$metadata = elgg_get_metadata(array(
			'guid' => $guid,
			'metadata_name' => $shortname,
			'limit' => false
		));
		if ($metadata) {
			if (is_array($metadata)) {
				$value = '';
				foreach ($metadata as $md) {
					if (!empty($value)) {
						$value .= ', ';
					}
					$value .= $md->value;
					$access_id = $md->access_id;
				}
			} else {
				$value = $metadata->value;
				$access_id = $metadata->access_id;
			}
		} else {
			$value = '';
			$access_id = ACCESS_DEFAULT;
		}
		// sticky form values take precedence over saved ones
		if (isset($sticky_values[$shortname])) {
			$value = $sticky_values[$shortname];
		}
		if (isset($sticky_values['accesslevel'][$shortname])) {
			$access_id = $sticky_values['accesslevel'][$shortname];
		}
		$id = "profile-$shortname";
			switch ($shortname) {
				case "tmplahir":
          $tmplahir = $value;
					break;
				case "tgllahir":
          $tgllahir = $value;
					break;
				case "nik":
					break;
				case "alamat":
					$alamat = $value;
					break;
        case "jnspegawainama":
          $jnspegawai = $value;
					break;
				case "kedudukanpnsnama":
					break;
				case "statuspegawai":
					break;
        case "jenisKelamin":
          $jnskelamin = $value;
					break;
				case "jenisiddokumennama":
					break;
				case "noSeriKarpeg":
					break;
				case "tkPendidikanTerakhir":
					break;
				case "pendidikanTerakhirNama":
					break;
				case "tahunLulus":
					break;
				case "tmtpns":
					break;
				case "tglskpns":
					break;
				case "tmtcpns":
					break;
				case "tglskcpns":
					break;
				case "latihanstrukturalnama":
					break;
        case "instansiIndukNama":
          $instansiinduk = $value;
					break;
				case "satuanKerjaIndukNama":
					break;
				case "instansiKerjaNama":
					break;
				case "satuanKerjaKerjaNama":
					break;
				case "unorNama":
					break;
				case "unorIndukNama":
					break;
				case "jenisJabatan":
					break;
				case "jabatanNama":
					break;
				case "jabatanStrukturalNama":
					break;
				case "tmtJabatan":
					break;
				case "lokasiKerja":
					break;
				case "golRuangAwal":
					break;
				case "golRuangAkhir":
					break;
				case "tmtGolAkhir":
					break;
				case "masaKerja":
					break;
				case "eselon":
					break;
				case "eselonLevel":
					break;
				case "tmtEselon":
					break;
				case "kpknNama":
					break;
				case "ktuaNama":
					break;
				case "tglSttpl":
					break;
				case "jabatanAsn":
					break;
				case "tkPendidikanNamaSd":
						break;
				case "tglLulusSd":
						break;
				case "namaSekolahSd":
						break;
				case "tkPendidikanNamaSmp":
						break;
				case "tglLulusSmp":
						break;
				case "namaSekolahSmp":
						break;
				case "tkPendidikanNamaSma":
						break;
				case "tglLulusSma":
						break;
				case "namaSekolahSma":
						break;
        case "tkPendidikanNamaS1":
          	break;
        case "tglLulusS1":
            $tglLulusS1 = $value;
						break;
        case "namaSekolahS1":
            $namaSekolahS1 = $value;
						break;
        case "tkPendidikanNamaS2":
            $tkPendidikanNamaS2 = $value;
						break;
        case "tglLulusS2":
            $tglLulusS2 = $value;
						break;
        case "namaSekolahS2":
            $namaSekolahS2 = $value;
						break;
        case "tkPendidikanNamaS3":
            $tkPendidikanNamaS3 = $value;
						break;
        case "tglLulusS3":
            $tglLulusS3 = $value;
						break;
        case "namaSekolahS3":
            $namaSekolahS3 = $value;
						break;
        case "kursus":
            $kursus = $value;
						break;
        case "jabatan":
            $jabatan = $value;
						break;
				default:
					$input = elgg_view("input/$valtype", [
						'name' => $shortname,
						'value' => $value,
						'id' => $id,
					]);
			}
	}
}
$name = htmlspecialchars($user->name, ENT_QUOTES, 'UTF-8', false);
$icon = elgg_view('output/img', array(
	'src' => $user->getIconURL('large'),
	//'vrf' => $vrf, 
	'alt' => $name,
	'title' => $name,
//	'class' => "photo u-photo",
  'class' => "profile-image",
));

if ($namaSekolahS1 != ""){
  $pnddkn[] =  array("namaSekolah" => $namaSekolahS1, "tglLulus" => $tglLulusS1, "pendidikan" => $tkPendidikanNamaS1);
}

if ($namaSekolahS2 != ""){
  $pnddkn[] =  array("namaSekolah" => $namaSekolahS2, "tglLulus" => $tglLulusS2, "pendidikan" => $tkPendidikanNamaS2);

}

if ($namaSekolahS3 != ""){
  $pnddkn[] =  array("namaSekolah" => $namaSekolahS3, "tglLulus" => $tglLulusS3, "pendidikan" => $tkPendidikanNamaS3);

}

$json_obj2 = '';
$json_pendidikan = '';
$json_kursus = '';

?>
	<div class="container">
	
		<div class="sidebar">
			<div class="sidebar-top">
      <?php
      echo "<a>$icon</a>";
      ?>
				<!-- <img class="profile-image" src="http://demo.deviserweb.com/cv/assets/images/profile-img.jpg" /> -->
				<div class="profile-basic">
          <h2 class="name"><?php echo($user->name);?></h2>
				</div>
			</div>

			<div class="profile-info">
				<p class="key">NIP : </p>
        <p class="value"><?php echo($user->nip); ?></p>
			</div>

			<div class="profile-info">
				<p class="key">Tempat Lahir: </p>
				<p class="value"><?php echo($tmplahir) ?></p>
			</div>

			<div class="profile-info">
				<p class="key">Tanggal Lahir : </p>
				<p class="value"><?php echo($tgllahir) ?></p>
			</div>

			<div class="profile-info">
				<p class="key">Contact : </p>
				<p class="value"><?php echo($user->hp) ?></p>
			</div>

			<div class="profile-info">
				<p class="key" >Email : </p>
				<p class="value" ><?php echo($user->email) ?></p>
			</div>

			<div class="profile-info">
				<p class="key" >Alamat : </p>
				<p class="value" >
					<?php echo($alamat) ?>
				</p>
			</div>

			<div class="profile-info">
				<p class="key" >Jenis Pegawai : </p>
				<p class="value" ><?php echo($jnspegawai) ?></p>
			</div>

			<div class="profile-info">
				<p class="key" >Jenis Kelamin : </p>
				<p class="value" ><?php echo($jnskelamin) ?></p>
			</div>

			<div class="profile-info">
				<p class="key" >Instansi Induk : </p>
				<p class="value" ><?php echo($instansiinduk) ?></p>
			</div>

			<!-- <div class="profile-info">
				<a class="social-media" href="https://facebook.com/" target="_blank" >Facebook</a>
				<a class="social-media" href="https://linkedin.com/" target="_blank" >Linkedin</a>
				<a class="social-media" href="https://twitter.com/" target="_blank" >Twitter</a>
				<a class="social-media" href="https://instagram.com/" target="_blank" >Instagram</a>
			</div> -->
		</div>

		<div class="content">
			<div class="work-experience">
				<h1 class="heading">Pendidikan</h1>
				<?php
					for($i = 0; $i < count($pnddkn); $i++){
						// $isikursus .= 'Nama Kursus: ' . $json_kursus['data'][$i]['namaKursus'] . ' Tanggal Kursus: ' . $json_kursus['data'][$i]['tanggalKursus'] . ' Institusi Penyelenggara: ' . $json_kursus['data'][$i]['institusiPenyelenggara'] . '<br><br>';
				?>	
				<div class="info">
					<p class="sub-heading"><?php echo($pnddkn[$i]['namaSekolah'])?></p>
					<p class="sub-heading"><?php echo($pnddkn[$i]['pendidikan'])?></p>
					<p class="duration"><?php echo($pnddkn[$i]['tglLulus'])?></p>
					<!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua.</p> -->
				</div>
				<?php		
					}
				?>

				<!-- <div class="info">
					<p class="sub-heading">Creative Director @DeviserWeb</p>
					<p class="duration">JAN 2016 - DEC 2016</p>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua.</p>
				</div>
				<div class="info">
					<p class="sub-heading">Graphics Designer @Creative Wrold</p>
					<p class="duration">JAN 2016 - DEC 2016</p>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua.</p>
				</div> -->
			</div>
			<div class="education">
				<h1 class="heading">Kursus</h1>
				<?php
					// for($i = 0; $i < count($json_kursus['data']); $i++){
				?>	
						<div class="info">
						
							<p class="sub-heading"><?php echo($kursus)// echo($json_kursus['data'][$i]['namaKursus'])?></p>
							<!-- <p class="sub-heading"><?php// echo($json_kursus['data'][$i]['institusiPenyelenggara'])?></p>
							<p class="duration"><?php// echo($json_kursus['data'][$i]['tanggalKursus'])?></p> -->
							<!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua.</p> -->
						</div>
				<?php		
					// }
				?>
      </div>
      <div class="education">
				<h1 class="heading">Jabatan</h1>
				<?php
					// for($i = 0; $i < count($json_kursus['data']); $i++){
				?>	
						<div class="info">
						
							<p class="sub-heading"><?php echo($jabatan)// echo($json_kursus['data'][$i]['namaKursus'])?></p>
							<!-- <p class="sub-heading"><?php// echo($json_kursus['data'][$i]['institusiPenyelenggara'])?></p>
							<p class="duration"><?php// echo($json_kursus['data'][$i]['tanggalKursus'])?></p> -->
							<!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua.</p> -->
						</div>
				<?php		
					// }
				?>
			</div>
		</div>
	</div>
</body>
</html>

