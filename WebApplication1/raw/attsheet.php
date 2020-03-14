<?php include ('config.php') ?>
<?php

session_start();
$con = $db;//mysqli_connect('localhost','root','','student');
//mysqli_select_db($con,'assessmentportal');
if($con === false) 
{
	die("ERROR:Could not connect.".mysqli_connect_error());
}
$code = mysqli_real_escape_string($db, $_POST['select2']);
$sem = mysqli_real_escape_string($db, $_POST['select3']);
$prog = mysqli_real_escape_string($db, $_POST['select1']);
$year = date("Y")-(int)($sem/2);
$mon = date("m");
if(($sem%2!=0)&&($mon<'07'))
$year--;
$q="Select Title from papers where Code='$code' and Semester='$sem'";
$results = mysqli_query($db, $q);
$row=mysqli_fetch_assoc($results);
		$name = $row["Title"];
		$arr = explode(" ", $prog);
	$course = $arr[0];
	$branch = $arr[1];
		if(empty($branch)){
			$branch = "NULL";
		}
		$mysql_tb="";
		$mysql_tb2="";
            if($course == 'B.Tech')
            {
                    if($branch == 'CSE')
                    { 
                             $mysql_tb = '20'.'_'.$sem.'_'.$year;
							 $mysql_tb2 = '21_'.$sem.'_'.$year;
                           
                    }
                    else if($branch == 'IT')
                                { $mysql_tb = '22'.'_'.$sem.'_'.$year;
								$mysql_tb2 = '23_'.$sem.'_'.$year;
                    }
                    else if($branch == 'ECE')
                                 $mysql_tb = '24'.'_'.$sem.'_'.$year;
                    else if($branch == 'MAE')
                                 $mysql_tb = '25'.'_'.$sem.'_'.$year;
            }else if($course == 'B.Arch'){
                                    $mysql_tb = '26'.'_'.$sem.'_'.$year;}
            else if($course == 'BBA'){
                                    $mysql_tb= '27'.'_'.$sem.'_'.$year;
            }else if($course == 'MCA'){
                                    $mysql_tb = '28'.'_'.$sem.'_'.$year;
            }else if($course == 'M.Tech'){
                                    if($branch == 'CSE'){
                                        $mysql_tb = '29'.'_'.$sem.'_'.$year;
                                    }else if($branch == 'IT'){
                                        $mysql_tb = '30'.'_'.$sem.'_'.$year;
                                    }else if($branch == 'ECE'){
                                         $mysql_tb = '31'.'_'.$sem.'_'.$year;
                                    }else{
                                         $mysql_tb= '32'.'_'.$sem.'_'.$year;
                                    }
            }else if($course == 'M.Plan'){
				$mysql_tb = '33_'.$sem.'_'.$year;
			}
			ob_start();
  require("fpdf/fpdf.php");

class PDF extends FPDF{
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
            $this->Cell(70);
            $this->Cell(50,10,'ATTENDANCE  SHEET',0,1);
			$this->SetFillColor(100,111,101);
			$this->Cell(190,1,"",0,1,"",TRUE);
			$this->Ln(5);
            
        }
}

$pdf = new PDF('P','mm','A4');
$pdf->SetAutoPageBreak(true, 0);
$pdf->AddPage();
$pdf->SetFont("Arial","B",13);

$pdf->Cell(40,10,"Programme: ",1,0); // width,height,string,border,next line
$pdf->Cell(50,10,$prog,1,0);
$pdf->Cell(40,10,"Semester: ",1,0); // width,height,string,border,next line
$pdf->Cell(60,10,$sem,1,1);
$pdf->Cell(40,10,"Subject Code: ",1,0); // width,height,string,border,next line
$pdf->Cell(50,10,$code,1,0);
$pdf->Cell(40,10,"Subject: ",1,0); // width,height,string,border,next line
$pdf->Cell(60,10,$name,1,1);

$pdf->Cell(190,10,"Name & Sign Invigilator(1): ",1,1); 
$pdf->Cell(190,10,"Name & Sign Invigilator(2): ",1,1); 
$pdf->Cell(190,10,"Name & Sign Invigilator(3): ",1,1); 

$pdf->Ln();

$pdf->SetFont("Arial","B");
$pdf->SetFillColor(103,111,101);
$pdf->Cell(15,10,"S.NO.",1,0,"",TRUE);
$pdf->Cell(35,10,"Enrollment No.",1,0,"",TRUE);
$pdf->Cell(65,10,"Name",1,0,"",TRUE);
$pdf->Cell(38,10,"Sheet No.",1,0,"",TRUE);
$pdf->Cell(38,10,"Signature",1,0,"",TRUE);
$pdf->SetFont("Arial","",13);
if($mysql_tb2 == "")
$query = "(SELECT register.Name,`".$mysql_tb."`.* FROM `".$mysql_tb."`,register where `".$mysql_tb."`.rollno = register.Enrollment_No order by rollno)";
else
$query = "(SELECT register.Name,`".$mysql_tb."`.* FROM `".$mysql_tb."`,register where `".$mysql_tb."`.rollno = register.Enrollment_No ) union (SELECT register.Name,`".$mysql_tb2."`.* FROM `".$mysql_tb2."`,register where `".$mysql_tb2."`.rollno = register.Enrollment_No ) order by rollno";
$result = mysqli_query($con,$query);
$i = 3; 
$ind = 1;
while($obj = mysqli_fetch_row($result))
{   
$fieldcount = mysqli_num_fields($result);

      while($i < $fieldcount - 4)
       {  if($obj[$i] != NULL)
             {
			 $subcode = $obj[$i] ;
			 $roll = $obj[1];
			 if($subcode == $code){
			 $pdf->Ln();
			  $pdf->Cell(15,10,$ind,1,0);
			$pdf->Cell(35,10,$roll,1,0);
			$pdf->Cell(65,10,$obj[0],1,0);
			$pdf->Cell(38,10,"",1,0);
			$pdf->Cell(38,10,"",1,0);
			$ind=$ind+1;
			
			break;
			 }
		 }
             $i+=11;
			 }
}
 $pdf->output(); 
 ob_end_flush();
 ?>