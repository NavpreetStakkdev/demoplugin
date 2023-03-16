<?php  
require_once('./vendor/autoload.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if($_POST['page']=="html"){
        $html=$_POST['html'];
         //convert to pdf
        $pdf = new TCPDF();
        $pdf->AddPage();
        $pdf->writeHTML($html);
        $pdf->Output();
    } elseif($_POST['page']=="image"){
        //convert to pdf
        $pdf = new TCPDF();
        $pdf->AddPage();
        $pdf->Image($_FILES["image"]["tmp_name"], 10, 10);
        $pdf->Output();

    }
}



?>