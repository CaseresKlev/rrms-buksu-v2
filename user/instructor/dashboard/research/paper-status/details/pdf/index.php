<?php
require('WriteHTML.php');
include($_SERVER["DOCUMENT_ROOT"] . "/rrms-buksu/includes/path.php");  
  include PROJECT_ROOT_NOT_LINK . "user/instructor/dashboard/preload.php";
$pdf=new PDF_HTML();
$pdf->AddPage();
$pdf->SetFont('Arial');
$source = PROJECT_ROOT . "img/BukSU Logo.png";
$pdf->WriteHTML('You can<br><p align="center">center a line</p>and add a horizontal rule:<br><hr><br><img id="buksulogo" src="localhost/rrms-buksu/img/BukSU Logo.png">');
$pdf->Output();
?>