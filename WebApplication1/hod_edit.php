 <?php include ('config.php') ;

  session_start();  ?>
<!DOCTYPE html>
<html lan="en">
<head>
    <title>exam portal</title>
    <meta charset="utf-8"><!DOCTYPE html>
<html lan="en">
<head>
    <title>exam portal</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width-device-width,initial-scale=1">
    
 
    <link rel="stylesheet" type="text/css" href="style5.css" />

    <style>     
      

input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}

label {
  padding: 12px 12px 12px 0;
  display: inline-block;
}

input[type=submit] {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

        
table, td, th {
  border: 1px solid black;
}

table {
  border-collapse: collapse;
  text-align: center;
   width: 75%;

}

th {
  height: 30px;
    color: white;
}
 tr:nth-child(even){background-color: #f2f2f2}  
        
tr
 {
height: 25px;
}
        
.floatLeft { width: 50%; float: left; }
.floatRight {width: 50%; float: right; }
.container { overflow: hidden; }
        
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
            <li><a href="hod.php">Moderate Grades</a></li>
        </ul>
    </div>
    <br>
    <div id="navbar1">
       <ul>
            <li><a href="#enrollno.">Welcome <?php echo $_SESSION['username']; ?></a></li>
            <li><a href="front.php?logout='1'">Log Out</a></li>

        </ul>
    </div>

    <?php
         $con = $db;// mysqli_connect('localhost','root','root','student');

        $year = $_SESSION['year'];
         $subcode = $_SESSION['sub'];
         $sem = $_SESSION['sem'] ;

        /* $subcode = 'BAS-101';        //session variablrs
         $sem = '1'.'_';              //session variablrs
         $year = '2019';              //session variablrs
         $subname = 'Applied Mathematics'; */
       $q = "SELECT * FROM `graderange` WHERE subcode = '$subcode' ";
          $r = mysqli_query($con,$q);
          $row = mysqli_fetch_assoc($r);
    ?>

    
    <div class="floatLeft">
      <form action="hod_edit_input.php" method="post">
    <table align="center" >
      <tr align="center" bgcolor="green" height="40px" >
    <th style="color:white;width:60px;text-align:center;">Grade</th>
    <th style="color:white;width:100px;text-align:center;" >Upper Limit</th>
    <th style="color:white;width:100px;text-align:center;">Lower Limit</th>
    </tr>
          <!--<form action="" method="post"> -->
                <tr>
                  <td>A+</td>
                 <td><input type="number" min="0" max="100" style=" width:120px; height:20px;" name="um1" value="<?php echo $row['UM1']; ?>"></td>
                 <td><input type="number" min="0" max="100" style=" width:120px; height:20px;" name="lm1" value="<?php echo $row['LM1']; ?>"></td>
                </tr>
                <tr>
                  <td>A</td>
                 <td><input type="number" min="0" max="100" style=" width:120px; height:20px;" name="um2" value="<?php echo $row['UM2']; ?>"></td>
                 <td><input type="number" min="0" max="100" style=" width:120px; height:20px;" name="lm2" value="<?php echo $row['LM2']; ?>"></td>
                </tr>
                <tr>
                  <td>B+</td>
                 <td><input type="number" min="0" max="100" style=" width:120px; height:20px;" name="um3" value="<?php echo $row['UM3']; ?>"></td>
                 <td><input type="number" min="0" max="100" style=" width:120px; height:20px;" name="lm3" value="<?php echo $row['LM3']; ?>"></td>
                </tr>
                <tr>
                  <td>B</td>
                 <td><input type="number" min="0" max="100" style=" width:120px; height:20px;"  name="um4" value="<?php echo $row['UM4']; ?>"></td>
                 <td><input type="number" min="0" max="100" style=" width:120px; height:20px;"  name="lm4" value="<?php echo $row['LM4']; ?>"></td>
                </tr>
                <tr>
                  <td>C+</td>
                 <td><input type="number" min="0" max="100" style=" width:120px; height:20px;" name="um5" value="<?php echo $row['UM5']; ?>"></td>
                 <td><input type="number" min="0" max="100" style=" width:120px; height:20px;" name="lm5" value="<?php echo $row['LM5']; ?>"></td>
                </tr><tr>
                  <td>C</td>
                 <td><input type="number" min="0" max="100" style=" width:120px; height:20px;" name="um6" value="<?php echo $row['UM6']; ?>"></td>
                 <td><input type="number" min="0" max="100" style=" width:120px; height:20px;" name="lm6" value="<?php echo $row['LM6']; ?>"></td>
                </tr><tr>
                  <td>D</td>
                 <td><input type="number" min="0" max="100" style=" width:120px; height:20px;" name="um7" value="<?php echo $row['UM7']; ?>"></td>
                 <td><input type="number" min="0" max="100" style=" width:120px; height:20px;" name="lm7" value="<?php echo $row['LM7']; ?>"></td>
                </tr><tr>
                  <td>F</td>
                 <td><input type="number" min="0" max="100" style=" width:120px; height:20px;" name="um8" value="<?php echo $row['UM8']; ?>"></td>
                 <td><input type="number" min="0" max="100" style=" width:120px; height:20px;" name="lm8" value="<?php echo $row['LM8']; ?>"></td>
                </tr>
          


     </table>

     <button type="submit" style="width:30%; border-radius: 20px; position:realtive; left:50px;  ">Submit</button>
    </form>
    </div>
 
<br>
<br>
</body>
</html>
