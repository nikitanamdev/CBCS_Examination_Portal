﻿<?php 
include ('config.php') ?>
<?php

session_start();
$user = $_SESSION['username'];
$exam = $_SESSION['exam'] ;
$date = $_SESSION['date'];
$session = $_SESSION['session'];
$id =mysqli_real_escape_string($db, $_GET['id']);
$q = "select * from SP where Id = $id";
$results = mysqli_query($db, $q);
$i = 1;
$room = '';
$bl = '';
$fl = '';
$st1 = '';
$end1 ='';
$st2 = '';
$end2 = '';
$two = '';
$roomid = '';
$course1 = '';
$course2 = '';
$branch1 = '';
$branch2 = '';
$pap1 = '';
$ben = '';
$pap2= '';
$sem = 0;
$num1 = 0;
$num2 = 0;
$St = '';
$end = '';
$Num = 0;
$Course = '';
$Branch='';
if($row = mysqli_fetch_assoc($results)){
	//if($i == $id){
		$ID = $row["Id"];
		$room = $row["Room No"];
		$roomid = $row["Room"];
		$bl = $row["Block"];
		$fl = $row["Floor"];
		$st1 = $row["Start"];
		$end1 = $row["End"];
		$pap1 =$row["Paper"];
		$sem = $row["Sem"];
		$course1 = $row["Course"];
		$branch1 = $row["Branch"];
		$num1 = $row["Count"];
		$ben = $row["Benches"];
		$two = $row["Two"];
		$Q = "select * from SP where Room = '$roomid' and Id!='$ID'";
			$Results = mysqli_query($db, $Q);
			if($Row = mysqli_fetch_assoc($Results)){
			$St = $Row["Start"];
			$End = $Row["End"];
			$Course = $Row["Course"];
			$Branch = $Row["Branch"];
			$Num = $Row["Count"];
			$Pap =$Row["Paper"];
			}
		if($two == 1){
			$q1 = "select * from SP where Room = '$roomid' and Id!='$ID'";
			$results1 = mysqli_query($db, $q1);
			if($row1 = mysqli_fetch_assoc($results1)){
			$st2 = $row1["Start"];
			$end2 = $row1["End"];
			$course2 = $row1["Course"];
			$branch2 = $row1["Branch"];
			$num2 = $row1["Count"];
			$pap2 =$row["Paper"];
			}
		}
		//break;
	//}
	//$i++;
}
$t = $num1 + $Num;
$r1 = (int)($t/5);
$r2 = (int)($t/5);
$r3 = (int)($t/5);
$r4 = (int)($t/5);
$r5 = (int)($t/5);
$rem = $t%5;
if($rem>0)
$r1++;
if($rem>1)
$r2++;
if($rem>2)
$r3++;
if($rem>3)
$r4++;
$course = $course1;
$branch =$branch1;
$table = '';
$table2 ='';
$year = date("Y")-(int)($sem/2);
$mon = date("m");
if(($sem%2!=0)&&($mon<'07'))
$year--;
if($course == 'B.Tech'){
		if($branch == 'CSE'){
				$table = '20_'.$sem.'_'.$year;
				$table2 = '21_'.$sem.'_'.$year;
		}else if($branch == 'IT'){
			$table = '22_'.$sem.'_'.$year;
			$table2 = '23_'.$sem.'_'.$year;
		}else if($branch == 'ECE'){
				$table = '24_'.$sem.'_'.$year;
		}else if($branch == 'MAE'){
				$table = '25_'.$sem.'_'.$year;
		}
	}
	else if($course == 'B.Arch'){
		$table = '26_'.$sem.'_'.$year;
	}
	else if($course == 'BBA'){
		$table = '27_'.$sem.'_'.$year;
	}
	else if($course == 'MCA'){
		$table = '28_'.$sem.'_'.$year;
	}
	else if($course == 'M.Tech'){
		if($branch == 'CSE'){
			$table = '29_'.$sem.'_'.$year;
		}else if($branch == 'IT'){
			$table = '30_'.$sem.'_'.$year;
		}else if($branch == 'ECE'){
				$table = '31_'.$sem.'_'.$year;
		}else if($branch == 'MAE'){
				$table = '32_'.$sem.'_'.$year;
		}
	}
	else if($course == 'M.Plan'){
		$table = '33_'.$sem.'_'.$year;
	}
if($table2=="")
$query1 = "select * from $table where rollno between '$st1' and '$end1' order by rollno";
else
$query1 = "select * from $table where rollno between '$st1' and '$end1' union select * from $table2 where rollno between '$st1' and '$end1' order by rollno";
$res = mysqli_query($db, $query1);

if($Course == 'B.Tech'){
		if($Branch == 'CSE'){
				$table = '20_'.$sem.'_'.$year;
				$table2 = '21_'.$sem.'_'.$year;
		}else if($Branch == 'IT'){
			$table = '22_'.$sem.'_'.$year;
			$table2 = '23_'.$sem.'_'.$year;
		}else if($Branch == 'ECE'){
				$table = '24_'.$sem.'_'.$year;
		}else if($Branch == 'MAE'){
				$table = '25_'.$sem.'_'.$year;
		}
	}
	else if($Course == 'B.Arch'){
		$table = '26_'.$sem.'_'.$year;
	}
	else if($Course == 'BBA'){
		$table = '27_'.$sem.'_'.$year;
	}
	else if($Course == 'MCA'){
		$table = '28_'.$sem.'_'.$year;
	}
	else if($Course == 'M.Tech'){
		if($Branch == 'CSE'){
			$table = '29_'.$sem.'_'.$year;
		}else if($Branch == 'IT'){
			$table = '30_'.$sem.'_'.$year;
		}else if($Branch == 'ECE'){
				$table = '31_'.$sem.'_'.$year;
		}else if($Branch == 'MAE'){
				$table = '32_'.$sem.'_'.$year;
		}
	}
	else if($Course == 'M.Plan'){
		$table = '33_'.$sem.'_'.$year;
	}
if($Num != 0){
if($table2=="")
$Query1 = "select * from $table where rollno between '$St' and '$End' order by rollno";
else
 $Query1 = "select * from $table where rollno between '$St' and '$End' union select * from $table2 where rollno between '$St' and '$End' order by rollno";
$Res = mysqli_query($db, $Query1);
}

require("fpdf/fpdf.php");


//pdf
	ob_start();
  
  class PDF extends FPDF{
        function header()
        { 
			$this->SetFont('Arial','B',15);
            $this->Image('https://img.collegepravesh.com/2015/12/IGDTUW-Logo.png',35,10,30);
            $this->Cell(70); 
            $this->Cell(150,10,'INDIRA GANDHI DELHI TECHNICAL UNIVERSITY FOR WOMEN',0,1);
            $this->Cell(110); 
            $this->SetFont('Arial','B',13);
            $this->Cell(120,10,'Kashmere Gate , New Delhi-110006',0,1);
			$this->Cell(125);
			$this->Cell(200,10,'Examination Division',0,1);
			$this->SetFillColor(100,111,101);
			$this->Cell(280,1,"",0,1,"",TRUE);
			$this->Ln();            
        }
}

$pdf = new PDF('L','mm','A4');
$pdf->SetAutoPageBreak(true, 0);
$pdf->AddPage();
$pdf->SetFont("Arial","B",13);
$pdf->Cell(100);
$pdf->Cell(120,10,"Seating Plan for ".$exam." Examination",0,1);
$pdf->Cell(140,10,"Date of Exam:  ".$date,1,0); // width,height,string,border,next line
$pdf->Cell(140,10,"Session:  $session",1,1); 
$pdf->Cell(140,10,"Block :  ".$bl." ".$fl,1,0); // width,height,string,border,next line
$pdf->Cell(140,10,"Room No.:  $room",1,1); 
$pdf->Ln();
$pdf->Cell(56,5,"         Row1",1,0);
$x2 = $pdf->GetX();
$pdf->Cell(56,5,"         Row2",1,0);
$x3 = $pdf->GetX();
$pdf->Cell(56,5,"         Row3",1,0);
$x4 = $pdf->GetX();
$pdf->Cell(56,5,"         Row4",1,0);
$x5 = $pdf->GetX();
$pdf->Cell(56,5,"         Row5",1,0);
$pdf->Ln();
$y = $pdf->GetY();
$y1=0;
$n =0;
if($two==0){
while($obj = mysqli_fetch_row($res)){
	$i=2;
	$fieldcount = mysqli_num_fields($res);
	while($i < $fieldcount - 4)
	{  if($obj[$i] != NULL)
		   {
			$subcode = $obj[$i] ;
			$roll = $obj[0];
			if($subcode == $pap1){			 
		
			if($r1>0)	{
				$r1--;
				$n=1;
			}
			else if($r2>0)	{
			$pdf->SetX($x2);
				$r2--;
				$n=2;
			}
			else if($r3>0)	{
		
			$pdf->SetX($x3);
				$r3--;
				$n=3;
			}
			else if($r4>0)	{
		
			$pdf->SetX($x4);
				$r4--;
				$n=4;
			}
			else if($r5>0)	{
		
			$pdf->SetX($x5);
				$r5--;
				$n=5;
			}

			$pdf->Cell(56,5,$roll,1,1);
			
			if(($r1==0)&&($n==1)){
			$y1=$pdf->GetY();
			$pdf->SetY($y);
			}
			if(($r2==0)&&($n==2)){
			$pdf->SetY($y);
			}
			if(($r3==0)&&($n==3)){
			$pdf->SetY($y);
			}
			if(($r4==0)&&($n==4)){
			$pdf->SetY($y);
			}
			break;
			}	
		 }
		  $i+=11;
	}
	if($r5==0){
	break;
	}
}
if($Num != 0){
while($obj = mysqli_fetch_row($Res)){
	$i=2;
	$fieldcount = mysqli_num_fields($Res);
	while($i < $fieldcount - 4)
	{  if($obj[$i] != NULL)
		   {
			$subcode = $obj[$i] ;
			$roll = $obj[0];
			if($subcode == $pap1){			 
		
			if($r1>0)	{
				$r1--;
				$n=1;
			}
			else if($r2>0)	{
			$pdf->SetX($x2);
				$r2--;
				$n=2;
			}
			else if($r3>0)	{
		
			$pdf->SetX($x3);
				$r3--;
				$n=3;
			}
			else if($r4>0)	{
		
			$pdf->SetX($x4);
				$r4--;
				$n=4;
			}
			else if($r5>0)	{
		
			$pdf->SetX($x5);
				$r5--;
				$n=5;
			}

			$pdf->Cell(56,5,$roll,1,1);
			
			if(($r1==0)&&($n==1)){
			$y1=$pdf->GetY();
			$pdf->SetY($y);
			}
			if(($r2==0)&&($n==2)){
			$pdf->SetY($y);
			}
			if(($r3==0)&&($n==3)){
			$pdf->SetY($y);
			}
			if(($r4==0)&&($n==4)){
			$pdf->SetY($y);
			}
			break;
			}	
		 }
		  $i+=11;
	}
	if($r5==0){
	break;
	}
}	
}
}else{

}
$pdf->SetY($y1);
$pdf->Ln();
$pdf->Cell(140,10,$course1.' '.$branch1.' '.$pap1,1,0); // width,height,string,border,next line
$pdf->Cell(140,10,"No. of Students:  ".$num1,1,1); 
if($Num != 0){
$pdf->Cell(140,10,$Course.' '.$Branch.' '.$Pap,1,0); // width,height,string,border,next line
$pdf->Cell(140,10,"No. of Students:  $Num",1,1); 
}
if($two==1){
$pdf->Cell(140,10,$course2.' '.$branch2.' '.$pap2,1,0); // width,height,string,border,next line
$pdf->Cell(140,10,"No. of Students:  $num2",1,1); 
}
$pdf->Cell(140,10,"Total Students:  ",1,0); // width,height,string,border,next line
$pdf->Cell(140,10,$num1 + $num2 + $Num,1,1); 
 $pdf->output(); 
 ob_end_flush();
?>