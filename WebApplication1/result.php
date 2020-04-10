<?php include ('config.php') ?>
<?php 
  //header( "refresh:0");
 session_start();
$con = $db;// mysqli_connect('localhost','root','','student');
//mysqli_select_db($con,'assessmentportal');
if($con === false) 
{
	die("ERROR:Could not connect.".mysqli_connect_error());
}
//$subid = $_GET['id'];
       //echo $subid;

       
          //$name = $_SESSION['Name']; 
            //getting code n sem from faculty db to access a particular db
            //$sql =  "SELECT * FROM `Faculty` WHERE Name= '$name' ";  //getting all the data for the faculty registered
           //getting the databse name
           //$code = $obj[$subid+2].'_';
          //$sem = $obj[$subid+3].'_';
          //$year = $obj[$subid+4];

            
		  $rollno = $_SESSION['username'];?>
<!DOCTYPE html>
<html lan="en">
<head>
	<title>exam portal</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width-device-width,initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style5.css" />
	<style>

        
table, td, th {  
  border: 1px solid black;
  text-align: left;
}
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
  background-color: #4CAF50;
  color: white;
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
            <li><a href="home.php">Home</a></li>
            <li><a href="paper.php">Display Papers</a></li>
            <li><a href="#">Results</a></li>
<li><a href="admitcard.php">Admit Card</a></li>
            <li><a href="#about">Notifications</a></li>
            
        </ul>
    </div>
    <br>
    <div id="navbar1">
        <ul>
            <li><a href="#enrollno.">Welcome <?php echo $rollno; ?></a></li>
            <li><a href="changePassword.php">Change password</a></li>
            <li><a href="front.php?logout='1'">Log Out</a></li>

        </ul>
    </div>
   
   <!-- <table width="1065" align="center">
     <tr align="center">
	</tr>
	<center>
	<tr align="center" bgcolor="green" height="30px" >
		<th style="color:white;width:60px;text-align:center;">S.No</th>
		<th style="color:white;width:100px;text-align:center;" >Paper Code</th>
		<th style="color:white;width:300px;text-align:center;">Subject</th>
		<th style="color:white;width:100px;text-align:center;">Mid Term</th>
		<th style="color:white;width:100px;text-align:center;">Practical</th>
		<th style="color:white;width:100px;text-align:center;">Faculty assessment</th>
        <th style="color:white;width:100px;text-align:center;">Internal marks</th>
	</tr>
	</tr>
    </center> -->
	<?php
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
             $branch  =  $obj[3];
           //$subcode = $obj[2];
        $mysql_tb = $code.$sem.$year;
		//$mysql_tb = $code.$sem.$year;

		//echo $mysql_tb;
         ?> 
         <div  style="margin-top:100px; height:200px; width:250px; float:left; ">
                  <table  align="center">
                  <tr align="center"  height="30px" width="50px" >
                  <th style="color:white; width:60px;text-align:center; background-color:green;">Semester Results</th>
                </tr>
               
               <?php  
               
                $query = "SELECT * FROM register WHERE Enrollment_No = '$rollno' ";
                $result = mysqli_query($con,$query);
                $row = mysqli_fetch_assoc($result);
                $num = $row['Semester'];
                $j = 1;        
                while($j < $num)          // make it <
                {
                   ?>
                  <tr>
                  <td align='center'><form action="final_result.php?id=<?=$j?>" method="post">
                    <input type=submit value="Semester <?php echo $j; ?>" style="width:100%"></form></td>
                </tr>
                <?php
                $j++;
                }

               ?>

                <!-- <tr>
                  <td align='center'><form><input type=submit value="Semester 1" style="width:100%"></form></td>
                </tr>
                <tr>
                  <td align='center'><form><input type=submit value="click me" style="width:100%"></form></td>
                </tr> -->
              </table>
         </div>
         <div style="float:right; margin-right:20px;">
        <?php 

if($branch == 'B.Arch' || $branch == 'M.Plan')
{       
         ?>     <!-- theory table -->
         <h3> Theory </h3>
        <table width="1065" align="center">
     <tr align="center">
  </tr>
  <center>
  <tr align="center" bgcolor="green" height="30px" >
    <th style="color:white;width:60px;text-align:center;background-color:green;">S.No</th>
    <th style="color:white;width:100px;text-align:center;background-color:green;" >Paper Code</th>
    <th style="color:white;width:300px;text-align:center;background-color:green;">Subject</th>
    <th style="color:white;width:100px;text-align:center;background-color:green;">MTET</th>
    <th style="color:white;width:100px;text-align:center;background-color:green;">CAT</th>
    <th style="color:white;width:100px;text-align:center;background-color:green;">Internal total</th>
  </tr>
  </tr>
    </center>
    <?php
        $query = "SELECT * FROM `".$mysql_tb."` WHERE rollno = '$rollno' ";
        $result = mysqli_query($con,$query);

    $index = 1;  //for S.No.
    $i = 2; 
    
    
while($obj = mysqli_fetch_row($result))
{  
    $fieldcount = mysqli_num_fields($result);

      while($i < $fieldcount - 4)
       {  //printf("%s \t %s \t %s ",$obj[$i],$obj[$i+1],$obj[$i+3]);   statemnt that prints the diif column values
      //echo '<br />';
          $subjectcode = $obj[$i];
          $query1 = "SELECT * FROM `papers` WHERE Code = '$subjectcode' ";
                       $result1 = mysqli_query($con,$query1);
                          $row1 = mysqli_fetch_assoc($result1);
           if($row1['L']!=0 && $row1['T']==0 && $row1['P']==0) {              
            ?>  
                 <br>
                     <tr>
                              <td><?php  printf("%d",$index++); ?></td>
                               <td><?php  printf("%s",$obj[$i]); ?></td>
                               <td><?php  printf("%s",$obj[$i+1]); ?></td>
                               <td><?php 
                                   if($obj[$i+4] == 0)
                                    printf("","");
                                  else
                                    printf("%d",$obj[$i+4]);
                                     ?></td>
               
                              <td><?php  if($obj[$i+3] == 0)
                                    printf("","");
                                  else
                                    printf("%d",$obj[$i+3]);?></td>
                              <td><?php  if($obj[$i+7] == 0)
                                printf("","");
                              else
                                printf("%d",$obj[$i+7]); ?></td>
                
                       </tr> 
                   
            <?php
          }
       $i+=11;
        }
}
?>    
</table>


 <!-- practical table -->
  <h3> Practical </h3>
        <table width="1065" align="center">
     <tr align="center">
  </tr>
  <center>
  <tr align="center" bgcolor="green" height="30px" >
    <th style="color:white;width:60px;text-align:center; background-color:green;">S.No</th>
    <th style="color:white;width:100px;text-align:center;background-color:green;" >Paper Code</th>
    <th style="color:white;width:300px;text-align:center;background-color:green;">Subject</th>
    <th style="color:white;width:100px;text-align:center;background-color:green;">CAP</th>
    <th style="color:white;width:100px;text-align:center;background-color:green;">MTEP</th>
    <th style="color:white;width:100px;text-align:center;background-color:green;">Internal Total</th>
  </tr>
  </tr>
    </center>
    <?php
        $query = "SELECT * FROM `".$mysql_tb."` WHERE rollno = '$rollno' ";
        $result = mysqli_query($con,$query);

    $index = 1;  //for S.No.
    $i = 2; 
    
    
while($obj = mysqli_fetch_row($result))
{  
    $fieldcount = mysqli_num_fields($result);

      while($i < $fieldcount - 4)
       {  //printf("%s \t %s \t %s ",$obj[$i],$obj[$i+1],$obj[$i+3]);   statemnt that prints the diif column values
      //echo '<br />';
          $subjectcode = $obj[$i];
          $query1 = "SELECT * FROM `papers` WHERE Code = '$subjectcode' ";
                       $result1 = mysqli_query($con,$query1);
                          $row1 = mysqli_fetch_assoc($result1);
           if($row1['L']==0 && $row1['T']==0 && $row1['P']!=0) {              
            ?>  
                 <br>
                     <tr>
                              <td><?php  printf("%d",$index++); ?></td>
                               <td><?php  printf("%s",$obj[$i]); ?></td>
                               <td><?php  printf("%s",$obj[$i+1]); ?></td>
                               <td><?php 
                                   if($obj[$i+4] == 0)
                                    printf("","");
                                  else
                                    printf("%d",$obj[$i+4]);
                                     ?></td>
               
                              <td><?php  if($obj[$i+3] == 0)
                                    printf("","");
                                  else
                                    printf("%d",$obj[$i+3]);?></td>
                              <td><?php  if($obj[$i+7] == 0)
                                printf("","");
                              else
                                printf("%d",$obj[$i+7]); ?></td>
                
                       </tr> 
                   
            <?php
          }
       $i+=11;
        }
}
?>
</table>
<!-- studio table -->
  <h3> Studio </h3>
        <table width="1065" align="center">
     <tr align="center">
  </tr>
  <center>
  <tr align="center" bgcolor="green" height="30px" >
    <th style="color:white;width:60px;text-align:center;background-color:green;">S.No</th>
    <th style="color:white;width:100px;text-align:center;background-color:green;" >Paper Code</th>
    <th style="color:white;width:300px;text-align:center;background-color:green;">Subject</th>
    <th style="color:white;width:100px;text-align:center;background-color:green;">CAS</th>
   
  </tr>
  </tr>
    </center>
    <?php
        $query = "SELECT * FROM `".$mysql_tb."` WHERE rollno = '$rollno' ";
        $result = mysqli_query($con,$query);

    $index = 1;  //for S.No.
    $i = 2; 
    
    
while($obj = mysqli_fetch_row($result))
{  
    $fieldcount = mysqli_num_fields($result);

      while($i < $fieldcount - 4)
       {  //printf("%s \t %s \t %s ",$obj[$i],$obj[$i+1],$obj[$i+3]);   statemnt that prints the diif column values
      //echo '<br />';
          $subjectcode = $obj[$i];
          $query1 = "SELECT * FROM `papers` WHERE Code = '$subjectcode' ";
                       $result1 = mysqli_query($con,$query1);
                          $row1 = mysqli_fetch_assoc($result1);
           if($row1['L']==0 && $row1['T']!=0 && $row1['P']==0) {              
            ?>  
                 <br>
                     <tr>
                              <td><?php  printf("%d",$index++); ?></td>
                               <td><?php  printf("%s",$obj[$i]); ?></td>
                               <td><?php  printf("%s",$obj[$i+1]); ?></td>
                               
                              <td><?php  if($obj[$i+7] == 0)
                                printf("","");
                              else
                                printf("%d",$obj[$i+7]); ?></td>
                
                       </tr> 
                   
            <?php
          }
        $i+=11;
        }
}
 
}
else{

        ?>
        <table width="1065" align="center">
     <tr align="center">
  </tr>
  <center>
  <tr align="center" bgcolor="green" height="30px" >
    <th style="color:white;width:60px;text-align:center; background-color:green;">S.No</th>
    <th style="color:white;width:100px;text-align:center; background-color:green;" >Paper Code</th>
    <th style="color:white;width:300px;text-align:center;background-color:green;">Subject</th>
    <th style="color:white;width:100px;text-align:center;background-color:green;">Mid Term</th>
    <th style="color:white;width:100px;text-align:center;background-color:green;">Practical</th>
    <th style="color:white;width:100px;text-align:center;background-color:green;">Faculty assessment</th>
        <th style="color:white;width:100px;text-align:center;background-color:green;">Internal marks</th>
  </tr>
  </tr>
    </center>
    <?php
		$query = "SELECT * FROM `".$mysql_tb."` WHERE rollno = '$rollno' ";
        $result = mysqli_query($con,$query);

		$index = 1;  //for S.No.
		$i = 2; 
		
    
while($obj = mysqli_fetch_row($result))
{  
    $fieldcount = mysqli_num_fields($result);

      while($i < $fieldcount - 4)
	     {  //printf("%s \t %s \t %s ",$obj[$i],$obj[$i+1],$obj[$i+3]);   statemnt that prints the diif column values
      //echo '<br />';
            ?>  
                 <br>
		                 <tr>
                              <td><?php  printf("%d",$index++); ?></td>
                               <td><?php  printf("%s",$obj[$i]); ?></td>
                               <td><?php  printf("%s",$obj[$i+1]); ?></td>
							   <td><?php  $code = $obj[$i];
                $query1 = "SELECT * FROM `papers` WHERE Code = '$code' ";
                       $result1 = mysqli_query($con,$query1);
                          $row1 = mysqli_fetch_assoc($result1);
                    if($row1['P'] != 0 && $row1['L'] == 0) 
                     printf("%s",'N/A');      
                 else if($obj[$i+4] == 0)
                  printf("","");
                else
                  printf("%d",$obj[$i+4]);
                   ?></td>
								<td><?php  $code = $obj[$i];
                $query1 = "SELECT * FROM `papers` WHERE Code = '$code' ";
                       $result1 = mysqli_query($con,$query1);
                          $row1 = mysqli_fetch_assoc($result1);
                      if($row1['P'] == 0)
                       printf("%s",'N/A'); 
                     else if($obj[$i+5] == 0)
                      printf("","");
                    else
                      printf("%d",$obj[$i+5]); 
                     ?></td>
								<td><?php  if($obj[$i+3] == 0)
                  printf("","");
                else
                  printf("%d",$obj[$i+3]);?></td>
								<td><?php  if($obj[$i+7] == 0)
                  printf("","");
                else
                  printf("%d",$obj[$i+7]); ?></td>
								
                         </tr> 
                   
            <?php
	     $i+=11;
        }
}

mysqli_free_result($result);
}
    ?>

</table>
</div>
<!-- <footer>
<div id="last" >
  <h3 style="color: white">Copyright of IGDTUW</h3>
</div>
<div id ="blc">
  <h3>IGDTUW-EXAMINATION DIVISION</h3>
</div>
</footer> -->

</body>
</html>