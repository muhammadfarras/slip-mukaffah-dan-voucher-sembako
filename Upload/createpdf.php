<?php
ob_start();

// echo "<pre>";
$item = json_decode(($_GET['data']));

$path = $_GET['path'];
$time = $_GET['time'];




// ["add-07-2021","Abbas Kiri","1434.07.23.01","SDIT Anak Shalih","farras@anakshalihbogor.sch.id","L","Tetap","Guru&guru","0","0","0","0","0","K-4","0","IIA","8","3","1200000","0","400000","400000","0","250000","287500","0","0","0","0","0","289400","0","315000","1176500","0","0","0","0","0","0","0","","500000","307666","0","4318400","2229834","1729834","4000000","4000000","1","500000","4500000","0","0","0","0","0","0","Beras 'Melati Setra Ramos' (kg)","15","Minyak Goreng 'Sania' (liter)","2","Gula Pasir GMP (kg)","2","Terigu 'Sania' (kg)","1","Mentega 'Blue Band' Serbaguna (sachet 200 gr)","1","Saos Sambal Ekstra Pedas 'Sasa' (botol 340 ml)","1","Kecap 'Bango' (pouch 520 ml)","1","Kantong Plastik 'Loco'","1"]

/*-- Unit Testing Dengan Sembak0 --*/
// ["add-07-2021","Abbas Kiri","1434.07.23.01","SDIT Anak Shalih","farras@anakshalihbogor.sch.id","L","Tetap","Guru","0","0","0","0","0","K-4","0","IIA","8","3","1200000","0","400000","400000","0","250000","287500","0","0","0","0","0","289400","0","315000","1176500","0","0","0","0","0","0","0","","500000","307666","0","4318400","2229834","1729834","4000000","4000000","1","500000","4500000","0","0","0","0","0","0","Beras 'Melati Setra Ramos' (kg)","15","Minyak Goreng 'Sania' (liter)","2","Gula Pasir GMP (kg)","2","Terigu 'Sania' (kg)","1","Mentega 'Blue Band' Serbaguna (sachet 200 gr)","1","Saos Sambal Ekstra Pedas 'Sasa' (botol 340 ml)","1","Kecap 'Bango' (pouch 520 ml)","1","Kantong Plastik 'Loco'","1"]


/*-- Unit Testing Tanpa Sembakp --*/
// ["add-07-2021","Abbas Kiri","1434.07.23.01","SDIT Anak Shalih","farras@anakshalihbogor.sch.id","L","Tetap","Guru","0","0","0","0","0","K-4","0","IIA","8","3","1200000","0","400000","400000","0","250000","287500","0","0","0","0","0","289400","0","315000","1176500","0","0","0","0","0","0","0","","500000","307666","0","4318400","2229834","1729834","4000000","4000000","1","500000","4500000","0","0","0","0","0","0"]

require_once __DIR__."/../control/KodeControl.php";

// 59 data dari sdm
$banyakDataSDM = KodeControl::$BANYAK_DATA_SDM;
$adaSembako = false;

if ($item[$banyakDataSDM] !== "") {
  $adaSembako = true;

  $barang = array_slice($item, $banyakDataSDM);

  // print_r ($barang);

  // craete two dimensional array
  $barangs = array();
  $tempArray = array();
  for ($i = 0 ; $i< count($barang) ; $i++){


      if (count($tempArray) != 2){
          array_push($tempArray, $barang[$i]);

          if (count($tempArray) == 2){
              array_push($barangs, $tempArray);
              // hapus temp array
              $tempArray = array();

          }
      }
  }

}



$periode = explode ("-",$item[0]);



include ("gajipdf.php");

$htmlGaji = ob_get_contents();
ob_clean();
?>


<!DOCTYPE html>
<head>
    <title></title>
    <!-- <link href="bootstrap.css" type="text/css" rel="stylesheet"> -->
    <style type="text/css">

    @font-face{
      font-family: "myfont";
      src: url("../aset/font/quick_sand_regular.ttf") format("truetype");
    }
    .logo {
          width: 80px;
          float: left;
          margin-right: 15px;
        }

    .display {
      font-size: 18px;
      font-weight: bold;
    }

    .display-2{
      font-size: 14px;
    }

    .mute {
      color: #949494;
    }

    .text-center {
      text-align: center !important;
    }
    body {
      font-family: myfont;
      font-size: 8pt;
    }

    .table-sembako td, .table-sembako th {
      border: 1px solid black;
    }
    td,th{
      padding: 8px;
    }

    .table-sembako {
      width: 100%;
      border-collapse: collapse;
    }

    .border {
      font-size: 12px;
    }

    img {
      float: left;
      margin-right: 15px;
    }

    .content {
      margin-left: 15px;
      display: block;
      margin: 2px 0 0 0;
    }

    .mb-5{
      margin-bottom: 12px !important;
    }

    .right-samping {
      float: right;
    }

    </style>
</head>
<body>
  <br><br><br><br>

    <p class="display-judul">Voucher Tunjangan Sembako
<br><span class="mute"><b>
              <?php  echo $bulan."-".$periode[2] ?></b>
            </span>
    </p>

    <table class="table-sembako">
        <tr><th>Barang</th><th>Jumlah</th></tr>
        <?php

        for ($i = 0 ; $i < count($barangs) ; $i++){

            if (($barangs[$i][0] <> "") && ($barangs[$i][1] <> "" && $barangs[$i][1] <> 0 )){
              echo "<tr><td>".$barangs[$i][0]."</td><td>".$barangs[$i][1]."</td></tr>";
            }

        }
        ?>
    </table>

      <small class="text-muted mb-5">Semua barang di atas, sudah diterima dengan baik dan lengkap</small>
      <br><br><br>

      <div class="content">
        <?php echo '<img src="barcode.php?data='.$item[0]."|".$item[2].'" />'; ?>

        <div class="border right-samping">
            <span>Keterangan :</span><br>
            <span>1. Voucher ini hanya berlaku di Minimart Anak Shalih, dalam rangka pengambilan mukafaah natura bagi pegawai.</span><br>
            <span>2. Pengambilan barang dan/atau penggunaan voucher tidak boleh diwakilkan.</span><br>
            <span>3. Pengambilan barang dan/atau penggunaan voucher paling lambat 5 (lima) hari setelah voucher dibagikan.</span><br>
            <span>4. Penggunaan voucher untuk pengambilan barang harus sekaligus dalam satu kali pengambilan.</span>
        </div>
      </div>

      <p style="margin-left:10px;" class="mute">Scan QR kode diatas untuk pengambilan sembako</p>
    </div>





</body>
</html>

<?php
/* Haru echo 1 untuk js nya */
// die();
  $htmlSembako = ob_get_contents();
  ob_end_clean();

// echo $path;
  require_once __DIR__ . '/../vendor/mpdf/vendor/autoload.php';

  // set font
  $defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
  $fontDirs = $defaultConfig['fontDir'];

  $defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
  $fontData = $defaultFontConfig['fontdata'];



  $mpdf = new \Mpdf\Mpdf([

    'fontDir' => array_merge($fontDirs, [
        __DIR__ . '/../aset/font/',
    ]),
    'fontdata' => $fontData + [
        'quick' => [
            'R' => 'quick_sand_regular.ttf',
            'I' => 'quick_sand_regular.ttf',
        ]
    ],
    'default_font' => 'quick',
  'mode' => 'utf-8',
  'format' => [176,340],
  'orientation' => 'P'
  ]);



  $mpdf->sEThTMLHeader ('<div>
      <table  class="line-bellow">
        <tr>
          
          <td>
            <div >
              <span style="color: #2B7651;" class="display">Yayasan Pendidikan Islam Imam Ahmad bin Hanbal</span>
              <br><br><span style="color: #2B7651;" class="display-2"><b>DEPARTEMEN SUMBER DAYA MANUSIA<b></span>
            </div> 
          </td>
          <td>
            <img style="width: 67px;" class="logo" src="../aset/img/logo.png">
          </td>
        </tr>
      </table>   
    </div>');

  $mpdf->AddFontDirectory("../aset/font/quick_sand_regular.ttf");

  // set password
  // $mpdf->SetProtection(array(), 'UserPassword', $item[2]);


  $mpdf->WriteHTML($htmlGaji);




  


if ($adaSembako){

  $mpdf->AddPage('P','','','','','','','','','','','','','','','','','','','',array(176,270));
  $mpdf->WriteHTML($htmlSembako);

}
  
  

  $namaFile = $path."/".$item[2]."-".$item[1].".pdf";



  
  // Untuk pengembangan di uncomment
  $mpdf->Output();


  // $mpdf->Output($namaFile,'F');
  // echo 1;


?>
