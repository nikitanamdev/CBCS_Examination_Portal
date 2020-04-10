 <?php include ('config.php') ;

  session_start();  ?>
<!DOCTYPE html>
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
<br>
<br>

    <!-- enter moderation value -->


    
    <!--end-->
    
<?php
         $con = $db;// mysqli_connect('localhost','root','root','student');
         $year = $_SESSION['year'];
         $subcode = $_SESSION['sub'];
         $sem = $_SESSION['sem'] ;


        /* $subcode = 'BAS-101';        //session variablrs
         $sem = '1'.'_';              //session variablrs
         $year = '2019';              //session variablrs
         $subname = 'Applied Mathematics'; */

         $c1=0; $c2=0;$c3=0; $c4=0; $c5=0; $c6=0; $c7=0; $c8=0;
         $grades = array("A+", "A", "B+", "B", "C+", "C", "D", "F");
         $codeuse = 20; 
          while($codeuse <= 33)
          {  $mysql_tb_use = $codeuse.'_'.$sem.$year;
             //echo $mysql_tb_use;
              $query = "SELECT * FROM `".$mysql_tb_use."` WHERE 1 "; //serialno = '1'
                $result = mysqli_query($con,$query);
                $i = 2;
                $flag=0;
                $obj1 = mysqli_fetch_row($result);
                   $fieldcount = mysqli_num_fields($result);

                        while($i<$fieldcount - 4)
                          { if($obj1[$i] == $subcode)
                              { $flag=1;
                                break;
                              }

                              $i+=11;
                            }


                if($flag == 1)
                {   $index = (int)($i/11) + 1;
                    $colname = "grade" . "$index";

                    $query = "SELECT * FROM `".$mysql_tb_use."` WHERE 1 "; //serialno = '1'
                    $result = mysqli_query($con,$query);
                    while($row = mysqli_fetch_assoc($result))
                    { 
                      $value =  $row[$colname];

                      if($value == 'A+')
                        $c1+=1;
                      else if($value == 'A')
                        $c2+=1;
                      else if($value == 'B+')
                        $c3+=1;
                      else if($value == 'B')
                        $c4+=1;
                      else if($value == 'C+')
                        $c5+=1;
                      else if($value == 'C')
                        $c6+=1;
                      else if($value == 'D')
                        $c7+=1;
                      else if($value == 'F')
                        $c8+=1;
                      

                    }

                }
                $codeuse++;

          }
          $count=array($c1, $c2, $c3, $c4, $c5, $c6, $c7, $c8);
        
          $q = "SELECT * FROM `graderange` WHERE subcode = '$subcode' ";
          $r = mysqli_query($con,$q);
          $row = mysqli_fetch_assoc($r);

?>

    
    <!-- tables -->
    <h3><b><?php echo $subcode; ?></b></h3>
    
    
<div class="container">
<div class="floatLeft">
    <table align="center" >
<caption>
    <h3>Actual Data</h3>
</caption>
    <tr align="center" bgcolor="green" height="40px" >
		<th style="color:white;width:60px;text-align:center;">Grade</th>
		<th style="color:white;width:100px;text-align:center;" >Upper Limit</th>
		<th style="color:white;width:100px;text-align:center;">Lower Limit</th>
		<th style="color:white;width:100px;text-align:center;">Count</th>
     </tr>
     <?php
      
      $x=0;
      $y = $x+1;

      while($x<8)
      {
         ?> 
          <tr>
              <td><?php echo $grades[$x];   ?></td>
              <td><?php  $col1='U'.$y; echo $row[$col1]; ?></td>
              <td><?php  $col2='L'.$y; echo $row[$col2]; ?></td>
              <td><?php echo $count[$x]; ?></td>
         </tr>
         <?php
         $x++;
         $y++;
      }

      ?>
   
</table>
    </div>
    

    <?php  
         

         
 
         $c1=0; $c2=0;$c3=0; $c4=0; $c5=0; $c6=0; $c7=0; $c8=0;
        // $grades = array("A+", "A", "B+", "B", "C+", "C", "D", "F");
         $codeuse = 20; 
          while($codeuse <= 33)
          {  $mysql_tb_use = $codeuse.'_'.$sem.$year;
             //echo $mysql_tb_use;
              $query = "SELECT * FROM `".$mysql_tb_use."` WHERE 1 "; //serialno = '1'
                $result = mysqli_query($con,$query);
                $i = 2;
                $flag=0;
                $obj1 = mysqli_fetch_row($result);
                   $fieldcount = mysqli_num_fields($result);

                        while($i<$fieldcount - 4)
                          { if($obj1[$i] == $subcode)
                              { $flag=1;
                                break;
                              }
                              $i+=11;
                            }

                
                if($flag == 1)
                {   $index = (int)($i/11) + 1;
                    $colname = "gradeM" . "$index";

                    $query = "SELECT * FROM `".$mysql_tb_use."` WHERE 1 "; //serialno = '1'
                    $result = mysqli_query($con,$query);
                    while($row = mysqli_fetch_assoc($result))
                    { 
                      $value =  $row[$colname];
                      
                      if($value == 'A+')
                        $c1+=1;
                      else if($value == 'A')
                        $c2+=1;
                      else if($value == 'B+')
                        $c3+=1;
                      else if($value == 'B')
                        $c4+=1;
                      else if($value == 'C+')
                        $c5+=1;
                      else if($value == 'C')
                        $c6+=1;
                      else if($value == 'D')
                        $c7+=1;
                      else if($value == 'F')
                        $c8+=1;
                      

                    }

                }
                $codeuse++;

          }
          $count1=array($c1, $c2, $c3, $c4, $c5, $c6, $c7, $c8);
          
          $q = "SELECT * FROM `graderange` WHERE subcode = '$subcode' ";
          $r = mysqli_query($con,$q);
          $row = mysqli_fetch_assoc($r);

?>
    
<div class="floatRight">
    <table align="center">
        <caption>
    <h3>Moderated Data</h3>
</caption>
    <tr align="center" bgcolor="green" height="40px" >
		<th style="color:white;width:60px;text-align:center;">Grade</th>
		<th style="color:white;width:100px;text-align:center;" >Upper Limit</th>
		<th style="color:white;width:100px;text-align:center;">Lower Limit</th>
		<th style="color:white;width:100px;text-align:center;">Count</th>
     </tr>
     <?php
      
      $x=0;
      $y = $x+1;

      while($x<8)
      {
         ?> 
          <tr>
              <td><?php echo $grades[$x];   ?></td>
              <td><?php  $col1='UM'.$y; echo $row[$col1]; ?></td>
              <td><?php  $col2='LM'.$y; echo $row[$col2]; ?></td>
              <td><?php echo $count1[$x]; ?></td>
         </tr>
         <?php
         $x++;
         $y++;
      }

      ?>
    
</table>


    </div>
    </div>

<!-- table ends -->



<br><br><br>
    <div >
	<center>
      <form action="hod_edit.php">
    <input type="submit" value="Modearte range" />
      </form>
    </center>
	</div>
<br><br><br>
    <div class="container"  style="position: relative; height:50vh; width:50vw">
    <canvas id="myChart2" ></canvas> </div>
    <br><br><br>
    <div class="container"  style="position: relative; height:50vh; width:50vw">
    <canvas id="myChart3" ></canvas>
  </div>
<br><br><br>
  
<script>
var colors = [<?php echo '"'.implode('","', $count).'"' ?>];
 var ctx = document.getElementById('myChart2').getContext('2d');

        Chart.defaults.global.defaultFontColor = 'black';
         Chart.defaults.global.defaultFontFamily = 'sans-serif';

        var myChart = new Chart(ctx,{
                      type: 'bar',
                      
                      data: {
                           labels: ['A+','A','B+','B','C+','C','D','F'],
                           datasets: [{
                                   label: 'Number of Students',
                                   data: [colors[0], colors[1], colors[2], colors[3], colors[4], colors[5],
                                           colors[6],colors[7]],
                                   backgroundColor: [
                              'rgba(255, 99, 132, 0.2)',
                              'rgba(54, 162, 235, 0.2)',
                              'rgba(255, 206, 86, 0.2)',
                              'rgba(75, 192, 192, 0.2)',
                              'rgba(153, 102, 255, 0.2)',
                              'rgba(255, 159, 64, 0.2)'
                          ],
                          borderColor: [
                              'rgba(255, 99, 132, 1)',
                              'rgba(54, 162, 235, 1)',
                              'rgba(255, 206, 86, 1)',
                              'rgba(75, 192, 192, 1)',
                              'rgba(153, 102, 255, 1)',
                              'rgba(255, 159, 64, 1)'
                          ],
                          borderWidth: 1
                           }]
                      },
                      options:{title:{
                                   display:true,
                                   text:"Actual Data",
                                   fontSize:25
                                },
                                legend:{
                                  display:false,
                                 //  position:'right'
                                },scales: {
                                  yAxes: [{
                                      ticks: {
                                          beginAtZero: true
                                      }
                                  }]
                              }, layout: {
                                  padding: {
                                      left: 50,
                                      
                                  }
                              }
                            }

                 });



var colors = [<?php echo '"'.implode('","', $count1).'"' ?>];

// 1st chart
        //var colors = ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'];
        var ctx = document.getElementById('myChart3').getContext('2d');

        Chart.defaults.global.defaultFontColor = 'black';
         Chart.defaults.global.defaultFontFamily = 'sans-serif';

        var myChart = new Chart(ctx,{
                      type: 'bar',
                      data: {
                           labels: ['A+','A','B+','B','C+','C','D','F'],
                           datasets: [{
                                   label: 'Number of Students',
                                   data: [colors[0], colors[1], colors[2], colors[3], colors[4], colors[5],
                                           colors[6],colors[7]],
                                   backgroundColor: [
                              'rgba(255, 99, 132, 0.2)',
                              'rgba(54, 162, 235, 0.2)',
                              'rgba(255, 206, 86, 0.2)',
                              'rgba(75, 192, 192, 0.2)',
                              'rgba(153, 102, 255, 0.2)',
                              'rgba(255, 159, 64, 0.2)'
                          ],
                          borderColor: [
                              'rgba(255, 99, 132, 1)',
                              'rgba(54, 162, 235, 1)',
                              'rgba(255, 206, 86, 1)',
                              'rgba(75, 192, 192, 1)',
                              'rgba(153, 102, 255, 1)',
                              'rgba(255, 159, 64, 1)'
                          ],
                          borderWidth: 1
                           }]
                      },
                      options:{ title:{
                                   display:true,
                                   text:"Moderated Data",
                                   fontSize:25
                                },
                                legend:{
                                  display:false,
                                 //  position:'right'
                                },
                               scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }]
                                },
                             layout: {
                                    padding: {
                                        left: 50,
                                        
                                    }
                                }
                            }

                 });

   </script>


</body>
</html>
