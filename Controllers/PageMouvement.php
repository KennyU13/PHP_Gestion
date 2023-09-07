<?php
// use App\Autoloader;
// use App\Eglise;
require_once 'fpdf.php';

$pdf  = new FPDF();


$tableEntre  = $model->listEntre();
$tableSortie = $model->listSortie();
$sommeEntre  = $sommeE = $model->sommeEntre();
$sommeSortie = $sommeS = $model->sommeSortie();

if(isset($_POST['mouvement']))
{
    $_SESSION['date1'] = $date1 = $_POST['date1'];
    $_SESSION['date2'] = $date2 = $_POST['date2'];
    $tableEntre  = $model->listEntre($date1,$date2);
    $tableSortie = $model->listSortie($date1,$date2);
    $sommeEntre  = $model->sommeEntre($date1,$date2);
    $sommeSortie = $model->sommeSortie($date1,$date2);
    
}

#-----------------------------pdf----------------------------------
if(isset($_POST['generate']))
{
  
    $pdf->AddPage('P');
    
    $pdf->SetFont("Arial","B",16);
    $pdf->setTextColor(0,0,0);
    $pdf->Cell(200,20,"","0","1","C");
    $pdf->Cell(0,10,"ETAT DES MOUVEMENTS EN CAISSE","0","1","C");
    $pdf->SetFont("Arial","B",13);

    if(!empty($_SESSION['date1']) && !empty($_SESSION['date2']))
    {
        $tableEntre  = $model->listEntre($_SESSION['date1'],$_SESSION['date2']);
        $tableSortie = $model->listSortie($_SESSION['date1'],$_SESSION['date2']);
        $sommeEntre  = $model->sommeEntre($_SESSION['date1'],$_SESSION['date2']);
        $sommeSortie = $model->sommeSortie($_SESSION['date1'],$_SESSION['date2']);

        $pdf->Cell(0,20,"Entre ".$_SESSION['date1']." et ".$_SESSION['date2'],"0","1","C");
       
    }
    $pdf->Cell(200,10,"","0","1","C");

    $pdf->setLeftMargin(15);
    //-------------------------------------Entre-------------------------------
    $pdf->SetFont("Arial","BU",13);
    $pdf->Cell(200,20,"Mouvement d'entree en caisse :","0","1","L");
    $pdf->SetFont("Arial","B",10);

    $pdf->Cell(60,10,"Date d'entree","1","0","C");
    $pdf->Cell(60,10,"Motif","1","0","C");
    $pdf->Cell(60,10,"Montant (Ar)","1","0","C");

    $pdf->Cell(200,10,"","0","1","C");
    $pdf->SetFont("Arial","",10);

if(!empty($tableEntre))
{
    foreach($tableEntre as $cell)
    {

        $pdf->Cell(60,10,$cell['dateEntre'],"1","0","C");
        $pdf->Cell(60,10,$cell['motif'],"1","0","C");
        $pdf->Cell(60,10,number_format($cell['montantEntre'],0,'',' '),"1","0","C");
        $pdf->Cell(100,10,"","0","1","0");
        #cell: width,height,text,border,in,align
        #cell: 0|1 , 
    }
}
else
{
    $pdf->Cell(60,10,"...............","1","0","C");
    $pdf->Cell(60,10,"...............","1","0","C");
    $pdf->Cell(60,10,"...............","1","0","C");
}
$pdf->Cell(200,10,"","0","1","0");
$pdf->SetFont("Arial","I",10);
$pdf->Cell(180,0,"Total Montant entrant :  ".number_format($sommeEntre,0,'',' ')." Ar ","0","1","R");
//-------------------------------------SORTIE-------------------------------
$pdf->SetFont("Arial","BU",13);
$pdf->Cell(200,20,"Mouvement de sortie en caisse :","0","1","L");
$pdf->SetFont("Arial","B",10);

$pdf->Cell(60,10,"Date de sortie","1","0","C");
$pdf->Cell(60,10,"Motif","1","0","C");
$pdf->Cell(60,10,"Montant (Ar)","1","0","C");

$pdf->Cell(200,10,"","0","1","C");
$pdf->SetFont("Arial","",10);

if(!empty($tableSortie))
{
    foreach($tableSortie as $cell)
    {
        $pdf->Cell(60,10,$cell['dateSortie'],"1","0","C");
        $pdf->Cell(60,10,$cell['motif'],"1","0","C");
        $pdf->Cell(60,10,number_format($cell['montantSortie'],0,'',' '),"1","0","C");
        $pdf->Cell(100,10,"","0","1","0");
    }

   
}
else
{
        $pdf->Cell(60,10,"...............","1","0","C");
        $pdf->Cell(60,10,"...............","1","0","C");
        $pdf->Cell(60,10,"...............","1","0","C");
}
$pdf->Cell(200,10,"","0","1","C");
$pdf->SetFont("Arial","I",10);
$pdf->Cell(180,0,"Total Montant sortant :  ".number_format($sommeSortie,0,'',' ')." Ar ","0","1","R");


$pdf->SetFont("Arial","",10);
$pdf->Cell(0,40,"**********************************************","0","1","C");

$pdf->Output('doc.pdf','I');

}
#-----------------------------pdf----------------------------------


?>