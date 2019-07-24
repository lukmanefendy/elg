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
$name = htmlspecialchars($user->name, ENT_QUOTES, 'UTF-8', false);
$icon = elgg_view('output/img', array(
	'src' => $user->getIconURL('large'),
	//'vrf' => $vrf, 
	'alt' => $name,
	'title' => $name,
//	'class' => "photo u-photo",
  'class' => "profile-image",
));

$json_obj2 = '';
$json_pendidikan = '';
$json_kursus = '';

$curl = curl_init();
  curl_setopt_array($curl, array(
      CURLOPT_URL => "https://wsrv-auth.bkn.go.id/oauth/token",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "client_id=renkalclient&grant_type=client_credentials&undefined=",
      CURLOPT_HTTPHEADER => array(
      "Authorization: Basic cmVua2FsY2xpZW50OjEyMzQ1Njc4OQ==",
      "Content-Type: application/x-www-form-urlencoded",
      "Origin: http://localhost:20000",
      "Postman-Token: 6ff3ace6-5949-4473-8c48-3694cfb343e1",
      "cache-control: no-cache"),
      /* CURLOPT_HTTPHEADER => array(
      "Authorization: Basic cmVua2FsY2xpZW50OjEyMzQ1Njc4OQ==",
      "Content-Type: application/x-www-form-urlencoded",
      "Origin: http://localhost:20000",
      "Postman-Token: d7ddc0a4-37af-41f0-ae98-7f79ba5a46e4",
      "cache-control: no-cache"
      ), */
  ));
  
  $response = curl_exec($curl);
  // echo $response;
  $err = curl_error($curl);
  
  curl_close($curl);
  
  if ($err) {
      
      echo "cURL Error #:" . $err;
  
  } else {
    //   echo $response;
      $json_obj0 = json_decode($response);
      // echo $json_obj0->access_token;
      //$token = "https://wsrv.bkn.go.id/api/pns/data-utama/".$json_obj0->access_token;
      $curl2 = curl_init();
      curl_setopt_array($curl2, array(
          // CURLOPT_URL => "https://wsrv.bkn.go.id/api/pns/data-utama/196302081991031001",
          CURLOPT_URL => "https://wsrv.bkn.go.id/api/pns/data-utama/$nip",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_POSTFIELDS => "",
          CURLOPT_HTTPHEADER => array(
          "Authorization: Bearer ".$json_obj0->access_token,
          // "Authorization: Bearer 7aaece55-2800-4a78-9cfd-5a3a5f50a153",
          "Content-Type: application/x-www-form-urlencoded",
          "Origin: http://localhost:20000",
          "Postman-Token: 2d9c3c24-39cf-4431-8a98-c22b7694ae50",
          "cache-control: no-cache"),
      ));
  
      $curlpendidikan = curl_init();
        curl_setopt_array($curlpendidikan, array(
          CURLOPT_URL => "https://wsrv.bkn.go.id/api/pns/rw-pendidikan/$nip",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_POSTFIELDS => "",
          CURLOPT_HTTPHEADER => array(
          "Authorization: Bearer ".$json_obj0->access_token,
            // "Authorization: Bearer 7aaece55-2800-4a78-9cfd-5a3a5f50a153",
            "Content-Type: application/x-www-form-urlencoded",
            "Origin: http://localhost:20000",
            "Postman-Token: 2d9c3c24-39cf-4431-8a98-c22b7694ae50",
            "cache-control: no-cache"
          ),
        ));
        
      $curlkursus = curl_init();
        curl_setopt_array($curlkursus, array(
          CURLOPT_URL => "https://wsrv.bkn.go.id/api/pns/rw-kursus/$nip",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_POSTFIELDS => "",
          CURLOPT_HTTPHEADER => array(
          "Authorization: Bearer ".$json_obj0->access_token,
              // "Authorization: Bearer 7aaece55-2800-4a78-9cfd-5a3a5f50a153",
              "Content-Type: application/x-www-form-urlencoded",
              "Origin: http://localhost:20000",
              "Postman-Token: 2d9c3c24-39cf-4431-8a98-c22b7694ae50",
              "cache-control: no-cache"
          ),
        ));
      
      $datut = curl_exec($curl2);
      $datpendidikan = curl_exec($curlpendidikan);
      $datkursus = curl_exec($curlkursus);
  
      // echo $datut; 
      // echo $datpendidikan;
      // echo $datkursus;
      $isikursus = '';
              
      $err = curl_error($curl2);
      $errpendidikan = curl_error($curlpendidikan);
      $errkursus = curl_error($curlkursus);
  
      curl_close($curl2);
      curl_close($curlpendidikan);
      curl_close($curlkursus);
  
      if ($err) {
  
          echo "cURL Error #:" . $err;
  
      } else {
          $datutres = stripslashes($datut);
          $json_obj = json_decode($datut,true);
          $json_obj2 = json_decode($json_obj['data'],true);
      }
  
      if ($errpendidikan) {
  
          echo "cURL Error #:" . $errpendidikan;
  
      } else {
          $datpendidikanres = stripslashes($datpendidikan);
          $json_pendidikan = json_decode($datpendidikan,true);
          $json_pendidikan2 = $json_pendidikan['data'][0]['id'];
  
      }
  
      if ($errkursus) {
  
          echo "cURL Error #:" . $errkursus;
  
      } else {
          $datkursusres = stripslashes($datkursus);
          $json_kursus = json_decode($datkursus,true);
          $json_kursus2 = $json_kursus['data'][0]['id'];
  
        //   for($i = 0; $i < count($json_kursus['data']); $i++){
        //       $isikursus .= 'Nama Kursus: ' . $json_kursus['data'][$i]['namaKursus'] . ' Tanggal Kursus: ' . $json_kursus['data'][$i]['tanggalKursus'] . ' Institusi Penyelenggara: ' . $json_kursus['data'][$i]['institusiPenyelenggara'] . '<br><br>';
        //   }
      }
    }

  // END API BKN

?>
	<div class="container">
	
		<div class="sidebar">
			<div class="sidebar-top">
      <?php
      echo "<a>$icon</a>";
      ?>
				<!-- <img class="profile-image" src="http://demo.deviserweb.com/cv/assets/images/profile-img.jpg" /> -->
				<div class="profile-basic">
					<h2 class="name"><?php echo($json_obj2['gelarDepan']. " " . $json_obj2['nama']. " " . $json_obj2['gelarBelakang'])?></h2>
				</div>
			</div>

			<div class="profile-info">
				<p class="key">NIP : </p>
				<p class="value"><?php echo($json_obj2['nipBaru']) ?></p>
			</div>

			<div class="profile-info">
				<p class="key">Tempat Lahir: </p>
				<p class="value"><?php echo($json_obj2['tempatLahir']) ?></p>
			</div>

			<div class="profile-info">
				<p class="key">Tanggal Lahir : </p>
				<p class="value"><?php echo($json_obj2['tglLahir']) ?></p>
			</div>

			<div class="profile-info">
				<p class="key">Contact : </p>
				<p class="value"><?php echo($json_obj2['noHp']) ?></p>
			</div>

			<div class="profile-info">
				<p class="key" >Email : </p>
				<p class="value" ><?php echo($json_obj2['email']) ?></p>
			</div>

			<div class="profile-info">
				<p class="key" >Alamat : </p>
				<p class="value" >
					<?php echo($json_obj2['alamat']) ?>
				</p>
			</div>

			<div class="profile-info">
				<p class="key" >Jenis Pegawai : </p>
				<p class="value" ><?php echo($json_obj2['jenisPegawaiNama']) ?></p>
			</div>

			<div class="profile-info">
				<p class="key" >Jenis Kelamin : </p>
				<p class="value" ><?php echo($json_obj2['jenisKelamin']) ?></p>
			</div>

			<div class="profile-info">
				<p class="key" >Instansi Induk : </p>
				<p class="value" ><?php echo($json_obj2['instansiIndukNama']) ?></p>
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
					for($i = 3; $i < count($json_pendidikan['data']); $i++){
						// $isikursus .= 'Nama Kursus: ' . $json_kursus['data'][$i]['namaKursus'] . ' Tanggal Kursus: ' . $json_kursus['data'][$i]['tanggalKursus'] . ' Institusi Penyelenggara: ' . $json_kursus['data'][$i]['institusiPenyelenggara'] . '<br><br>';
				?>	
				<div class="info">
					<p class="sub-heading"><?php echo($json_pendidikan['data'][$i]['pendidikanNama'])?></p>
					<p class="sub-heading"><?php echo($json_pendidikan['data'][$i]['namaSekolah'])?></p>
					<p class="sub-heading"><?php echo($json_pendidikan['data'][$i]['tkPendidikanNama'])?></p>
					<p class="duration"><?php echo($json_pendidikan['data'][$i]['tahunLulus'])?></p>
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
					for($i = 0; $i < count($json_kursus['data']); $i++){
				?>	
						<div class="info">
						
							<p class="sub-heading"><?php echo($json_kursus['data'][$i]['namaKursus'])?></p>
							<p class="sub-heading"><?php echo($json_kursus['data'][$i]['institusiPenyelenggara'])?></p>
							<p class="duration"><?php echo($json_kursus['data'][$i]['tanggalKursus'])?></p>
							<!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua.</p> -->
						</div>
				<?php		
					}
				?>
			</div>
		</div>
	</div>
</body>
</html>