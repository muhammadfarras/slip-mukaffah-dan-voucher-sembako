<?php
$bulan = "";
switch ($periode[1]) {
  case '01':
    $bulan = "Januari";
  break;

  case '02':
  $bulan = "Februari";
  break;

  case '03':
  $bulan = "Maret";
  break;

  case '04':
  $bulan = "April";
  break;

  case '05':
  $bulan = "Mei";
  break;

  case '06':
  $bulan = "Juni";
  break;

  case '07':
  $bulan = "Juli";
  break;

  case '08':
  $bulan = "Agustus";
  break;

  case '09':
  $bulan = "September";
  break;

  case '10':
  $bulan = "Oktober";
  break;
  
  case '11':
  $bulan = "November";
  break;

  case '12':
  $bulan = "Desember";
  break;
  
  default:
    # code...
    break;
}

function hariIni (){
  $hari = date("N");
  $tanggal = date ("d");
  $bulan = date("n");
  $tahun = date ("Y");
  switch ($hari) {
    case 1:
    $hari = "Senin";
      break;
    case 2:
    $hari = "Selasa";
      break;
    case 3:
    $hari = "Rabu";
      break;
    case 4:
    $hari = "Kamis";
      break;
    case 5:
    $hari = "Jumat";
      break;
    case 6:     
    $hari = "Sabtu";
      break;
    case 7:
    $hari = "Ahad";
      break;
  }

  switch ($bulan) {
    case 1:
    $bulan = "Januari";
      break;
    case 2:
    $bulan = "Februari";
      break;
    case 3:
    $bulan = "Maret";
      break;
    case 4:
    $bulan = "April";
      break;
    case 5:
    $bulan = "Mei";
      break;
    case 6:     
    $bulan = "Juni";
      break;
    case 7:
    $bulan = "Juli";
      break;
    case 8:
    $bulan = "Agustus";
      break;
    case 9:
    $bulan = "September";
      break;
    case 10:
    $bulan = "Oktober";
      break;
    case 11:
    $bulan = "November";
      break;
    case 12:
    $bulan = "Desember";
      break;
  }


  return $hari.", ".$tanggal." ".$bulan." ".$tahun;
}

$hari = date("N");
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


    .pala {
      vertical-align: middle;
    }


    .display {
      font-size: 16px;
      font-weight: bold;
    }

    .display-2{
      font-size: 12px;
    }

    .mute {
      color: #7d7d7d;
    }

    .text-center {
      text-align: center !important;
    }
    .text-right {
      text-align: right; !important;
    }
    body {
      font-family: myfont;
      font-size: 8pt;
    }

   
    .table-info {
      border-collapse: collapse;
      /*background-color: #cad7ed;*/
      /*border: 1px solid;*/
      /*width: 8%;*/
      /*width: 100%;*/
    }

    .table-info tr, .table-info td {
      /*border: 1px solid;*/
    }

    .td-w {
      padding-right: 10px;
      width: auto;
      white-space: nowrap;
    }

    .rincian-gaji td, .rincian-gaji th {
      /*padding-top: 5px;*/
      /*padding-bottom: : 5px;*/
      /*border: 1px solid black;*/
      /*border-collapse: collapse;
      border: 1px solid;*/
    }

    .table-info td , .table-info th{
      /*padding: 2px;*/
    }


    table {
     
      /*border-collapse: collapse;*/
    }

    .rincian-gaji {

      width: 100%;
    }

    .border {
      font-size: 12px;
    }

    .barcode {
      float: left;
      margin-right: 15px;
    }

    .logo {
      width: 80px;
      float: left;
      margin-right: 15px;
    }

    .content-gaji {
      padding: 10px;
      margin-left: 15px;
      border: 1px solid gray;
      display: block;
      margin: 2px 0 0 0;
    }

    .mt {
      margin-top: 8px !important;
    }

    .mt-2 {
      margin-top: 15px !important;
    }

    .mb-5{
      margin-bottom: 12px !important;
    }

    .sub-info {
      width: 75%;
      padding-left: 15px;
    }

    .sub-1 {
      width: 50%;
      padding-left: 35px;
    }

    .sub-head {
      color: #7d7d7d;
    }

    .c-blue {
      color: #29b7f0;
    }

    .c-red {
      color: #eb3423;
    }

    .c-gray {
      color: #7d7d7d;
    }

    .tr-sub-total {
      background-color: gray;      
    }

    .tr-sub-total-final {
      color: black
    }

    .tr-sub-total-final td {
      font-size: 12px;
      padding: 4px;
    }

    .tr-sub-total td {
      color: white;
      padding-top: 5px;
      padding-bottom: 5px;
    }

    .border-final {
      padding: 3px;
      border: 4px solid gray !important;
    }

    .line-bellow {
      border-bottom: 1px solid black;
    }

    .span {
      display: block;
    }

    .display-judul {
      font-size: 16px;
      font-weight: bold;
      text-align: center;
    }

    .ul {
      text-decoration: underline;
    }

    .number-list {
      font-weight: bold;
      padding-right: 10px;
    }

    .sub-total-name {
      color: black;
      font-weight: bold;
    }

    .f-12 {
      font-size: 12px !important;
    }


    </style>
</head>
<body>

    <br><br><br><br>

    <p class="display-judul">Slip Mukafaah Pegawai
<br><span class="mute"><b>
              <?php  echo $bulan." ".$periode[2] ?></b>
            </span>
    </p>
    

      <table class="table-info">
        <tr>
          <td class="sub-info td-w f-12">Nama Pegawai</td>
          <td class="f-12"><?php echo ": ".$item[1]?></td>
        </tr>

        <tr>
          <td class="sub-info td-w f-12">Nomor Induk Yayasan</td>
          <td class="f-12"><?php echo ": ".$item[2]?></td>
        </tr>

        <tr>
          <td class="sub-info td-w f-12">Unit</td>
          <td class="f-12"><?php echo ": ".$item[3]?></td>
        </tr>

        <tr>
          <td class="sub-info td-w f-12">Status Kepegawaian</td>
          <td class="f-12"><?php echo ": ".$item[6]?></td>
        </tr>

        <tr>
          <td class="sub-info td-w f-12">Posisi Jabatan</td>
          <td class="f-12"><?php echo ": ".$item[7]?></td>
        </tr>

        <tr>
          <td class="sub-info td-w f-12">Status Keluarga</td>
          <td class="f-12"><?php echo ": ".$item[13]?></td>
        </tr>


        <!-- <tr>
          <td class="sub-1 td-w">Absensi</td>
          <td><?php echo ": ".$item[8]?></td>
        </tr> -->
      </table>

      <div  style="padding-left: 15px; border: 1px solid gray;" >
        <table class="sub-info table-info">
          <tr>
            <td colspan="6">Absensi</td>
          </tr>
          <tr >
            <td><span class="ul">Cuti</span><br><?php echo $item[8]?></td>
            <td><span class="ul">Sakit</span><br><?php echo $item[9]?></td>
            <td><span class="ul">Alpa</span><br><?php echo $item[10]?></td>
            <td><span class="ul">Terlambat</span><br><?php echo $item[11]?></td>
            <td><span class="ul">Pulang Lebih Awal</span><br><?php echo $item[12]?></td>
          </tr>
        </table>
      </div>
      

      <div class="content-gaji">
        <table class="rincian-gaji">
          <tr>
            <td style="color: black;" class="sub-head" colspan="4"><b>
          <span class="number-list">A.</span>Penerimaan</b>
        </td>
      </tr>

          <tr>
            <td colspan="2" style="width: 75%;" class="sub-head"><b>A1. Gaji Pokok</b></td>
            <td colspan="2" class="td-nominal"><?php echo ": Rp".number_format((int)$item[18],null,null,".");?></td>
          </tr>

          <tr>
            <td colspan="4" style="width: 75%;" class="sub-head"><b>A2. Tunjangan Tunai</b></td>
          </tr>


        <!--   <tr><td class="c-blue" colspan="2"><b>Tunjangan</b></td></tr> -->

          <tr>
            <td class="sub-1">Tunjangan Jabatan</td>
            <td colspan="3" class="td-nominal"><?php echo ": Rp".number_format((int)$item[19],null,null,".");?></td>
          </tr>

          <tr>
            <td class="sub-1">Tunjangan Istri Anak</td>
            <td colspan="3" class="td-nominal"><?php echo ": Rp".number_format((int)$item[20],null,null,".");?></td>
          </tr>

          <tr>
            <td class="sub-1">Tunjangan Transport</td>
            <td colspan="3" class="td-nominal"><?php echo ": Rp".number_format((int)$item[21],null,null,".");?></td>
          </tr>

          <tr>
            <td class="sub-1">Tunjangan Wali Kelas</td>
            <td colspan="3" class="td-nominal"><?php echo ": Rp".number_format((int)$item[22],null,null,".");?></td>
          </tr>

          <tr>
            <td class="sub-1">Tunjangan Hafalan</td>
            <td colspan="3" class="td-nominal"><?php echo ": Rp".number_format((int)$item[23],null,null,".");?></td>
          </tr>

          <tr>
            <td class="sub-1">Tunjangan Perumahan</td>
            <td colspan="3" class="td-nominal"><?php echo ": Rp".number_format((int)$item[24],null,null,".");?></td>
          </tr>

          <tr>
            <td class="sub-1">Tunjangan Kesehatan</td>
            <td colspan="3" class="td-nominal"><?php echo ": Rp".number_format((int)$item[25],null,null,".");?></td>
          </tr>

          <tr>
            <td class="sub-1">Tunjangan Kelahiran</td>
            <td colspan="3" class="td-nominal"><?php echo ": Rp".number_format((int)$item[26],null,null,".");?></td>
          </tr>

          <tr>
            <td class="sub-1">Tunjangan Hari Raya</td>
            <td colspan="3" class="td-nominal"><?php echo ": Rp".number_format((int)$item[38],null,null,".");?></td>
          </tr>

          <tr>
            <td class="sub-1">Tunjangan Uang Makan</td>
            <td colspan="3" class="td-nominal"><?php echo ": Rp".number_format((int)$item[28],null,null,".");?></td>
          </tr>

          <tr>
            <td class="sub-1">Tunjangan Insentif</td>
            <td colspan="3" class="td-nominal"><?php echo ": Rp".number_format((int)$item[29],null,null,".");?></td>
          </tr>

          <tr>
            <td class="sub-1">Tunjangan Lembur</td>
            <td colspan="3" class="td-nominal"><?php echo ": Rp".number_format((int)$item[27],null,null,".");?></td>
          </tr>

          <!-- Sub total A2 -->

          <?php 
          $totalTunjanganTunai = $item[19]+$item[20]+$item[21]+$item[22]+$item[23]+$item[24]+$item[25]+$item[26]+$item[38]+$item[28]+$item[29]+$item[27];
          ?>

          <tr>
            <td colspan="2" class="sub-1 sub-total-name">Sub total tunjangan tunai</td>
            
            <td colspan="2" class="td-nominal"><?php echo ": Rp".number_format((int)$totalTunjanganTunai,null,null,".");?></td>
          </tr>


          <!-- KOmponen gaji a3 -->
          <tr><td colspan="4" style="width: 75%;" class="sub-head"><b>A3. Tunjangan Non Tunai</b></td></tr>


          <tr>
            <td class="sub-1">Fasilitas Makan Siang</td>
            <td colspan="3" class="td-nominal"><?php echo ": Rp".number_format((int)$item[32],null,null,".");?></td>
          </tr>

          <tr>
            <td class="sub-1">Tunjangan Pendidikan Anak</td>
            <td colspan="3" class="td-nominal"><?php echo ": Rp".number_format((int)$item[33],null,null,".");?></td>
          </tr>

          <tr>
            <td class="sub-1">Tunjangan Tunjangan Sembako</td>
            <td colspan="3" class="td-nominal"><?php echo ": Rp".number_format((int)$item[30],null,null,".");?></td>
          </tr>

          <tr>
            <td class="sub-1">Tunjangan Tunjangan Komunikasi</td>
            <td colspan="3" class="td-nominal"><?php echo ": Rp".number_format((int)$item[31],null,null,".");?></td>
          </tr>


          <tr>
            <td colspan="2" class="sub-1 sub-total-name">Sub total tunjangan non tunai</td>
            
            <td colspan="2" class="td-nominal"><?php echo ": Rp".number_format((int)$item[49],null,null,".");?></td>
          </tr>


          <!-- KOmponen gaji a4 -->
          <tr><td colspan="4" style="width: 75%;" class="sub-head"><b>A4. Lain-lain</b></td></tr>


          <tr>
            <td class="sub-1">Bantuan Dompet Pendidikan</td>
            <td colspan="3" class="td-nominal"><?php echo ": Rp".number_format((int)$item[59],null,null,".");?></td>
          </tr>

          <tr>
            <td colspan="2" class="sub-1 sub-total-name">Sub total lain-lain</td>
            
            <td colspan="2" class="td-nominal"><?php echo ": Rp".number_format((int)($item[59]),null,null,".");?></td>
          </tr>

          <tr class="tr-sub-total">
            <td colspan="3"><b>Sub Total (A1+A2+A3+A4)</b></td>

            <?php
            $subTotalGaji = $item[18]+$totalTunjanganTunai+(int)$item[49]+$item[59];
            ?>
            <td class="td-nominal"><b><?php echo "Rp".number_format(((int)$subTotalGaji),null,null,".");?></b></td>
          </tr>
          <tr><td class="sub-1"></td></tr>


          <tr><td colspan="4" style="width: 75%;" class="c-black"><b><span>B. Pengurangan Mukafaah</span></b></td></tr>
          <tr><td colspan="4" style="width: 75%;" class="c-gray"><b><span>B1. Pinjaman ke-1</span></b></td></tr>

          <!-- Angsuran pinjaman ke -1 -->
          <tr><td class="sub-1">Angsuran ke - </td><td colspan="3" class="td-nominal"><?php echo "&nbsp; ".$item[50]?></td></tr>

          <tr><td class="sub-1">Sisa pinjaman 1</td><td colspan="3" class="td-nominal"><?php echo ": Rp".number_format((int)$item[52],null,null,".");?></td></tr>

          <tr>
            <td class="sub-1">Potongan pinjaman 1</td>
            <td class="td-nominal">
              
            </td>
            <td colspan="2"><?php echo ": Rp".number_format((int)$item[51],null,null,".");?></td>
          </tr>



          <!-- Angsuran pinjaman ke -2 -->
          <tr><td colspan="4" style="width: 75%;" class="c-gray"><b><span>B2. Pinjaman ke-2</span></b></td></tr>

          <tr><td class="sub-1">Angsuran ke - </td><td colspan="3" class="td-nominal"><?php echo "&nbsp; ".$item[53]?></td></tr>


          <tr><td class="sub-1">Sisa pinjaman 2</td><td colspan="3" class="td-nominal"><?php echo ": Rp".number_format((int)$item[55],null,null,".");?></td></tr>
          

          <tr>
            <td class="sub-1">Potongan pinjaman 2</td>
            <td class="td-nominal"></td>
            <td colspan="2">
              <?php echo ": Rp".number_format((int)$item[54],null,null,".");?>
            </td>
          </tr>

          



          <tr>
            <td colspan="2" style="width: 75%;" class="c-gray"><b><span>B3. Potongan Pendidikan Anak</span></b>
            </td>
            <td colspan="2">
              <?php echo ": Rp".number_format(((int)$item[43]),null,null,".");?>
            </td>
          </tr>

          <tr>
              <td colspan="4" class="c-gray"><b><span>B4. Pengambilan Tunjangan Non Tunai</span></b></td>
          </tr>
          <tr>
            <td class="sub-1">Fasilitas Makan Siang</td><td colspan="3" class="td-nominal"><?php echo ": Rp".number_format(((int)$item[32]),null,null,".");?></td>
          </tr>
          <tr>
            <td class="sub-1">Bantuan Pendidikan Anak</td><td colspan="3" class="td-nominal"><?php echo ": Rp".number_format(((int)$item[33]),null,null,".");?></td>
          </tr>
          <tr>
            <td class="sub-1">Tunjangan Sembako</td><td colspan="3" class="td-nominal"><?php echo ": Rp".number_format(((int)$item[30]),null,null,".");?></td>
          </tr>
          <tr>
            <td class="sub-1">Tunjangan Komunikasi</td><td colspan="3" class="td-nominal"><?php echo ": Rp".number_format(((int)$item[31]),null,null,".");?></td>
          </tr>
          <tr>
            <td colspan="2" class="sub-1"><b>Sub Total Tunjangan Non Tunai</b></td>
            <td colspan="2">
              <?php 
              $subTotalTunjanganNonTunai = $item[32]+(int)$item[33]+(int)$item[30]+(int)$item[31];
              ?>
              <?php echo ": Rp".number_format(((int)$subTotalTunjanganNonTunai),null,null,".");?>
            </td>
          </tr>


          <tr><td class="sub-1"></td></tr>

          <tr class="tr-sub-total">
            <td colspan="3"><b>Sub Total (B1+B2+B3+B4)</b></td>
            <?php
            $subTotalPengurang = $item[51]+(int)$item[54]+(int)$item[43]+$subTotalTunjanganNonTunai;
            ?>
            <td class="td-nominal"><b><?php echo "Rp".number_format(((int)$subTotalPengurang),null,null,".");?></b></td>
          </tr>

          <tr><td class="sub-1"><br></td></tr>
          <tr class="tr-sub-total-final">
            <td colspan="3"><b>Mukafaah Bersih Tunai (Sub Total A - Sub Total B)</b></td>
            <td class="td-nominal"><b><?php echo "Rp".number_format(
              ((int)$subTotalGaji)
              -((int)$subTotalPengurang)
              ,null,null,".");?></b></td>
          </tr>
      </table>


  </div>

      <div class="mt-2">
        <table class="rincian-gaji ">
          <tr>
            <td style="width: 65%;">
              <p>
                
                <?php
                echo hariIni();
                ?>

              </p>
<br><br><br><br>
              <p style="font-size: 12px; font-weight: bold">
                Kepala Departemen SDM
                <br>
                Yayasan Pendidikan Islam Imam Ahmad bin Hanbal
              </p>
            </td>
          </tr>
   
        </table>
      </div>
</body>
</html>