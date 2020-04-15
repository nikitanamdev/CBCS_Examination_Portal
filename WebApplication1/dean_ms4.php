<?php 
include ('config.php') ;
session_start();
$con = $db;//mysqli_connect('localhost','root','root','student');
//mysqli_select_db($con,'assessmentportal');
if($con === false) 
{
	die("ERROR:Could not connect.".mysqli_connect_error());
}

    $code = $_GET['id'];;    //roll no of the student
   //$rollno = '00101012019';
   
   $semuse = $_SESSION['sem'];
   $year = '2019';

		

        $mysql_tb = $code.'_'.$semuse.'_'.'2019'; 

		    // query to be run again to fetch values
        require("fpdf/fpdf.php");
//require('subwrite.php');

  
  class PDF extends FPDF{
        function header()
        {   if ( $this->PageNo()%2 != 0){    //header for page 1
            $this->SetFont('Arial','B',15);
            //$this->Cell(12);  // is equivalent to Cell(12,0,'',0,0);
            
            $this->Cell(60); 
            $this->Cell(50,10,'STATEMENT OF GRADES',0,1);
            $this->Cell(30); 
            $this->SetFont('Arial','B',13);
            $this->Cell(50,10,'Bachelor of Technology (Computer Science and Engineering)',0,1);
            $this->Ln(15);
           }
        }

        function Footer()
     {
	    // Position at 1.5 cm from bottom
	    $this->SetY(-15);
	    // Arial italic 8
	    if ( $this->PageNo()%2 != 0 ){        //footer for page 1
	         $this->SetFont('Arial','B',13);
	            $this->Cell(120,10,'Date of issue:',0,0);
	            
	            $this->Cell(40,10,'Dean(Examination Affairs)',0,1);
	     }
		 else if($this->PageNo()%2 == 0){
			  $this->SetFont('Arial','B',13);
			  $this->Cell(120,10,'Prepared By:',0,0);
			  $this->Cell(60,10,'Verified By:',0,1);
			  }
	 }
	 function DumpFont($FontName,$num)
			{
				//$this->AddPage();
				// Title
				//$this->SetFont('Arial','',10);
				//$this->Cell(0,6,$FontName,0,1,'C');
				// Print all characters in columns
				//$this->SetCol(0);
				//for($i=32;$i<=255;$i++)
					/*$this->SetFont('Arial','',8);
					$this->Cell(60);
					$this->Cell(12,5.5,"$num");*/
					$this->SetFont($FontName);
					$this->Cell(2,5,chr($num),0,0);
				}
				//$this->SetCol(0);
		
		function subWrite($h, $txt, $subFontSize, $subOffset)
		{
			// resize font
			$subFontSizeold = $this->FontSizePt;
			$this->SetFontSize($subFontSize);
			
			// reposition y
			$subOffset = ((($subFontSize - $subFontSizeold) / $this->k) * 0.3) + ($subOffset / $this->k);
			$subX        = $this->x;
			$subY        = $this->y;
			$this->SetXY($subX, $subY - $subOffset);

			//Output text
			$this->Write($h, $txt);

			// restore y position
			$subX        = $this->x;
			$subY        = $this->y;
			$this->SetXY($subX,  $subY + $subOffset);

			// restore font size
			$this->SetFontSize($subFontSizeold);
		}
			 
  }


            if($semuse == 1 || $semuse == 2)
               $year_strt = $year;
           else if($semuse == 3 || $semuse == 4)
               $year_strt = $year + 1;
           else if($semuse == 5 || $semuse == 6)
               $year_strt = $year + 2;
           else if($semuse == 7 || $semuse == 8)
               $year_strt = $year + 3;

            if($semuse == 1 || $semuse == 2)
               $year_end = $year + 1;
           else if($semuse == 3 || $semuse == 4)
               $year_end = $year + 2;
           else if($semuse == 5 || $semuse == 6)
               $year_end = $year + 3;
           else if($semuse == 7 || $semuse == 8)
               $year_end = $year + 4;

            $batch = $year_strt.'-'.$year_end;
            

            if($semuse == 1)
            	$year_sem = "1st Year 1st Semester";
            else if($semuse == 2)
            	$year_sem = "1st Year 2nd Semester";
            else if($semuse == 3)
            	$year_sem = "2nd Year 3rd Semester";
            else if($semuse == 4)
            	$year_sem = "2nd Year 4th Semester";
            else if($semuse == 5)
            	$year_sem = "3rd Year 5th Semester";
            else if($semuse == 6)
            	$year_sem = "3rd Year 6th Semester";
            else if($semuse == 7)
            	$year_sem = "4th Year 7th Semester";
            else if($semuse == 8)
            	$year_sem = "4th Year 8th Semester";


             if($semuse == 1)
            	$month_year = "December  ".($year);
            else if($semuse == 2)
            	$month_year = "May  ".($year+1);
            else if($semuse == 3)
            	$month_year = "December  ".($year+1);
            else if($semuse == 4)
            	$month_year = "May  ".($year+2);
            else if($semuse == 5)
            	$month_year = "December  ".($year+2);
            else if($semuse == 6)
            	$month_year = "May  ".($year+1);
            else if($semuse == 7)
            	$month_year = "December  ".($year+3);
            else if($semuse == 8)
            	$month_year = "May  ".($year+1);
$pdf = new PDF('P','mm','A4');
        $rollno;
        $using ="SELECT rollno FROM `".$mysql_tb."` order by rollno ";
                $rusing = mysqli_query($con,$using);
                while($rowss = mysqli_fetch_assoc($rusing)){ 
                	$rollno = $rowss['rollno'];
                	
                

            $sql =  "SELECT * FROM `register` WHERE  Enrollment_No = '$rollno' ";
            $result = mysqli_query($con,$sql);
            $row = mysqli_fetch_assoc($result);
            $name = $row['Name'];
            $branch = $row['Branch'];
            $course = $row['Course'];
            $sem = $row['Semester'];

            

           


 
 $pdf->AddPage();
 $pdf->SetFont("Arial","",10);
		 $pdf->Cell(45,10,"Student Name: ",0,0);
		// $pdf->Cell(50,10,"AAMIYA GARG",0,0);
		$pdf->Cell(50,10,$name,0,0);

		 $pdf->Cell(45,10,"Enrollment Number: ",0,0);
		// $pdf->Cell(30,10,"00101012019",0,1);
        $pdf->Cell(30,10,$rollno,0,1);

		 $pdf->Cell(45,10,"Batch: ",0,0);
		 $pdf->Cell(50,10,$batch,0,0);
		 $pdf->Cell(45,10,"Year & Semester: ",0,0);
		 $pdf->Cell(70,10,$year_sem,0,1);

		 $pdf->Cell(45,10,"Month & Year: ",0,0);
		 $pdf->Cell(50,10,$month_year,0,0);
		 $pdf->Cell(45,10,"Regular Result ",0,0);
		 //$pdf->Cell(30,10,"00101012019",0,1);

		 
		 $pdf->Ln();
		 $pdf->Ln();
		 $pdf->SetFont("Arial","B",10);
			
			$pdf->Cell(30,10,"Paper Code",1,0);
			$pdf->Cell(80,10,"Paper Name",1,0,"C");      //C to align center
			$pdf->Cell(20,10,"Credits",1,0);
			$pdf->Cell(40,10,"Credits Secured",1,0);
			$pdf->Cell(20,10,"Grade",1,1);
			
			$pdf->SetFont("Arial","",10);
		    
		    $sum=0;  // sum of Ci (credits secured)
		    $total=0;
		    $sum1 = 0;  //used for calculating sgpa -> Ci * Pi
			$query = "SELECT * FROM `".$mysql_tb."` WHERE rollno = '$rollno' ";
			$result = mysqli_query($con,$query);
			$i = 2; 
				
			while($obj = mysqli_fetch_row($result))
			{    $fieldcount = mysqli_num_fields($result);

				  while($i < $fieldcount - 4)
					 {  if($obj[$i] != NULL)
						 {     $subcode = $obj[$i] ;
						       $sub = $obj[$i+1];
						       $grade = $obj[$i+10];
						 $pdf->Cell(30,10,$subcode,1,0);
						 $pdf->Cell(80,10,$sub,1,0);
                                $q = "SELECT * FROM `papers` WHERE Code = '$subcode'";
			                    $r = mysqli_query($con,$q);
                                $row1 = mysqli_fetch_assoc($r);
			             $pdf->Cell(20,10,$row1['Credits'],1,0);
			                    $total += $row1['Credits'];

			                  if($grade == 'F')
			                  $pdf->Cell(40,10,'0',1,0);
			                  else 
			                  { $pdf->Cell(40,10,$row1['Credits'],1,0);
			                       $sum += $row1['Credits'];

			                   }
			              $pdf->Cell(20,10,$grade,1,1);

			              if($grade == 'A+')
			              	$sum1 += 10*($row1['Credits']);
			              else if($grade == 'A')
			              	$sum1 += 9*($row1['Credits']);
			              else if($grade == 'B+')
			              	$sum1 += 8*($row1['Credits']);
			              else if($grade == 'B')
			              	$sum1 += 7*($row1['Credits']);
			              else if($grade == 'C+')
			              	$sum1 += 6*($row1['Credits']);
			              else if($grade == 'C')
			              	$sum1 += 5*($row1['Credits']);
			              else if($grade == 'D')
			              	$sum1 += 4*($row1['Credits']);
			              }
						 
						 $i+=11;
						 
					 }
			}


			//after the complete table subjects
			$pdf->Cell(30,10,"",1,0);
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(80,10,"TOTAL",1,0,"C");      //C to align text to center in cell
			$pdf->Cell(20,10,$total,1,0);
			$pdf->Cell(40,10,$sum,1,0);
			$pdf->Cell(20,10,"",1,1);
            
            
		    $pdf->Ln();
		    $sgpa = round($sum1 / $total , 2);
            $pdf->SetFont('Arial','B',10);
			$pdf->Cell(80,10,"Credits Secured/TOTAL CREDITS:",0,0);
			$pdf->Cell(20,10,$sum."/".$total,0,0);
			$pdf->SetLeftMargin(160);         //for moving cell to right
			$pdf->Cell(20,10,"SGPA:",0,0);
			$pdf->Cell(10,10,$sgpa,0,1);
             
            //$pdf->Ln();
            $pdf->SetLeftMargin(10);         //to set the initial one
            $pdf->Cell(20,10,"",0,1);         // placing invisible cell that is going to right
             $pdf->Cell(20,10,"Legend:",0,1);
            $pdf->Cell(40,10,"DT:Detained",0,0);
            
            $pdf->Cell(20,10,"RL:Result Later",0,1);
            $pdf->Cell(20,10,"*:Back Paper",0,1);
            $pdf->Cell(20,10,"**:NUES(Non University Examination System)",0,1);


 $pdf->AddPage();
 $pdf->Rect(10,27,190,200);

 $pdf->SetFont('Arial','B',15);
            //$pdf->Ln();
            $pdf->Cell(5); 
            $pdf->Cell(60,20,'Grading System',0,1);
            $pdf->Cell(30); 
			$pdf->Ln();
			
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(5);
			$pdf->Cell(190,5,'(a)  The letter grades to the students will be awarded as per their academic performance on the basis of',0,1);
		    $pdf->Cell(20);
			$pdf->Cell(100,5,'following scheme:',0,1);
			$pdf->Ln();

			$pdf->Cell(30);			
			$pdf->SetFont("Arial","B");
			$pdf->Cell(50,5,"Academic performance",1,0,"C");
			$pdf->Cell(20,5,"Grades",1,0,"C");      //C to align center
			$pdf->Cell(30,5,"Grade Points",1,1,"C");
			
			$pdf->SetFont("Arial","");
			$pdf->Cell(30);
			$pdf->Cell(50,5,"Outstanding",1,0,"C");
			$pdf->Cell(20,5,"A+",1,0,"C");      
			$pdf->Cell(30,5,"10",1,1,"C");
			
			$pdf->Cell(30);
			$pdf->Cell(50,5,"Excellent",1,0,"C");
			$pdf->Cell(20,5,"A",1,0,"C");      
			$pdf->Cell(30,5,"9",1,1,"C");
			
			$pdf->Cell(30);
			$pdf->Cell(50,5,"Very Good",1,0,"C");
			$pdf->Cell(20,5,"B+",1,0,"C");      
			$pdf->Cell(30,5,"8",1,1,"C");
			
			$pdf->Cell(30);
			$pdf->Cell(50,5,"Good",1,0,"C");
			$pdf->Cell(20,5,"B",1,0,"C");   
   			$pdf->Cell(30,5,"7",1,1,"C");
			
			$pdf->Cell(30);
			$pdf->Cell(50,5,"Average",1,0,"C");
			$pdf->Cell(20,5,"C+",1,0,"C");      //C to align center
			$pdf->Cell(30,5,"6",1,1,"C");
			
			$pdf->Cell(30);
			$pdf->Cell(50,5,"Below Average",1,0,"C");
			$pdf->Cell(20,5,"C",1,0,"C");      //C to align center
			$pdf->Cell(30,5,"5",1,1,"C");
			$pdf->Cell(30);
			$pdf->Cell(50,5,"Marginal",1,0,"C");
			$pdf->Cell(20,5,"D",1,0,"C");      //C to align center
			$pdf->Cell(30,5,"4",1,1,"C");
			$pdf->Cell(30);
			$pdf->Cell(50,5,"Poor",1,0,"C");
			$pdf->Cell(20,5,"F",1,0,"C");      //C to align center
			$pdf->Cell(30,5,"0",1,1,"C");
			$pdf->Ln();
			
			$pdf->SetFont("Arial","",10);
            $pdf->Cell(5);
			$pdf->Cell(190,5,'(b) Calculation of Semester Grade Point Average (SGPA) and Cumulative Grade Point Average (CGPA) shall ',0,1);
		    $pdf->Cell(10);
		    $pdf->Cell(190,5,'be basis of the credits and Grade points in the course of the semester appeared by the student as follows:',0,1);
		    $pdf->Ln();
			
			// complete statements for spga formula
			$pdf->Cell(65);
			//$pdf->DumpFont('Arial',61);	
			$pdf->setFont('Arial','',12);			
			$pdf->DumpFont('Symbol',83);
			$pdf->Cell(0.3);
			//$pdf->Cell(0.1);
			$pdf->subWrite(7,'n',7,9);
			$pdf->Cell(-0.2);
			$pdf->subWrite(7,"i=1",7,-1);
			//$pdf->Cell(5);
			$pdf->DumpFont('Arial',67);
			//$pdf->Write(5,'X');
			$pdf->Cell(0.6);
			$pdf->subWrite(7,"i",7,-1);
			$pdf->Cell(1);
			$pdf->DumpFont('Arial',215);
			$pdf->Cell(1);
			$pdf->DumpFont('Arial',80);
			$pdf->subWrite(7,"i",7,-1);
			
			$pdf->Ln(2);
			$pdf->SetFont("Arial","B");
			$pdf->Cell(45);
			$pdf->Cell(10,5,'SGPA',0,0);
			$pdf->Cell(5);
			$pdf->SetFont("Arial","",12);
			//$pdf->Cell(5);
			$pdf->DumpFont('Arial',61);
			$pdf->ln(1);
            $pdf->Cell(63);			
			$pdf->DumpFont('Arial',151);
			$pdf->Cell(2.2);
			$pdf->DumpFont('Arial',151);
			$pdf->Cell(2.2);
			$pdf->DumpFont('Arial',151);
			$pdf->Cell(2.2);
			$pdf->DumpFont('Arial',151);
			$pdf->Cell(2.2);
			$pdf->DumpFont('Arial',151);
			
			$pdf->Ln(3);
			$pdf->Cell(70);
			$pdf->setFont('Arial','',12);			
			$pdf->DumpFont('Symbol',83);
			$pdf->Cell(0.3);
			$pdf->subWrite(7,'n',7,9);
			$pdf->Cell(-0.2);
			$pdf->subWrite(7,"i=1",7,-1);
			$pdf->DumpFont('Arial',67);

			$pdf->Cell(0.6);
			$pdf->subWrite(7,"i",7,-1);


			
			
			/*$pdf->Cell(10);
			$pdf->Write(5,'c');
			$pdf->subWrite(7,"i",7,-4);
			/*$pdf->Write(5,'x');
			$pdf->Write(5,'p');
			$pdf->subWrite(7,"i",7,-4);
			
			//continue from statement c
			 $pdf->Ln();
			$pdf->Cell(10);
			*/
			$pdf->SetFont("Arial","",10);
			$pdf->Ln();
			$pdf->Cell(5);
			$pdf->Cell(10,5,'Where',0,0);
			$pdf->DumpFont('Arial',44);	
			$pdf->Ln(5);
			$pdf->Cell(10);
			$pdf->Write(5,'C');
			$pdf->subWrite(5,'i',6,-3);
			$pdf->DumpFont('Arial',61);		
		    //$pdf->Cell(10);
		    $pdf->Cell(130,5,'Number of Credits of the ith  course of a semester for which SGPA is to be calculated',0,0);
			$pdf->DumpFont('Arial',46);//for full stop
			
			$pdf->Ln(5);
			$pdf->Cell(10);
			$pdf->Write(5,'P');
			$pdf->subWrite(5,'i',6,-3);
			$pdf->DumpFont('Arial',61);		
            $pdf->Cell(73,5,'Grade Point obtained in the ith  course and i =',0,0);
			// code for equal to
			//$pdf->DumpFont('Arial',61);		
			$pdf->Cell(10,5,'1 to v,',0,0);
			//code for comma 
			//$pdf->DumpFont('Arial',44);
			$pdf->Cell(50,5,'represent the number of course in',0,1);
			$pdf->Cell(15);
			$pdf->Cell(100,5,'which a student is registered in the concerned semster.',0,0);
			//$pdf->DumpFont('Arial',46);// code for full stop
			$pdf->Ln(10);
		    
			//cgpa formula is to be written
			$pdf->Cell(65);
			//$pdf->DumpFont('Arial',61);	
			$pdf->setFont('Arial','',12);			
			$pdf->DumpFont('Symbol',83);
			$pdf->Cell(0.3);
			//$pdf->Cell(0.1);
			$pdf->subWrite(7,'m',7,9);
			$pdf->Cell(-0.2);
			$pdf->subWrite(7,"i=1",7,-1);
			//$pdf->Cell(5);
			$pdf->DumpFont('Arial',67);
			//$pdf->Write(5,'X');
			$pdf->Cell(0.6);
			$pdf->subWrite(7,"i",7,-1);
			$pdf->Cell(1);
			$pdf->DumpFont('Arial',215);
			$pdf->Cell(1);
			$pdf->DumpFont('Arial',80);
			$pdf->subWrite(7,"i",7,-1);
			
			$pdf->Ln(2);
			$pdf->SetFont("Arial","B");
			$pdf->Cell(45);
			$pdf->Cell(10,5,'CGPA',0,0);
			$pdf->Cell(5);
			$pdf->SetFont("Arial","",12);
			//$pdf->Cell(5);
			$pdf->DumpFont('Arial',61);
			$pdf->ln(1);
            $pdf->Cell(63);			
			$pdf->DumpFont('Arial',151);
			$pdf->Cell(2.2);
			$pdf->DumpFont('Arial',151);
			$pdf->Cell(2.2);
			$pdf->DumpFont('Arial',151);
			$pdf->Cell(2.2);
			$pdf->DumpFont('Arial',151);
			$pdf->Cell(2.2);
			$pdf->DumpFont('Arial',151);
			
			$pdf->Ln(3);
			$pdf->Cell(70);
			$pdf->setFont('Arial','',12);			
			$pdf->DumpFont('Symbol',83);
			$pdf->Cell(0.3);
			$pdf->subWrite(7,'m',7,9);
			$pdf->Cell(-0.2);
			$pdf->subWrite(7,"i=1",7,-1);
			$pdf->DumpFont('Arial',67);

			$pdf->Cell(0.6);
			$pdf->subWrite(7,"i",7,-1);

			$pdf->setFont('Arial','',10);
			
			$pdf->Ln(15);
			//$pdf->Ln();
			$pdf->Cell(5);
			$pdf->Cell(10,5,'Where',0,0);
			$pdf->DumpFont('Arial',44);	
			$pdf->Ln(5);
			$pdf->Cell(10);
			$pdf->Write(5,'C');
			$pdf->subWrite(5,'i',6,-3);
			$pdf->DumpFont('Arial',61);		
		    $pdf->Cell(80,5,'Number of Credits of the ith  course of a semester.',0,0);
			//$pdf->DumpFont('Arial',46);
			
			
			$pdf->Ln(5);
			$pdf->setFont('Arial','',10);
			$pdf->Cell(10);
			$pdf->Write(5,'P');
			$pdf->subWrite(5,'i',6,-3);
			$pdf->DumpFont('Arial',61);		
            $pdf->Cell(60,5,'Grade Point obtained in the ith  course',0,0);
			$pdf->DumpFont('Arial',46);
			$pdf->Cell(35,5,'A grade lower than D',0,0);
			$pdf->DumpFont('Arial',40);//code for opening bracket
			$pdf->Cell(0.5,5,'i',0,0);
			$pdf->DumpFont('Arial',46);
			$pdf->Cell(0.5,5,'e',0,0);
			$pdf->DumpFont('Arial',46);
			$pdf->Cell(18,5,'grade point',0,0);
			$pdf->DumpFont('Arial',41);//code for closing bracket
			$pdf->Cell(20,5,'in a course shall not',0,1);
			
			$pdf->Cell(15);
			$pdf->Cell(47,5,'be taken into account and i =',0,0);
			//$pdf->DumpFont('Arial',61);
			$pdf->Cell(10,5,'1 to u',0,0);
			$pdf->DumpFont('Arial',44);
			$pdf->Cell(80,5,'represent the number of courses in which a student was registered',0,1);
			$pdf->Cell(15);
			$pdf->Cell(80,5,'and obtained a grade not lower than D upto that semester for which CGPA is to be calculated.',0,0);
			//$pdf->DumpFont('Arial',46);
			
			
			
		

 
  }               
    $pdf->output();           	
?>