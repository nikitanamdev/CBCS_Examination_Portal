<?php
include ('config.php');
session_start();
$con = $db;//mysqli_connect('localhost','root','root','student');
//mysqli_select_db($con,'assessmentportal');
if($con === false) 
{
	die("ERROR:Could not connect.".mysqli_connect_error());
}

$rollno = $_SESSION['username'];    //roll no of the student
   //echo $rollno = '00101012019';
     
		$sql =  "SELECT * FROM `register` WHERE  Enrollment_No = '$rollno' ";
            $result = mysqli_query($con,$sql);
            $obj = mysqli_fetch_row($result); 
             if($obj[3] == 'B.Tech')
            {
                    if($obj[4] == 'CSE')
                    { if( $rollno <= '08201012019'){
                             $code = '20'.'_';
                            }else{
                                $code = '21'.'_';}
                    }
                    else if($obj[4] == 'IT')
                                { if( $rollno <= '07301012019'){
                             $code = '22'.'_';
                            }else{
                                $code = '23'.'_';}
                    }
                    else if($obj[4] == 'ECE')
                                 $code = '24'.'_';
                    else if($obj[4] == 'MAE')
                                 $code = '25'.'_';
            }else if($obj[3] == 'B.Arch'){
                                    $code = '26'.'_';
            }
            else if($obj[3] == 'BBA'){
                                    $code = '27'.'_';
            }else if($obj[3] == 'MCA'){
                                    $code = '28'.'_';
            }else if($obj[3] == 'M.Tech'){
                                    if($obj[4] == 'CSE'){
                                        $code = '29'.'_';
                                    }else if($obj[4] == 'IT'){
                                        $code = '30'.'_';
                                    }else if($obj[4] == 'ECE'){
                                         $code = '31'.'_';
                                    }else{
                                         $code = '32'.'_';
                                    }
            }else if($obj[3] == 'M.Plan'){
                                    $code = '33'.'_';
            }

        
														 
             $sem = $obj[5].'_';
             $year = $obj[6];
            $subcode = $obj[2];
        $mysql_tb = $code.$sem.$year;   // database name
            // query to be run again to fetch values
            $sql =  "SELECT * FROM `register` WHERE  Enrollment_No = '$rollno' ";
            $result = mysqli_query($con,$sql);
            $row = mysqli_fetch_assoc($result);
            $name = $row['Name'];
            $branch = $row['Branch'];
            $course = $row['Course'];
            $sem = $row['Semester'];
            



 require("fpdf/fpdf.php");

class PDF extends FPDF{
        function header()
        {
            $this->SetFont('Arial','B',13);
            //$this->Cell(12);  // is equivalent to Cell(12,0,'',0,0);
            $this->Image('logo.jpg',10,10,30);
            $this->Cell(30);
            $this->Cell(50,8,'INDIRA GANDHI DELHI TECHNICAL UNIVERSITY FOR WOMEN',0,1);
			$this->Cell(40);
		    $this->SetFont('Arial','',13);	
			$this->Cell(30,5,'(Established by Govt of NCT of Delhi Under Act 9 of 2012)',0,1);
            $this->Cell(70); 
            $this->SetFont('Arial','B',13);
            $this->Cell(50,8,'Kashmere Gate , New Delhi',0,1);
			$this->Cell(75);
			$this->Cell(60,8,'Examination Division',0,1);
            $this->Ln(5);
            $this->SetFillColor(103,111,101);
            $this->Cell(190,0.5,"",0,1,"",TRUE);
            $this->Ln(5);
        }
		function Footer()
	     {
	    // Position at 1.5 cm from bottom
	    $this->SetY(-20);
	    // Arial italic 8
		$this->Cell(40);
	    if ( $this->PageNo() == 1 ){        //footer for page 1
	         $this->SetFont('Arial','B',12);
	         $this->Cell(100);
			$this->Cell(40,7,'Dean(Examination Affairs)',0,1); 
			   $this->SetFont('Arial','',10);
			   $this->Cell(35);
	            $this->Cell(120,10,'Note:-Please visit www.igdtuw.ac.in for further information',0,1,'C');

	                 
	     }
		 }
		 function DumpFont($FontName,$num)
			{
					//$this->Cell(12,5.5,"$num");*/
					$this->SetFont($FontName);
					$this->Cell(2,5,chr($num),0,0);
				}
	
}

 $pdf = new PDF('P','mm','A4');
 $pdf->AddPage();
 $pdf->SetFont('Arial','B',12);	
              $pdf->Cell(40);
			  $pdf->Cell(70,5,'ADMIT CARD (PROVISIONAL) - END TERM EXAMINATION ',0,1);
			  $pdf->Cell(75);
			  $pdf->Cell(40,5,'DECEMBER 2019',0,1);
              $pdf->Ln();
			/*$pdf->Cell(150);
			$pdf->setFont('Arial','',8);
			$pdf->Cell(10,,'paste her recent',0,1);
*/
			$pdf->SetFont("Arial","B",11);
			$pdf->Rect(10,63,70,8);
       		$pdf->Cell(70,8,"Enrollment Number : ".$rollno,0,0);			
			
			$pdf->Rect(80,63,60,8);
			$pdf->setFont('Arial','B',11);
			$pdf->Cell(10,8,"Name : ".$name,0,1);
			
						
			$pdf->Rect(10,71,70,8);
			$pdf->setFont('Arial','B',11);
			$pdf->Cell(70,8,"Programme : ".$course,0,0);
			
			$pdf->Rect(80,71,60,8);
			$pdf->setFont('Arial','B',11);
			$pdf->Cell(30,8,"Semester : ".$sem,0,1);
			
			
			$pdf->Cell(150);
			$pdf->setFont('Arial','',8);
			$pdf->Cell(10,8,'paste your photo',0,1);

			
			//box for photo
			$pdf->Rect(160,60,30,30);
			
			/*$pdf->Cell(160);
			$pdf->Cell(10,5,'passport size',0,1);
			$pdf->Cell(160);
			$pdf->Cell(10,5,'photo with duly',0,1);
			$pdf->Cell(160);
			$pdf->Cell(10,5,'attested by HoD',0,1);
			*/	
             $pdf->Ln(7);
			$pdf->Rect(10,95,180,5);
			$pdf->Cell(20);
			$pdf->setFont('Arial','B',10);
			$pdf->Cell(100,5,"   PAPERS REGISTERED FOR THE END TERM EXAMINATION(MAY, 2020)",0,1);
            $pdf->Ln();
            
             $pdf->Cell(180,1," ",'L,R,T',1);
			//rectangle for subjects and their codes
			$query = "SELECT * FROM `".$mysql_tb."` WHERE rollno = '$rollno' ";
			$result = mysqli_query($con,$query);
			$i = 2; 
				
			while($obj = mysqli_fetch_row($result))
			{    $fieldcount = mysqli_num_fields($result);

				  while($i < $fieldcount - 4)
					 {  if($obj[$i] != NULL)
						 {     $subcode = $obj[$i] ;
						       $sub = $obj[$i+1];
						       $pdf->Cell(180,7,$subcode.'-'.$sub,'L,R',0);
						       $pdf->Ln();
	     	                   //$pdf->Cell(0,10,$sub,0,1);
						   }
			            $i+=11;
						 
					 }
			}
			

			$pdf->Cell(180,1," ",'L,R,B',1);

			//$pdf->Rect(10,105,180,70);
			//$pdf->Ln(10);
						
	        $pdf->Ln();

			$pdf->Cell(60);
			$pdf->setFont('Arial','',12);
			$pdf->Cell(80,10,"General instructions for students:",0,1);
			$pdf->Ln(2);
			$pdf->setFont('Arial','',10);
			$pdf->Cell(100,5,"1) A student must bring the Admit card to appear for the End-Semester Examination.Student not carrying the Admit",0,1);
			$pdf->Cell(5);
			$pdf->Cell(190,5,"Card will not be allowed to enter the Examination Center/write the Examination of the Day.",0,1);
			$pdf->Cell(190,5,"2) Only royal blue of blue black ink is to be used.No other ink is permissible.",0,1);
			$pdf->Cell(190,5,"3) Electronic equipementlike cellular phones,cameras,books or any other kind of support material etc. are not allowed in",0,1);
			$pdf->Cell(5);

			$pdf->Cell(190,5,"the Examination Hall",0,1);	
			$pdf->Cell(190,5,"4) The Examination Hall during End-Semester Examination will be opened 15 minuters before the time specified for the",0,1);	
			$pdf->Cell(5);

			$pdf->Cell(190,5,"commencement of the examination.No candidate who is late by more than 30 minutes shall be allowed to appear in",0,1);	
			$pdf->Cell(5);

            $pdf->Cell(190,5,"the examination.",0,1);
			$pdf->Cell(190,5,"5) No student,without the permission of the invigilators shall leave her seat or the Examination hall during ",0,1);	
			$pdf->Cell(5);

			$pdf->Cell(190,5,"the examination.",0,1);	
			$pdf->Cell(190,5,"6) Students are advised to read the regulations for Unfair Means available on University Website.UFM Cases will",0,1);	
			$pdf->Cell(5);

			$pdf->Cell(190,5,"be booked for any voilation of University Rules and Regulations.",0,1);
			$pdf->setFont('Arial','B',12);
			$pdf->Cell(190,5,"7) Bring Identity Card issued by Pan Card/Adhaar Card/Election Card/Driving.",0,1);
			$pdf->Cell(5);

			$pdf->Cell(190,5,"License/Passport/University ID card in Original for proof of identify.",0,1);	
			$pdf->Ln(7);
			//$pdf->Cell(140);
			//$pdf->Cell(40,8,'Dean(Examination Affairs)',0,1); 
		
			 


/*$pdf->SetFont("Arial","",13);
$query = "SELECT * FROM `".$mysql_tb."` WHERE rollno = '$rollno' ";
        $result = mysqli_query($con,$query);
		$i = 2; 
		
while($obj = mysqli_fetch_row($result))
{    $fieldcount = mysqli_num_fields($result);

      while($i < $fieldcount - 4)
	     {  if($obj[$i] != NULL)
             {$subcode = $obj[$i] ;
	     	 $sub = $obj[$i+1];
	     	 $pdf->Cell(50,10,$subcode,1,0);
	     	 $pdf->Cell(0,10,$sub,1,1);}
             
             $i+=11;
             
         }
}*/
 $pdf->output(); 
 ?>
 