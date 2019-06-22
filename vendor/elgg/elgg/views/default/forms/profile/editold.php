<?php
/**
 * Edit profile form
 *
 * @tip Use 'profile:fields','profile' hook to modify profile fields configuration.
 * Profile fields are configuration as an array of $shortname => $input_type pairs,
 * where $shortname is the metadata name used to store the value, and the $input_type is
 * an input view used to render the field input element.
 *
 * @uses vars['entity']
 */
$entity = elgg_extract('entity', $vars);
echo elgg_view_field(array(
	'#type' => 'text',
	'name' => 'name',
	'value' => $entity->name,
	'#label' => elgg_echo('user:name:label'),
	'maxlength' => 50, // hard coded in /actions/profile/edit
));
$nip = $entity->nip;
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
	// echo $response;
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
	
	$datut = curl_exec($curl2);
	// echo $datut; 		
	$err = curl_error($curl2);
	
	curl_close($curl2);
	
	if ($err) {
		echo "cURL Error #:" . $err;
	} else {
		$datutres = stripslashes($datut);
		$json_obj = json_decode($datut,true);
		$json_obj2 = json_decode($json_obj['data'],true);
	}
}
$sticky_values = elgg_get_sticky_values('profile:edit');
$profile_fields = elgg_get_config('profile_fields');
if (is_array($profile_fields) && count($profile_fields) > 0) {
	foreach ($profile_fields as $shortname => $valtype) {
		$metadata = elgg_get_metadata(array(
			'guid' => $entity->guid,
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
		if ($value == ""){
			switch ($shortname) {
				case "tmplahir":
					$input = elgg_view("input/$valtype", [
						'name' => $shortname,
						'value' => $json_obj2['tempatLahir'],
						'id' => $id,
					]);
					break;
				case "tgllahir":
					$input = elgg_view("input/$valtype", [
						'name' => $shortname,
						'value' => $json_obj2['tglLahir'],
						'id' => $id,
					]);
					break;
				case "nik":
					$input = elgg_view("input/$valtype", [
						'name' => $shortname,
						'value' => $json_obj2['nik'],
						'id' => $id,
					]);
					break;
				case "alamat":
					$input = elgg_view("input/$valtype", [
						'name' => $shortname,
						'value' => $json_obj2['alamat'],
						'id' => $id,
					]);
					break;
				case "jnspegawainama":
					$input = elgg_view("input/$valtype", [
						'name' => $shortname,
						'value' => $json_obj2['jenisPegawaiNama'],
						'id' => $id,
					]);
					break;
				case "kedudukanpnsnama":
					$input = elgg_view("input/$valtype", [
						'name' => $shortname,
						'value' => $json_obj2['kedudukanPnsNama'],
						'id' => $id,
					]);
					break;
				case "statuspegawai":
					$input = elgg_view("input/$valtype", [
						'name' => $shortname,
						'value' => $json_obj2['statusPegawai'],
						'id' => $id,
					]);
					break;
				case "jenisKelamin":
					$input = elgg_view("input/$valtype", [
						'name' => $shortname,
						'value' => $json_obj2['jenisKelamin'],
						'id' => $id,
					]);
					break;
				case "jenisiddokumennama":
					$input = elgg_view("input/$valtype", [
						'name' => $shortname,
						'value' => $json_obj2['jenisIdDokumenNama'],
						'id' => $id,
					]);
					break;
				case "noSeriKarpeg":
					$input = elgg_view("input/$valtype", [
						'name' => $shortname,
						'value' => $json_obj2['noSeriKarpeg'],
						'id' => $id,
					]);
					break;
				case "tkPendidikanTerakhir":
					$input = elgg_view("input/$valtype", [
						'name' => $shortname,
						'value' => $json_obj2['tkPendidikanTerakhir'],
						'id' => $id,
					]);
					break;
				case "pendidikanTerakhirNama":
					$input = elgg_view("input/$valtype", [
						'name' => $shortname,
						'value' => $json_obj2['pendidikanTerakhirNama'],
						'id' => $id,
					]);
					break;
				case "tahunLulus":
					$input = elgg_view("input/$valtype", [
						'name' => $shortname,
						'value' => $json_obj2['tahunLulus'],
						'id' => $id,
					]);
					break;
				case "tmtpns":
					$input = elgg_view("input/$valtype", [
						'name' => $shortname,
						'value' => $json_obj2['tmtPns'],
						'id' => $id,
					]);
					break;
				case "tglskpns":
					$input = elgg_view("input/$valtype", [
						'name' => $shortname,
						'value' => $json_obj2['tglSkPns'],
						'id' => $id,
					]);
					break;
				case "tmtcpns":
					$input = elgg_view("input/$valtype", [
						'name' => $shortname,
						'value' => $json_obj2['tmtCpns'],
						'id' => $id,
					]);
					break;
				case "tglskcpns":
					$input = elgg_view("input/$valtype", [
						'name' => $shortname,
						'value' => $json_obj2['tglSkCpns'],
						'id' => $id,
					]);
					break;
				case "latihanstrukturalnama":
					$input = elgg_view("input/$valtype", [
						'name' => $shortname,
						'value' => $json_obj2['latihanStrukturalNama'],
						'id' => $id,
					]);
					break;
				case "instansiIndukNama":
					$input = elgg_view("input/$valtype", [
						'name' => $shortname,
						'value' => $json_obj2['instansiIndukNama'],
						'id' => $id,
					]);
					break;
				case "satuanKerjaIndukNama":
					$input = elgg_view("input/$valtype", [
						'name' => $shortname,
						'value' => $json_obj2['satuanKerjaIndukNama'],
						'id' => $id,
					]);
					break;
				case "instansiKerjaNama":
					$input = elgg_view("input/$valtype", [
						'name' => $shortname,
						'value' => $json_obj2['instansiKerjaNama'],
						'id' => $id,
					]);
					break;
				case "satuanKerjaKerjaNama":
					$input = elgg_view("input/$valtype", [
						'name' => $shortname,
						'value' => $json_obj2['satuanKerjaKerjaNama'],
						'id' => $id,
					]);
					break;
				case "unorNama":
					$input = elgg_view("input/$valtype", [
						'name' => $shortname,
						'value' => $json_obj2['unorNama'],
						'id' => $id,
					]);
					break;
				case "unorIndukNama":
					$input = elgg_view("input/$valtype", [
						'name' => $shortname,
						'value' => $json_obj2['unorIndukNama'],
						'id' => $id,
					]);
					break;
				case "jenisJabatan":
					$input = elgg_view("input/$valtype", [
						'name' => $shortname,
						'value' => $json_obj2['jenisJabatan'],
						'id' => $id,
					]);
					break;
				case "jabatanNama":
					$input = elgg_view("input/$valtype", [
						'name' => $shortname,
						'value' => $json_obj2['jabatanNama'],
						'id' => $id,
					]);
					break;
				case "jabatanStrukturalNama":
					$input = elgg_view("input/$valtype", [
						'name' => $shortname,
						'value' => $json_obj2['jabatanStrukturalNama'],
						'id' => $id,
					]);
					break;
				case "tmtJabatan":
					$input = elgg_view("input/$valtype", [
						'name' => $shortname,
						'value' => $json_obj2['tmtJabatan'],
						'id' => $id,
					]);
					break;
				case "lokasiKerja":
					$input = elgg_view("input/$valtype", [
						'name' => $shortname,
						'value' => $json_obj2['lokasiKerja'],
						'id' => $id,
					]);
					break;
				case "golRuangAwal":
					$input = elgg_view("input/$valtype", [
						'name' => $shortname,
						'value' => $json_obj2['golRuangAwal'],
						'id' => $id,
					]);
					break;
				case "golRuangAkhir":
					$input = elgg_view("input/$valtype", [
						'name' => $shortname,
						'value' => $json_obj2['golRuangAkhir'],
						'id' => $id,
					]);
					break;
				case "tmtGolAkhir":
					$input = elgg_view("input/$valtype", [
						'name' => $shortname,
						'value' => $json_obj2['tmtGolAkhir'],
						'id' => $id,
					]);
					break;
				case "masaKerja":
					$input = elgg_view("input/$valtype", [
						'name' => $shortname,
						'value' => $json_obj2['masaKerja'],
						'id' => $id,
					]);
					break;
				case "eselon":
					$input = elgg_view("input/$valtype", [
						'name' => $shortname,
						'value' => $json_obj2['eselon'],
						'id' => $id,
					]);
					break;
				case "eselonLevel":
					$input = elgg_view("input/$valtype", [
						'name' => $shortname,
						'value' => $json_obj2['eselonLevel'],
						'id' => $id,
					]);
					break;
				case "tmtEselon":
					$input = elgg_view("input/$valtype", [
						'name' => $shortname,
						'value' => $json_obj2['tmtEselon'],
						'id' => $id,
					]);
					break;
				case "kpknNama":
					$input = elgg_view("input/$valtype", [
						'name' => $shortname,
						'value' => $json_obj2['kpknNama'],
						'id' => $id,
					]);
					break;
				case "ktuaNama":
					$input = elgg_view("input/$valtype", [
						'name' => $shortname,
						'value' => $json_obj2['ktuaNama'],
						'id' => $id,
					]);
					break;
				case "tglSttpl":
					$input = elgg_view("input/$valtype", [
						'name' => $shortname,
						'value' => $json_obj2['tglSttpl'],
						'id' => $id,
					]);
					break;
				case "jabatanAsn":
					$input = elgg_view("input/$valtype", [
						'name' => $shortname,
						'value' => $json_obj2['jabatanAsn'],
						'id' => $id,
					]);
					break;
				default:
					$input = elgg_view("input/$valtype", [
						'name' => $shortname,
						'value' => $value,
						'id' => $id,
					]);
			}
		} else {
			$input = elgg_view("input/$valtype", [
				'name' => $shortname,
				'value' => $value,
				'id' => $id,
			]);
		}
		$access_input = elgg_view('input/access', [
			'name' => "accesslevel[$shortname]",
			'value' => $access_id,
		]);
		echo elgg_view('elements/forms/field', [
			'input' => $input . $access_input,
			'label' => elgg_view('elements/forms/label', [
				'label' => elgg_echo("profile:$shortname"),
				'id' => $id,
			])
		]);
	}
}
elgg_clear_sticky_form('profile:edit');
echo elgg_view('input/hidden', array('name' => 'guid', 'value' => $entity->guid));
echo elgg_view_field([
	'#type' => 'submit',
	'value' => elgg_echo('save'),
	'#class' => 'elgg-foot',
]);