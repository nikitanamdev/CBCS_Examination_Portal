<?php include ('config.php') ;
 $con = $db;// mysqli_connect('localhost','root','root','student');
  session_start();  ?> 
    <!DOCTYPE html>
<html lan="en">
<head>
    <title>exam portal</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width-device-width,initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style5.css" />
    <style>
       table{
       	border-collapse: collapse;
       }
       th{
       	border: 1px solid black;
        background-color: grey;
       }
       td{
       	border: 1px solid black;
        
       }
       
    </style>
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
            <li><a href="homeH.php">Home</a></li>
            <li><a href="dean_ms1.php">Marksheet</a></li>
        </ul>
    </div>
    <br>
    <div id="navbar1">
       <ul>
           
            <li><a href="front.php?logout='1'">Log Out</a></li>

        </ul>
    </div>
<br>
<br>
<br>



<?php

         $_SESSION['course'] = $_POST['course'];
         $_SESSION['sem']  = $_POST['sem'];

         $sem = $_SESSION['sem'];
         $course = $_SESSION['course'];

         $mysql_tb = $course.'_'.$sem.'_'.'2019';
        
?>

<a href="dean_ms4.php?id=<?=$course?>" target="_blank"><button type="button" style="width:150px;" >Print All Marksheet </button></a>
       
        <table  style=" position:relative; left:50px; width:80%; height:10px; font-size: 20px; margin-top:50px; text-align:center;">
           <tr >
                 
                  <th style="width=50px; height:30px">Enrollment Number </th>
                  <th> Marksheet</th>
            </tr>
            <?php
                $query ="SELECT rollno FROM `".$mysql_tb."` order by rollno ";
                $result = mysqli_query($con,$query);
                while($row = mysqli_fetch_assoc($result)){
                	$rollno = $row['rollno'];
              ?>
                 <tr>
                 
                  <td style="font-size:18px;"><?php echo $rollno; ?></td>
                  <td><a href='dean_ms3.php?id=<?=$rollno?>' target="_blank"><button type="button" style="width:150px; 
                  	height: 20px; border-radius:4px;" >
                  	Get Marksheet</button></a></td>
            </tr>
               <?php 
                  }  
                ?>
          </table>
       

</body>
</html>