<?php include ('config.php') ?>
<?php

session_start();
$con = $db;//mysqli_connect('localhost','root','','student');
//mysqli_select_db($con,'assessmentportal');
if($con === false) 
{
	die("ERROR:Could not connect.".mysqli_connect_error());
}

ob_start();
  require("fpdf/fpdf.php");
  
 $sem = mysqli_real_escape_string($db, $_POST['sem']);
$prog = mysqli_real_escape_string($db, $_POST['prog']);
$arr = explode(" ", $prog);
	$course = $arr[0];
	$branch = $arr[1];
		if(empty($branch)){
			$branch = "NULL";
		}
$block = mysqli_real_escape_string($db, $_POST['room']);
$arr = explode(" ", $block);
	$block = $arr[0];
	$room = $arr[1];
$date = mysqli_real_escape_string($db, $_POST['dt']);
$session = mysqli_real_escape_string($db, $_POST['session']);
$exam = mysqli_real_escape_string($db, $_POST['exam']);
$year = date("Y")-(int)($sem/2);
$mon = date("m");
if(($sem%2!=0)&&($mon<'07'))
$year--;
$st ='';
$end ='';
$code = '';
$title = '';
$q = "select `sitting plan`.*,datesheet.Paper,papers.Title from datesheet,rooms,`sitting plan`,papers where `Exam Type` = '$exam' and Date = '$date' and Session = '$session' and datesheet.Course = '$course' and datesheet.Branch = '$branch' and datesheet.Sem = $sem and rooms.`Room No`='$room' and rooms.Block = '$block' and datesheet.Id = `sitting plan`.DS_Id and `sitting plan`.Room = rooms.Id and papers.Code = datesheet.Paper";
$results = mysqli_query($db, $q);
if($row=mysqli_fetch_assoc($results)){
	$st = $row["Start"];
	$end = $row["End"];
	$code = $row["Paper"];
	$title = $row["Title"];
}
$table = '';
$table2 ='';
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
class PDF extends FPDF{	
		var $exam,$block,$room,$date,$session,$sem,$code,$title,$prog;
        function header()
        {
            $this->SetFont('Arial','B',15);
            $this->Image('https://img.collegepravesh.com/2015/12/IGDTUW-Logo.png',10,10,30);
            $this->Cell(30); 
            $this->Cell(50,10,'INDIRA GANDHI DELHI TECHNICAL UNIVERSITY FOR WOMEN',0,1);
            $this->Cell(70); 
            $this->SetFont('Arial','B',13);
            $this->Cell(50,10,'Kashmere Gate , New Delhi-110006',0,1);
			$this->Cell(85);
			$this->Cell(50,10,'Examination Division',0,1);
			$this->SetFillColor(100,111,101);
			$this->Cell(190,1,"",0,1,"",TRUE);
			$this->Ln();
            $this->Cell(50);
            $this->Cell(50,10,"ATTENDANCE  SHEET for ".$this->exam." Examination",0,1);
			$this->SetFillColor(100,111,101);
			$this->Cell(190,1,"",0,1,"",TRUE);
			$this->Ln(5);
			$this->SetFont("Arial","B",13);
			$this->Cell(70,10,"Block:  ".$this->block,1,0); // width,height,string,border,next line
			$this->Cell(120,10,"Room No.:  $this->room",1,1); // width,height,string,border,next line
			$this->Cell(70,10,"Programme:  $this->prog",1,0); // width,height,string,border,next line
			$this->Cell(120,10,"Date of Exam:  $this->date  $this->session",1,1);
			$this->Cell(70,10,"Semester: $this->sem",1,0); // width,height,string,border,next line
			$x = $this->GetX();
			$y = $this->GetY();
			$this->MultiCell(120,5,"Paper Code and Name: $this->code $this->title",1,1); // width,height,string,border,next line

			$this->Cell(190,10,"Name & Sign Invigilator(1): ",1,1); 
			$this->Cell(190,10,"Name & Sign Invigilator(2): ",1,1); 
            
			$this->Ln();
			$this->SetFont("Arial","B");
			$this->Cell(15,10,"S.NO.",1,0);
			$this->Cell(35,10,"Enrollment No.",1,0);
			$this->Cell(65,10,"Name",1,0);
			$this->Cell(38,10,"Sheet No.",1,0);
			$this->Cell(38,10,"Signature",1,1);
			$this->SetFont("Arial","",13);
        }
		function Footer(){
		$this->Ln(5);
		$this->SetY(-30);
			$this->SetFont("Arial","",13);
			$this->Cell(70,10,"Total Present(A) ____",0,0);
			$this->Cell(70,10,"Total Absent(B) ____",0,0);
			$this->Cell(70,10,"Total(A+B) ____",0,1);
			$this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
		}
		function setV($e,$b,$r,$d,$s,$sm,$c,$t,$p){
			$this->exam = $e;
			$this->block = $b;
			$this->room = $r;
			$this->date = $d;
			$this->session = $s;
			$this->sem = $sm;
			$this->code =$c;
			$this->title = $t;
			$this->prog = $p;
		}
}

$pdf = new PDF('P','mm','A4');
$pdf->SetAutoPageBreak(true, 30);

$pdf->setV($exam,$block,$room,$date,$session,$sem,$code,$title,$prog);


$pdf->AddPage();


$i = 3; 
$ind = 1;
if($table2 == '')
$q2 = "(SELECT register.Name,`".$table."`.* FROM `".$table."`,register where `".$table."`.rollno = register.Enrollment_No and rollno between '$st' and '$end' order by rollno)";
else
$q2 = "(SELECT register.Name,`".$table."`.* FROM `".$table."`,register where `".$table."`.rollno = register.Enrollment_No and `".$table."`.rollno between '$st' and '$end' ) union (SELECT register.Name,`".$table2."`.* FROM `".$table2."`,register where `".$table2."`.rollno = register.Enrollment_No and rollno between '$st' and '$end') order by rollno";
$result = mysqli_query($db, $q2);
while($obj = mysqli_fetch_row($result))
{   
$fieldcount = mysqli_num_fields($result);

      while($i < $fieldcount - 4)
       {  if($obj[$i] != NULL)
             {
			 $subcode = $obj[$i] ;
			 $roll = $obj[1];
			 if($subcode == $code){
			  $pdf->Cell(15,10,$ind,1,0);
			$pdf->Cell(35,10,$roll,1,0);
			$pdf->Cell(65,10,$obj[0],1,0);
			$pdf->Cell(38,10,"",1,0);
			$pdf->Cell(38,10,"",1,0);
			$ind=$ind+1;
			 $pdf->Ln();
			
			break;
			 }
		 }
             $i+=11;
			 }
}
 $pdf->output(); 
 ob_end_flush();

?>