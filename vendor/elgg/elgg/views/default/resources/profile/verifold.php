<?php

/*
  An Example PDF Report Using FPDF
  by Matt Doyle

  From "Create Nice-Looking PDFs with PHP and FPDF"
  http://www.elated.com/articles/create-nice-looking-pdfs-php-fpdf/
*/

require('../fpdf181/fpdf.php');

// API BKN

$nip = '196302081991031001';
$json_obj2 = '';

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
      
      //echo "cURL Error #:" . $err;
  
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
  
          //echo "cURL Error #:" . $err;
  
      } else {
          $datutres = stripslashes($datut);
          $json_obj = json_decode($datut,true);
          $json_obj2 = json_decode($json_obj['data'],true);
      }
  
      if ($errpendidikan) {
  
          //echo "cURL Error #:" . $errpendidikan;
  
      } else {
          $datpendidikanres = stripslashes($datpendidikan);
          $json_pendidikan = json_decode($datpendidikan,true);
          $json_pendidikan2 = $json_pendidikan['data'][0]['id'];
  
      }
  
      if ($errkursus) {
  
          //echo "cURL Error #:" . $errkursus;
  
      } else {
          $datkursusres = stripslashes($datkursus);
          $json_kursus = json_decode($datkursus,true);
          $json_kursus2 = $json_kursus['data'][0]['id'];
  
          for($i = 0; $i < count($json_kursus['data']); $i++){
              $isikursus .= 'Nama Kursus: ' . $json_kursus['data'][$i]['namaKursus'] . ' Tanggal Kursus: ' . $json_kursus['data'][$i]['tanggalKursus'] . ' Institusi Penyelenggara: ' . $json_kursus['data'][$i]['institusiPenyelenggara'] . '<br><br>';
          }
      }
    }

  // END API BKN

// Begin configuration

$textColour = array( 0, 0, 0 );
$headerColour = array( 100, 100, 100 );
$tableHeaderTopTextColour = array( 255, 255, 255 );
$tableHeaderTopFillColour = array( 125, 152, 179 );
$tableHeaderTopProductTextColour = array( 0, 0, 0 );
$tableHeaderTopProductFillColour = array( 143, 173, 204 );
$tableHeaderLeftTextColour = array( 99, 42, 57 );
$tableHeaderLeftFillColour = array( 255, 255, 255 );
$tableBorderColour = array( 50, 50, 50 );
$tableRowFillColour = array( 213, 170, 170 );
$reportName = "Data User";
$reportNameYPos = 160;
$logoFile = "widget-company-logo.png";
$logoXPos = 50;
$logoYPos = 108;
$logoWidth = 110;
$columnLabels = array( "Q1");
$rowLabels = array( "Nama", "TTL", "NIK", "Alamat", "Nama Jenis Pegawai",
                    "Nama Pendidikan Terakhir", "Nama Latihan Struktural",
                    "Nama Instansi Induk", "Nama Satuan Kerja Induk", "Nama Instansi Kerja",
                    "Nama Satuan Kerja", "Nama Unor", "Nama Unor Induk", "Jenis Jabatan",
                    "Nama Jabatan", "Nama Jabatan Struktural", "Masa Kerja", "Jabatan ASN");
$chartXPos = 20;
$chartYPos = 250;
$chartWidth = 160;
$chartHeight = 80;
$chartXLabel = "Product";
$chartYLabel = "2009 Sales";
$chartYStep = 20000;

$chartColours = array(
                  array( 255, 100, 100 ),
                  array( 100, 255, 100 ),
                  array( 100, 100, 255 ),
                  array( 255, 255, 100 ),
                );

$data = array(
          array( $json_obj2['nama']),
          array( $json_obj2['tempatLahir']),
          array( $json_obj2['nik']),
          array( $json_obj2['alamat']),
          array( $json_obj2['jenisPegawaiNama']),
          array( $json_obj2['pendidikanTerakhirNama']),
          array( $json_obj2['latihanStrukturalNama']),
          array( $json_obj2['instansiIndukNama']),
          array( $json_obj2['satuanKerjaIndukNama']),
          array( $json_obj2['instansiKerjaNama']),
          array( $json_obj2['satuanKerjaKerjaNama']),
          array( $json_obj2['unorNama']),
          array( $json_obj2['unorIndukNama']),
          array( $json_obj2['jenisJabatan']),
          array( $json_obj2['jabatanNama']),
          array( $json_obj2['jabatanStrukturalNama']),
          array( $json_obj2['masaKerja']),
          array( $json_obj2['jabatanAsn']),
        );

// End configuration

/**
  Create the title page
**/

$pdf = new FPDF( 'P', 'mm', 'A4' );
$pdf->SetTextColor( $textColour[0], $textColour[1], $textColour[2] );

/**
  Create the page header, main heading, and intro text
**/

$pdf->AddPage();
$pdf->SetTextColor( $headerColour[0], $headerColour[1], $headerColour[2] );
$pdf->SetFont( 'Arial', '', 17 );
$pdf->Cell( 0, 18, $reportName, 0, 0, 'C' );
$pdf->SetTextColor( $textColour[0], $textColour[1], $textColour[2] );
$pdf->SetFont( 'Arial', '', 20 );

$pdf->Ln( 22 );

$pdf->SetTextColor( $headerColour[0], $headerColour[1], $headerColour[2] );
$pdf->SetFont( 'Arial', '', 17 );
$pdf->Cell( 0, 15, "Data Pribadi", 0, 0, 'C' );

/***
  Create the table
**/

$pdf->SetDrawColor( $tableBorderColour[0], $tableBorderColour[1], $tableBorderColour[2] );
$pdf->Ln( 15 );

// Create the table header row
$pdf->SetFont( 'Arial', 'B', 15 );

// "PRODUCT" cell
// $pdf->SetTextColor( $tableHeaderTopProductTextColour[0], $tableHeaderTopProductTextColour[1], $tableHeaderTopProductTextColour[2] );
// $pdf->SetFillColor( $tableHeaderTopProductFillColour[0], $tableHeaderTopProductFillColour[1], $tableHeaderTopProductFillColour[2] );
// $pdf->Cell( 55, 12, " PRODUCT", 0, 0, 'L', true );

// Remaining header cells
// $pdf->SetTextColor( $tableHeaderTopTextColour[0], $tableHeaderTopTextColour[1], $tableHeaderTopTextColour[2] );
// $pdf->SetFillColor( $tableHeaderTopFillColour[0], $tableHeaderTopFillColour[1], $tableHeaderTopFillColour[2] );

// for ( $i=0; $i<count($columnLabels); $i++ ) {
//   $pdf->Cell( 150, 12, $columnLabels[$i], 0, 0, 'C', true );
// }

// $pdf->Ln( 12 );

// Create the table data rows

$fill = false;
$row = 0;

foreach ( $data as $dataRow ) {

  // Create the left header cell
  $pdf->SetFont( 'Arial', 'B', 12 );
  $pdf->SetTextColor( $tableHeaderLeftTextColour[0], $tableHeaderLeftTextColour[1], $tableHeaderLeftTextColour[2] );
  $pdf->SetFillColor( $tableHeaderLeftFillColour[0], $tableHeaderLeftFillColour[1], $tableHeaderLeftFillColour[2] );
  $pdf->Cell( 55, 12, " " . $rowLabels[$row], 0, 0, 'L', $fill );

  // Create the data cells
  // $pdf->SetTextColor( $textColour[0], $textColour[1], $textColour[2] );
  // $pdf->SetFillColor( $tableRowFillColour[0], $tableRowFillColour[1], $tableRowFillColour[2] );
  $pdf->SetFont( 'Arial', '', 12 );

  for ( $i=0; $i<count($columnLabels); $i++ ) {
    $pdf->Cell( 150, 12, ":    ".$dataRow[$i], 0, 0, 'L', $fill );
  }

  $row++;
  $fill = !$fill;
  $pdf->Ln( 12 );
}


/***
  Create the chart
***/

// Compute the X scale
// $xScale = count($rowLabels) / ( $chartWidth - 40 );

// // Compute the Y scale

// $maxTotal = 0;

// foreach ( $data as $dataRow ) {
//   $totalSales = 0;
//   foreach ( $dataRow as $dataCell ) $totalSales += $dataCell;
//   $maxTotal = ( $totalSales > $maxTotal ) ? $totalSales : $maxTotal;
// }

// $yScale = $maxTotal / $chartHeight;

// // Compute the bar width
// $barWidth = ( 1 / $xScale ) / 1.5;

// // Add the axes:

// $pdf->SetFont( 'Arial', '', 10 );

// // X axis
// $pdf->Line( $chartXPos + 30, $chartYPos, $chartXPos + $chartWidth, $chartYPos );

// for ( $i=0; $i < count( $rowLabels ); $i++ ) {
//   $pdf->SetXY( $chartXPos + 40 +  $i / $xScale, $chartYPos );
//   $pdf->Cell( $barWidth, 10, $rowLabels[$i], 0, 0, 'C' );
// }

// // Y axis
// $pdf->Line( $chartXPos + 30, $chartYPos, $chartXPos + 30, $chartYPos - $chartHeight - 8 );

// for ( $i=0; $i <= $maxTotal; $i += $chartYStep ) {
//   $pdf->SetXY( $chartXPos + 7, $chartYPos - 5 - $i / $yScale );
//   $pdf->Cell( 20, 10, '$' . number_format( $i ), 0, 0, 'R' );
//   $pdf->Line( $chartXPos + 28, $chartYPos - $i / $yScale, $chartXPos + 30, $chartYPos - $i / $yScale );
// }

// // Add the axis labels
// $pdf->SetFont( 'Arial', 'B', 12 );
// $pdf->SetXY( $chartWidth / 2 + 20, $chartYPos + 8 );
// $pdf->Cell( 30, 10, $chartXLabel, 0, 0, 'C' );
// $pdf->SetXY( $chartXPos + 7, $chartYPos - $chartHeight - 12 );
// $pdf->Cell( 20, 10, $chartYLabel, 0, 0, 'R' );

// // Create the bars
// $xPos = $chartXPos + 40;
// $bar = 0;

// foreach ( $data as $dataRow ) {

//   // Total up the sales figures for this product
//   $totalSales = 0;
//   foreach ( $dataRow as $dataCell ) $totalSales += $dataCell;

//   // Create the bar
//   $colourIndex = $bar % count( $chartColours );
//   $pdf->SetFillColor( $chartColours[$colourIndex][0], $chartColours[$colourIndex][1], $chartColours[$colourIndex][2] );
//   $pdf->Rect( $xPos, $chartYPos - ( $totalSales / $yScale ), $barWidth, $totalSales / $yScale, 'DF' );
//   $xPos += ( 1 / $xScale );
//   $bar++;
// }

$pdf->AddPage();

/***
  Serve the PDF
***/

$pdf->Output( "report.pdf", "I" );

?>