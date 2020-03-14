<?php include ('config.php') ?>
<?php 
  session_start();
         $con = $db;//mysqli_connect('localhost','root','','student');
        //mysqli_select_db($con,'assessmentportal');
        if($con === false) 
        {
        die("ERROR:Could not connect.".mysqli_connect_error());
        }

         $subid = $_GET['id'];
       //echo $subid;
       $name = $_SESSION['username']; 
       $query = "SELECT * FROM `faculty1` WHERE  User = '$name' && serialno = '$subid'";
        $result = mysqli_query($con,$query);
         $row = mysqli_fetch_assoc($result);
         if($row['Freeze'] == 1)
         {
            echo "<script> alert('Marks have been Submitted '); </script>";
         header("refresh:1;url=papers.php");

         }else
         {
?>

<!DOCTYPE html>
<html lan="en">
<head>
    <title>exam portal</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width-device-width,initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style5.css" />

</head>
<body>

   <div id="image">
        <img src="https://img.collegepravesh.com/2015/12/IGDTUW-Logo.png" alt="IGDTUW" width="150" height="150"  style="margin-left:8%">
    </div>
  <div class="top" style=" margin-top:-10%;margin-left:23%; align:center">
  <p style="font-size:30px; color:green"><b>INDIRA GANDHI DELHI TECHNICAL UNIVERSITY FOR WOMEN</b></p>
  <p style="margin-left:33%; margin-top:-2%; font-size:20px"><b>Kashmere Gate, Delhi-110006<b></p>
  </div>
  <br>
  <hr size='10'; color='green'></hr>
    <div id="navbar">
        <ul>
            <li><a href="homeF.php">Home</a></li>
            <li><a href="selectPapers.php">Display Papers</a></li>
            <li><a href="papers.php">Upload Marks</a></li>
            <li><a href="#about">Results</a></li>
            <li><a href="#about">Notifications</a></li>
        </ul>
    </div>
    <br>
    <div id="navbar1">
        <ul>
            
            <li><a href="changePassword.php">Change password</a></li>
            <li><a href="front.php?logout='1'">Log Out</a></li>

        </ul>
    </div>
<br>
<br>
<br>

<table style=" position:relative; left:50px; width:90%; height:50px;font-size: 20px; margin-top:50px;">
  <tr style="background-color:green;">
    <th style="width=40px; height:40px;">S.No.</th>
    <th>RollNo. </th>
    <th>Maximum Marks</th>
    <th>Marks Obtained</th>
   </tr>
   
    <?php  
         //session_start();
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
        {   $name = $_SESSION['username']; 
            //getting code n sem from faculty db to access a particular db
           /* $sql =  "SELECT * FROM `Faculty` WHERE Name= '$name' ";  //getting all the data for the faculty registered
            $result = mysqli_query($con,$sql);
            $obj = mysqli_fetch_row($result);*/
          //getting the databse name
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
        $index = 1;  //for S.No.
      
      //getting the subject column
      $query = "SELECT * FROM `".$mysql_tb."` WHERE serialno = '1'";
        $result = mysqli_query($con,$query);
        $i = 2;
        $flag = 0;
       while( $obj1 = mysqli_fetch_row($result))
       {     $fieldcount = mysqli_num_fields($result);

                while($i<$fieldcount - 4)
                  { if($obj1[$i] == $subcode)
                       { $flag =1;
                        break;}
                      $i+=11;
                    }
                    if($flag == 1)
                      break;

                    $i=2;
       }
       //$i now stores the index number of the subject whose marks are to be entered
       $_SESSION['tablename'] = $mysql_tb;
       $_SESSION['callindex'] = $i;
       $start = $_SESSION['s'];
       $end = $_SESSION['e'];
       $in = (int)($i/11) + 1;
      $subcheck = 'CC'.$in;
     
      //printing rollno.s
        //$query = "SELECT rollno FROM `".$mysql_tb."` WHERE 1";
        $query;
        if($start != 'NULL' && $end != 'NULL')
         {  //echo "hello";
            //echo $start;
            //echo $end;
          $query = "SELECT rollno FROM `".$mysql_tb."` WHERE  rollno  BETWEEN '$start' and '$end' 
                  and `".$subcheck."` = '$subcode' order by rollno ";
         }
         else
         { //echo "hi";
          $query = "SELECT rollno FROM `".$mysql_tb."` WHERE `".$subcheck."` = '$subcode' order by rollno";
         } 

      
        $result = mysqli_query($con,$query);
        $totalstudents = mysqli_num_rows($result);
        $_SESSION['totalstudents'] = $totalstudents;
        ?> 
        <form action="input_fa.php" method="post">
          <?php
           while($row = mysqli_fetch_assoc($result))
                { ?>
                     <tr  style="background-color:grey; text-align:center;" >
                       <td><?php printf("%d",$index++) ?></td>
                       <td><?php printf("%s ", $row['rollno']); ?> </td> 
                       
                      <?php  $query1 = "SELECT * FROM `papers` WHERE Code = '$subcode' ";
                               $result1 = mysqli_query($con,$query1);
                              $row1 = mysqli_fetch_assoc($result1); 
                       if($_SESSION['Course'] == 'B.Arch' || $_SESSION['Course'] == 'M.Plan')
                       { if($row1['L']!=0){
                        ?> <td>10</td>
                       <td><input type="number" min="1" max="10" name="marks[]"></td> 
                          <?php }
                          else if($row1['P']!=0){
                            ?>
                          <td>15</td>
                            <td><input type="number" min="1" max="15" name="marks[]"></td>
                            <?php }
                       }
                       else {   if($row1['L'] == 0 && $row1['P'] !=0){ 
                        ?> <td>20</td>
                       <td><input type="number" min="1" max="20" name="marks[]"></td> 
                        <?php }
                        else { ?>
                       <td>10</td>
                       <td><input type="number" min="1" max="10" name="marks[]"></td> 
                     <?php } 
                   } ?>
                      
                     </tr>
                    <?php
                }
           }
    ?> 
 </table>

<button type="submit" style="width:10%; border-radius: 20px; position:realtive; left:50px;  ">Submit</button>
<!-- <footer>
<div id="last" >
  <h2 style="color: white">Copyright of IGDTUW</h2>
</div>
<div id ="blc">
  <h2>IGDTUW-EXAMINATION DIVISION</h2>
</div>
</footer> -->
</body>
</html>
<?php  }
?>