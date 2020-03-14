<?php 
include ('config.php') ?>
<?php

session_start();
$user = $_SESSION['username'];
$exam = $_SESSION['exam'] ;
$date = $_SESSION['date'];
$session = $_SESSION['session'];
$q = "select * from SP";
$results = mysqli_query($db, $q);
require("fpdf/fpdf.php");


//pdf
	ob_start();
  
  class PDF extends FPDF{
        function header()
        {
            
        }
}

$pdf = new PDF('L','mm','A4');
$pdf->SetAutoPageBreak(true, 0);
$pdf->AddPage();
$pdf->SetFont("Arial","B",13);
$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->MultiCell(64,10,"Seating Plan for $exam Examionation ",1,'L',0,1);// width,height,string,border,next line
$pdf->SetXY($x + 64,$y);
$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->MultiCell(24,10,"Date of Exam: ",1,'L',0,1); // width,height,string,border,next line
$pdf->SetXY($x + 24,$y);
$pdf->Cell(28,20,$date,1,0);
$pdf->Cell(88,20,"Session of Exam: ",1,0); // width,height,string,border,next line
$pdf->Cell(73,20,$session,1,0);
$pdf->SetFillColor(103,111,101);
$pdf->Ln();
$pdf->Cell(15,10,"S.NO.",1,0);
$pdf->Cell(26,10,"    Block",1,0);
$pdf->Cell(23,10,"   Floor",1,0);
$pdf->Cell(24,10,"Room No.",1,0);
$pdf->Cell(28,10,"Programme",1,0);
$pdf->Cell(88,10,"       Paper Code and Paper Name",1,0);
$pdf->Cell(73,10,"             No. of Students",1,0);
$pdf->SetFont("Arial","",13);

$ind = 1;
while($row=mysqli_fetch_assoc($results))
{ 
    $pdf->Ln();
	$pdf->Cell(15,20,$ind,1,0);
	$pdf->Cell(26,20,$row["Block"],1,0);
	$pdf->Cell(23,20,$row["Floor"],1,0);
	$pdf->Cell(24,20,$row["Room No"],1,0);
	$pdf->Cell(28,20,$row["Course"].' '.$row["Branch"],1,0);
	$x = $pdf->GetX();
	$y = $pdf->GetY();
	$height = 20/ceil(($pdf->GetStringWidth($row["Paper"].' '.$row["Title"]) / 88));
	$pdf->MultiCell(88,$height,$row["Paper"].' '.$row["Title"],1,'L',0,2);
	$pdf->SetXY($x + 88,$y);
	$st =$row["Start"] ;
	$end =$row["End"] ;
	$y = $pdf->GetY();
	$pdf->MultiCell(73,6.7,$row["Count"]."\n(Rollno from : $st to \n$end)",1,'L',0,3);
	$pdf->SetY($y+13.3);
	$ind=$ind+1;
}
 $pdf->output(); 
 ob_end_flush();
?>