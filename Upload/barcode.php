<?php
include '../vendor/phpqrcode/qrlib.php';


 QRcode::png($_GET['data'],false,QR_ECLEVEL_L,5,2,false);


// QRcode::png("test",false,QR_ECLEVEL_L,5,2,false);
 ?>
