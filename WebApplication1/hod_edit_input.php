<?php include('config.php');
         session_start();
         $con = $db;// mysqli_connect('localhost','root','root','student');

          $year = $_SESSION['year'];
         $subcode = $_SESSION['sub'];
         $sem = $_SESSION['sem'] ;
         /*
         $subcode = 'BAS-101';        //session variablrs
         $sem = '1'.'_';              //session variablrs
         $year = '2019';              //session variablrs
         $subname = 'Applied Mathematics';*/


         
         $um1 = $_POST['um1'];
         $lm1 = $_POST['lm1'];
         $um2 = $_POST['um2'];
         $lm2 = $_POST['lm2'];
         $um3 = $_POST['um3'];
         $lm3 = $_POST['lm3'];
         $um4 = $_POST['um4'];
         $lm4 = $_POST['lm4'];
         $um5 = $_POST['um5'];
         $lm5 = $_POST['lm5'];
         $um6 = $_POST['um6'];
         $lm6 = $_POST['lm6'];
         $um7 = $_POST['um7'];
         $lm7 = $_POST['lm7'];
         $um8 = $_POST['um8'];
         $lm8 = $_POST['lm8'];
         $uvalues = array($um1,$um2,$um3,$um4,$um5,$um6,$um7,$um8);
         $lvalues = array($lm1,$lm2,$lm3,$lm4,$lm5,$lm6,$lm7,$lm8);

         $x=1;
         while($x<=8)
         {  $col1 = 'UM'.$x;
            $col2 = 'LM'.$x;
             $val1 = $uvalues[$x-1];
            $val2 = $lvalues[$x-1];
            $res = "UPDATE  `graderange` SET  ".$col1." = '".$val1."' WHERE subcode = '$subcode'";
            $result = mysqli_query($con,$res);
            $res = "UPDATE  `graderange` SET  ".$col2." = '".$val2."' WHERE subcode = '$subcode'";
            $result = mysqli_query($con,$res);

         	$x++;
         }

         $codeuse = 20; 
       while($codeuse <= 33){
       				$mysql_tb_use = $codeuse.'_'.$sem.$year;
       				$query = "SELECT * FROM `".$mysql_tb_use."` WHERE 1 "; //serialno = '1'
	                $result = mysqli_query($con,$query);
	                $i = 2;
	                $flag=0;
	                 while( $obj1 = mysqli_fetch_row($result))
                 {  $fieldcount = mysqli_num_fields($result);

                        while($i<$fieldcount - 4)
                          { if($obj1[$i] == $subcode)
                              { $flag=1;
                                break;
                              }
                              $i+=11;
                            }
                            if($flag==1)
                              break;

                            $i=2;
                  }

	                if($flag == 1)
	                {
	                	      $q = "SELECT * FROM `graderange` WHERE subcode = '$subcode' ";
							   $r = mysqli_query($con,$q);
							   $row = mysqli_fetch_assoc($r);
							   $u1 = $row['UM1'];  $l1 = $row['LM1'];
							   $u2 = $row['UM2'];  $l2 = $row['LM2'];
							   $u3 = $row['UM3'];  $l3 = $row['LM3'];
							   $u4 = $row['UM4'];  $l4 = $row['LM4'];
							   $u5 = $row['UM5'];  $l5 = $row['LM5'];
							   $u6 = $row['UM6'];  $l6 = $row['LM6'];
							   $u7 = $row['UM7'];  $l7 = $row['LM7'];
							   $u8 = $row['UM8'];  $l8 = $row['LM8'];

							   $index = (int)($i/11) + 1;
						       $colname = "total" . "$index";
						       $colname2 = "gradeM"."$index";
                               $subcheck = 'CC'.$index;

						       $query = "SELECT * FROM `".$mysql_tb_use."` WHERE   `".$subcheck."` = '$subcode' ";
						       $result = mysqli_query($con,$query);
						       $totalstudents = mysqli_num_rows($result); 
						       $j=0;

						       while($j < $totalstudents && $row = mysqli_fetch_assoc($result))
      			 {    $score = $row[$colname];
           
               		  $grade;
                    if($score<=$u1 && $score>=$l1)
                        $grade = "A+";

                    else if($score<=$u2 && $score >=$l2 )
                        $grade ="A";

                    else if($score<=$u3 && $score >=$l3 )
                         $grade ="B+";

                    else if($score<=$u4 && $score >=$l4 )
                        $grade= "B";

                    else if($score<=$u5 && $score >=$l5)
                        $grade="C+";

                    else if($score<=$u6 && $score >=$l6 )
                        $grade="C";

                    else if($score<=$u7 && $score >=$l7)
                           $grade = "D";
                         
                    else if($score<45 )
                         $grade = "F";


			         $rollno = $row['rollno'];
			         $query1 = "UPDATE `".$mysql_tb_use."` SET  ".$colname2." = '".$grade."' WHERE rollno = '$rollno'";
			        $result1 = mysqli_query($con,$query1);
        
       
	                }

       	      
       }
       $codeuse++;
   }

   echo "<script> alert('Grades modearted  Successfully'); </script>";
     header( "refresh:1;url=hod_grades.php" );
?>