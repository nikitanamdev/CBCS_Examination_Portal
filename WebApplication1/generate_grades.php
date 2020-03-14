<?php include('config.php');
         session_start();
         $con = $db;//mysqli_connect('localhost','root','','student');
        //mysqli_select_db($con,'assessmentportal');
        if($con === false) 
        {
        die("ERROR:Could not connect.".mysqli_connect_error());
        }
        //getting the value for index
       $subid = $_GET['id'];
       //echo $subid;

        if(isset($subid))
        {   //$name = $_SESSION['Name']; 
            //getting code n sem from faculty db to access a particular db
            //$sql =  "SELECT * FROM `Faculty` WHERE Name= '$name' ";  //getting all the data for the faculty registered
         //getting the databse name
         //$code = $obj[$subid+2].'_';
        //$sem = $obj[$subid+3].'_';
        //$year = $obj[$subid+4];
             $sql =  "SELECT * FROM `faculty1` WHERE  serialno = '$subid' ";
            $result = mysqli_query($con,$sql);
            $obj = mysqli_fetch_row($result);
            
          if($obj[4] == 'B.Tech')
            {      
                    if($obj[5] == 'CSE')
                    { if( $obj[9] <= '08201012019'){
                             $code = '20'.'_';
                            }else{
                                $code = '21'.'_';}
                    }
                    else if($obj[5] == 'IT')
                                { if( $obj[9] <= '07301032019'){
                             $code = '22'.'_';
                            }else{
                                $code = '23'.'_';}
                    }
                    else if($obj[5] == 'ECE')
                                 $code = '24'.'_';
                    else if($obj[5] == 'MAE')
                                 $code = '25'.'_';
            }else if($obj[4] == 'B.Arch'){
                                    $code = '26'.'_';}
            else if($obj[4] == 'BBA'){
                                    $code = '27'.'_';
            }else if($obj[4] == 'MCA'){
                                    $code = '28'.'_';
            }else if($obj[4] == 'M.Tech'){
                                    if($obj[5] == 'CSE'){
                                        $code = '29'.'_';
                                    }else if($obj[5] == 'IT'){
                                        $code = '30'.'_';
                                    }else if($obj[5] == 'ECE'){
                                         $code = '31'.'_';
                                    }else{
                                         $code = '32'.'_';
                                    }
            }else if($obj[4] == 'M.Plan'){
                                    $code = '33'.'_';
            }
        }

            $sem = $obj[6].'_';
            $year = $obj[10];
        $subcode = $obj[2];

         $_SESSION['SubCode'] =$subcode;         //to be used to update in faculty colmn midterm 0/1
         $_SESSION['Branch'] =$obj[5];
         $_SESSION['Sem'] =$obj[6];
         $_SESSION['Course'] = $obj[4];
         $_SESSION['s'] = $obj[8];
         $_SESSION['e'] = $obj[9];
        $mysql_tb = $code.$sem.$year;

        //getting the subject column                 //getting the total students having the common subject
        $totalstudents = 0;
        $codeuse = 20; 
          while($codeuse <= 33)
          {  $mysql_tb_use = $codeuse.'_'.$sem.$year;
             //echo $mysql_tb_use;
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
               
              if($flag == 1){
                //echo $i; 
                //echo "<br>";
                //echo $mysql_tb_use;
               //echo "<br>";
               $index = (int)($i/11) + 1;
               $colname = "total" . "$index";
               $subcheck = 'CC'.$index;
             
               $query = "SELECT * FROM `".$mysql_tb_use."` WHERE  ".$colname." != -1 and `".$subcheck."` = '$subcode' ";
               $result = mysqli_query($con,$query);
               $totalstudents = $totalstudents + mysqli_num_rows($result);   //number of students who gave the exmas
                
               
             }
            $codeuse++;
          }


          //echo $totalstudents; 
          //echo "<br>";

if($totalstudents > 30)                                //for checking condition changed
{
       /* Calculating average that is T' */
       $totsum=0;
       $codeuse = 20; 
       while($codeuse <= 33)
      {  $mysql_tb_use = $codeuse.'_'.$sem.$year;
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
                $index = (int)($i/11) + 1;
               $colname = "total" . "$index";
               $subcheck = 'CC'.$index;
              $query = "SELECT * FROM `".$mysql_tb_use."` WHERE `".$subcheck."` = '$subcode' and ".$colname." != -1 ";
              $result = mysqli_query($con,$query);
              $totalstudents1 = mysqli_num_rows($result);   //number of students who gave the exmas

              $j=0;                                    //calculating avg
              $sumofmarks = 0; 
              while($j < $totalstudents1 && $row = mysqli_fetch_assoc($result))
             {
                $sumofmarks += $row[$colname];
                $j++;
            }
            
            $totsum+= $sumofmarks;
           //echo $totsum;
           //echo "<br>";
          }
         $codeuse++;
        
     }
       //echo $totsum;
       //echo "<br>";
       //echo $totalstudents;
       $avg = $totsum / $totalstudents;   //T'
       //echo $avg;

/******************************************************************************/

/*********  Calculating standard deviation      *********/

       $totsum=0;
       $codeuse = 20; 
       while($codeuse <= 33)
      {  $mysql_tb_use = $codeuse.'_'.$sem.$year;
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
                $index = (int)($i/11) + 1;
               $colname = "total" . "$index";
               $subcheck = 'CC'.$index;

              $query = "SELECT * FROM `".$mysql_tb_use."` WHERE `".$subcheck."` = '$subcode' and ".$colname." != -1 ";
                $result = mysqli_query($con,$query);
                $totalstudents1 = mysqli_num_rows($result); 
                $j=0;
              $sumofmarks = 0;
                 while($j < $totalstudents1 && $row = mysqli_fetch_assoc($result))
                 {    
                      $sum = $row[$colname] - $avg;
                      $sum = ($sum*$sum);
                      //echo "<br>";
                      //echo $sum;
                      $sumofmarks += $sum;
                      $j++;
                 }

                 $totsum += $sumofmarks;
                 //echo "<br>";
                 //echo $totsum;
           }
           $codeuse++;
          }
        //echo "<br>";
       $totsum = $totsum / $totalstudents;
       //echo $totsum;
       //echo "<br>";
       $totsum = sqrt($totsum);
       $sd = $totsum;                                //standard deviation
      //echo "<br>";
	  //echo $sd;

       /******************************************************************************/


/*********  Calculating z value and garde     *********/
                                                          //calculate z(grade)

$x=1;
$upper = 100;
$y=1.5;
 $sub = $_SESSION['SubCode'];
while($x <= 7){
  
  $lower = $avg + ($y*$sd) + 1;
      
//echo "<br>";
   $col1 = 'U'.$x;
   $col2 = 'L'.$x;
   $col3 = 'UM'.$x;
   $col4 = 'LM'.$x;
   $res = "UPDATE  `graderange` SET  ".$col1." = '".$upper."' WHERE subcode = '$sub'";
   $result = mysqli_query($con,$res);
   $res = "UPDATE  `graderange` SET  ".$col3." = '".$upper."' WHERE subcode = '$sub'";
   $result = mysqli_query($con,$res);
   if($x != 7)
   {$res = "UPDATE  `graderange` SET  ".$col2." = '".$lower."' WHERE subcode = '$sub'";
   $result = mysqli_query($con,$res);
   $res = "UPDATE  `graderange` SET  ".$col4." = '".$lower."' WHERE subcode = '$sub'";
   $result = mysqli_query($con,$res);
 }

  $upper = $lower -1;
//echo "<br>";
  $y = $y-0.5;
 //echo "<br>";
$x++;
}

   $res = "UPDATE  `graderange` SET  L7 = '45' WHERE subcode = '$sub'";
   $result = mysqli_query($con,$res);
   $res = "UPDATE  `graderange` SET  LM7 = '45' WHERE subcode = '$sub'";
   $result = mysqli_query($con,$res);
   $res = "UPDATE  `graderange` SET  U8 = '44' WHERE subcode = '$sub'";
   $result = mysqli_query($con,$res);
   $res = "UPDATE  `graderange` SET  UM8 = '44' WHERE subcode = '$sub'";
   $result = mysqli_query($con,$res);
   $res = "UPDATE  `graderange` SET  L8 = '0' WHERE subcode = '$sub'";
   $result = mysqli_query($con,$res);
   $res = "UPDATE  `graderange` SET  LM8 = '0' WHERE subcode = '$sub'";
   $result = mysqli_query($con,$res);

   $q = "SELECT * FROM `graderange` WHERE subcode = '$sub' ";
   $r = mysqli_query($con,$q);
   $row = mysqli_fetch_assoc($r);
   $u1 = $row['U1'];  $l1 = $row['L1'];
   $u2 = $row['U2'];  $l2 = $row['L2'];
   $u3 = $row['U3'];  $l3 = $row['L3'];
   $u4 = $row['U4'];  $l4 = $row['L4'];
   $u5 = $row['U5'];  $l5 = $row['L5'];
   $u6 = $row['U6'];  $l6 = $row['L6'];
   $u7 = $row['U7'];  $l7 = $row['L7'];
   $u8 = $row['U8'];  $l8 = $row['L8'];



 $query = "SELECT * FROM `".$mysql_tb."` WHERE 1 "; //serialno = '1'
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
      

 

       $index = (int)($i/11) + 1;
       $colname = "total" . "$index";
       $colname1 = "grade"."$index";
       $colname2 = "gradeM"."$index";
        $subcheck = 'CC'.$index;

       $query = "SELECT * FROM `".$mysql_tb."` WHERE  `".$subcheck."` = '$subcode'and  ".$colname." != -1 ";
       $result = mysqli_query($con,$query);
       $totalstudents = mysqli_num_rows($result); 
        $j=0;
        
       while($j < $totalstudents && $row = mysqli_fetch_assoc($result))
       {    $score = $row[$colname];
            //$diff = $row[$colname] - $avg;
            //$z =  ($diff / $sd);
            //echo "<br>";
            //echo $z;
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
         $query1 = "UPDATE `".$mysql_tb."` SET  ".$colname1." = '".$grade."' WHERE rollno = '$rollno'";
        $result1 = mysqli_query($con,$query1);
        $query1 = "UPDATE `".$mysql_tb."` SET  ".$colname2." = '".$grade."' WHERE rollno = '$rollno'";
        $result1 = mysqli_query($con,$query1);
                   
           //echo "<br>";
           //echo $grade;
            $j++;
       }

      // if(1.0 < 1.011312 &&  1.011312 <=1.5)

}
else
{     $sub = $_SESSION['SubCode']; 
      $x=1;
      $upper = 100;
      $lower = 93;
      while($x<=8)
      {  $col1 = 'U'.$x;
         $col2 = 'L'.$x;
         $col3 = 'UM'.$x;
         $col4 = 'LM'.$x;
         
         $res = "UPDATE  `graderange` SET  ".$col1." = '".$upper."' WHERE subcode = '$sub'";
         $result = mysqli_query($con,$res);
         $res = "UPDATE  `graderange` SET  ".$col3." = '".$upper."' WHERE subcode = '$sub'";
         $result = mysqli_query($con,$res);
         $res = "UPDATE  `graderange` SET  ".$col2." = '".$lower."' WHERE subcode = '$sub'";
         $result = mysqli_query($con,$res);
         $res = "UPDATE  `graderange` SET  ".$col4." = '".$lower."' WHERE subcode = '$sub'";
         $result = mysqli_query($con,$res);
         
         $upper = $lower-1;
         $lower = $upper - 7;

        $x++;
      }    

      $q = "SELECT * FROM `graderange` WHERE subcode = '$sub' ";
       $r = mysqli_query($con,$q);
       $row = mysqli_fetch_assoc($r);
       $u1 = $row['U1'];  $l1 = $row['L1'];
       $u2 = $row['U2'];  $l2 = $row['L2'];
       $u3 = $row['U3'];  $l3 = $row['L3'];
       $u4 = $row['U4'];  $l4 = $row['L4'];
       $u5 = $row['U5'];  $l5 = $row['L5'];
       $u6 = $row['U6'];  $l6 = $row['L6'];
       $u7 = $row['U7'];  $l7 = $row['L7'];
       $u8 = $row['U8'];  $l8 = $row['L8'];



      $query = "SELECT * FROM `".$mysql_tb."` WHERE 1 "; //serialno = '1'
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
       
       $index = (int)($i/11) + 1;
       $colname = "total" . "$index";
       $colname1 = "grade"."$index";
       $colname2 = "gradeM"."$index";
        $subcheck = 'CC'.$index;
       $query = "SELECT * FROM `".$mysql_tb."` WHERE `".$subcheck."` = '$subcode' and ".$colname." != -1 ";
       $result = mysqli_query($con,$query);
       $totalstudents = mysqli_num_rows($result); 
        $j=0;
        
       while($j < $totalstudents && $row = mysqli_fetch_assoc($result))
       {    
            $score = $row[$colname];
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
         $query1 = "UPDATE `".$mysql_tb."` SET  ".$colname1." = '".$grade."' WHERE rollno = '$rollno'";
        $result1 = mysqli_query($con,$query1);
        $query1 = "UPDATE `".$mysql_tb."` SET  ".$colname2." = '".$grade."' WHERE rollno = '$rollno'";
        $result1 = mysqli_query($con,$query1);
                   
           //echo "<br>";
           //echo $grade;
            $j++;
       }


}
        //for absentees
       $query = "SELECT * FROM `".$mysql_tb."` WHERE 1 "; //serialno = '1'
        $result = mysqli_query($con,$query);
        $i = 2;
       $flag=0;
       while( $obj1 = mysqli_fetch_row($result))
       {     $fieldcount = mysqli_num_fields($result);

                while($i<$fieldcount - 4)
                  { if($obj1[$i] == $subcode)
                      { $flag=1;
                        break;
                      }
                      $i+=11;
                    }

          if($flag == 1)
                      break;

                    $i=2;
       }
       
       $index = (int)($i/11) + 1;
       $colname = "total" . "$index";
       $colname1 = "grade"."$index";
       $colname2 = "gradeM"."$index";
       $subcheck = 'CC'.$index;
        $query = "SELECT * FROM `".$mysql_tb."` WHERE `".$subcheck."` = '$subcode' and ".$colname." = -1 ";
       $result = mysqli_query($con,$query);
       $totalstudents = mysqli_num_rows($result);
       $j=0;
       while($j < $totalstudents && $row = mysqli_fetch_assoc($result))
       {    $rollno = $row['rollno'];
            $query1 = "UPDATE `".$mysql_tb."` SET  ".$colname1." = 'F' WHERE rollno = '$rollno'";
            $result1 = mysqli_query($con,$query1);
            $query1 = "UPDATE `".$mysql_tb."` SET  ".$colname2." = 'F' WHERE rollno = '$rollno'";
            $result1 = mysqli_query($con,$query1);
       } 

     echo "<script> alert('Grades Generated  Successfully'); </script>";
     header( "refresh:1;url=papers.php" );

?>