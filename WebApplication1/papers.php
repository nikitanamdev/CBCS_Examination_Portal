
<?php include ('config.php') ?>
<?php 

session_start();
$con = $db;//mysqli_connect('localhost','root','','student');
//mysqli_select_db($con,'assessmentportal');
if($con === false) 
{
	die("ERROR:Could not connect.".mysqli_connect_error());
}
 
 $name = $_SESSION['username']; ?>
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
            <li><a href="#about">Notifications</a></li>
        </ul>
    </div>
    <br>
    <div id="navbar1">
        <ul>
            <li><a href="#enrollno.">Welcome <?php echo $name; ?></a></li>
            <li><a href="changePassword.php">Change password</a></li>
            <li><a href="front.php?logout='1'">Log Out</a></li>

        </ul>
    </div>
<br>
<br>
<br>
<?php
 
 /**  $sql =  "SELECT * FROM `Faculty` WHERE Name= '$name' ";
 $result = mysqli_query($con,$sql);
 //$row = mysqli_fetch_array($result,MYSQLI_NUM);
 $i = 2;
while($obj = mysqli_fetch_row($result))
{  $fieldcount = mysqli_num_fields($result);

      while($i<$fieldcount)
	     {  //printf("%s \t %s \t %s ",$obj[$i],$obj[$i+1],$obj[$i+3]);   statemnt that prints the diif column values
      //echo '<br />';
	 if($obj[$i+2] !=0 )
	 {      //to find whether the subject has a pratical part or not
        $query = "SELECT Practical FROM `subject` WHERE SubjectCode = '$obj[$i]'";
         $result1 = mysqli_query($con,$query);
          $row = mysqli_fetch_assoc($result1);
          //echo $row['Practical'];
     ?>  
               <table style=" position:relative; left:50px; width:80%; margin-top:50px; text-align:center;">  <!-- table code -->
			<tr>
         				    <td><?php  printf("%s",$obj[$i]); ?></td>
          					<td><?php  printf("%s",$obj[$i+1]); ?></td>
          					<td><?php  if($obj[$i+2] == 20) 
          					             printf("CSE1"); 
          					            else if($obj[$i+2] == 21)
          					             printf("CSE2");
          					            else if($obj[$i+2] == 22)
          					             printf("IT1");
          					            else if($obj[$i+2] == 23)
          					             printf("IT2");
          					            else if($obj[$i+2] == 24)
          					             printf("ECE");
          					            else if($obj[$i+2] == 25)
          					             printf("MECH");
          					         ?></td>
         					 <td><?php  printf("%d",$obj[$i+3]); ?></td>
         				
         					 <td><a href='rollno_midterm.php?id=<?=$i?>'>Mid Term</a></td> 
         					 <td><a href='rollno_fa.php?id=<?=$i?>'>Faculty Assessment</a></td> 
                   <?php if($row['Practical'] == 1) { ?>             <!-- if a practical part then show practical column else
                    not-->
                   <td><a href='rollno_practical.php?id=<?=$i?>'>Practical</a></td>
                   <?php 
                 } ?>
         					 <td><a href='rollno_grades.php?id=<?=$i?>'>Grades</a></td>
                   <td><a href='display.php?id=<?=$i?>'>Show Total</a></td>  

			</tr> 
				</table>
    <?php
}
    //$_SESSION['Code'] = $obj[$i+2];
    //$_SESSION['Sem'] = $obj[$i+3];
	$i+=5;
 }

}

mysqli_free_result($result);
**/


       $query = "SELECT * FROM `faculty1` WHERE  User = '$name'";
        $result = mysqli_query($con,$query);
         while($row = mysqli_fetch_assoc($result))
         {    $i =  $row['serialno'];
               $code = $row['SubCode'];
               $course = $row['Course'];
              // echo $course;
               $query1 = "SELECT * FROM `papers` WHERE Code = '$code' ";
                $result1 = mysqli_query($con,$query1);
                  $row1 = mysqli_fetch_assoc($result1);

           if($course == 'M.Plan' || $course == 'B.Arch')
           {   ?>
                
               <table  style=" position:relative; left:50px; width:90%; height:50px; font-size: 20px; margin-top:50px; text-align:center;">
           <tr style="background-color:green;">
                  <th style="width=60px; height:60px">Subject Code</th>
                  <th>Subject Name </th>
                  <th>Department</th>
                  <th>Semester</th>
                  <th>Roll No</th>
                  <?php  if($row1['L'] == 0 && $row1['T'] == 0 && $row1['P'] != 0) { ?>
                       <th>CAP</th>
                       <th>MTEP</th>
                       <th>Internal</th>
                       <?php }  else if($row1['L'] != 0 && $row1['T'] == 0 && $row1['P'] == 0) { ?>
                       <th>MTET</th>
                       <th>CAT</th>
                       <th>Internal</th>
                       <?php }  else if($row1['L'] == 0 && $row1['T'] != 0 && $row1['P'] == 0) { ?>
                       
                       <th>CAS</th>
                       <th>Internal</th>
                       <?php } ?>    
                   <th>External</th>  
                   <th>Grades</th>         
                  <th>Show Results</th>    

          </tr>
  
           <tr>
            <td><?php printf("%s ", $row['SubCode']); ?></td>
            <td><?php printf("%s ", $row['SubName']); ?></td>
            <td><?php printf("%s ", $row['Course']); ?></td>
            <td><?php printf("%s ", $row['Sem']); ?></td>
            <td><?php printf("%s To %s ", $row['RangeStart'],$row['RangeEnd']); ?></td>
            <?php  if($row1['L'] == 0 && $row1['T'] == 0 && $row1['P'] != 0) { ?>
                       <td><a href='rollno_midterm.php?id=<?=$i?>'>CAP</a></td>
            <td><a href='rollno_fa.php?id=<?=$i?>'>MTEP</a></td> 
            <td><a href='display.php?id=<?=$i?>'>Internal Evaluation</a></td> 
                       <?php }   else if($row1['L'] != 0 && $row1['T'] == 0 && $row1['P'] == 0) { ?>
                       <td><a href='rollno_midterm.php?id=<?=$i?>'>MTET</a></td>
            <td><a href='rollno_fa.php?id=<?=$i?>'>CAT</a></td> 
            <td><a href='display.php?id=<?=$i?>'>Internal Evaluation</a></td>
                       <?php }  else if($row1['L'] == 0 && $row1['T'] != 0 && $row1['P'] == 0) { ?>
                       <td><a href='rollno_internal.php?id=<?=$i?>'>CAS</a></td> 
                       <td><a href='display.php?id=<?=$i?>'>Internal Evaluation</a></td>
                       <?php } ?> 
           <td><a href='rollno_external.php?id=<?=$i?>'>External</a></td> 
           <td><a href='generate_grades.php?id=<?=$i?>'>Generate  Grades</a></td>  
           <td><a href='show_result.php?id=<?=$i?>'>Results</a></td> 

           </tr>
         </table>

            <?php   
           }       
           else
           {
           ?> <table  style=" position:relative; left:50px; width:90%; height:50px;font-size: 20px; margin-top:50px; text-align:center;">
           <tr style="background-color:green;">
                  <th style="width=60px; height:60px">Subject Code</th>
                  <th>Subject Name </th>
                  <th>Department</th>
                  <th>Semester</th>
                  <th>Roll No</th>
                  <?php  if($row1['L'] != 0) { ?>
                        <th>Mid term Marks</th>
                       <?php } ?>
                 
                  <th>Faculty Assessment</th>
                  
                 <?php  if($row1['P'] != 0) { ?>
                       <th>Practical Marks</th>
                       <?php } ?>
                  
                  <th>Internal Marks Evaluation</th>
                  <th>External Marks</th>
                  <th>Grades</th>         
                  <th>Show Results</th> 
          </tr>
  
           <tr>
            <td><?php printf("%s ", $row['SubCode']); ?></td>
            <td><?php printf("%s ", $row['SubName']); ?></td>
            <td><?php printf("%s ", $row['Branch']); ?></td>
            <td><?php printf("%s ", $row['Sem']); ?></td>
            <td><?php printf("%s To %s ", $row['RangeStart'],$row['RangeEnd']); ?></td>
            <?php if($row1['L'] != 0)  { ?>
             <td><a href='rollno_midterm.php?id=<?=$i?>'>Mid Term</a></td> <?php } ?>
            <td><a href='rollno_fa.php?id=<?=$i?>'>Faculty Assessment</a></td> 
                   <?php if($row1['P'] != 0) { ?>             <!-- if a practical part then show practical column else
                    not-->
            <td><a href='rollno_practical.php?id=<?=$i?>'>Practical</a></td>
                   <?php 
                 } ?>
           
           <td><a href='display.php?id=<?=$i?>'>Internal Evaluation</a></td>  
           <td><a href='rollno_external.php?id=<?=$i?>'>External</a></td>  
           <td><a href='generate_grades.php?id=<?=$i?>'>Generate  Grades</a></td>  
           <td><a href='show_result.php?id=<?=$i?>'>Results</a></td>

           </tr>
         </table>
         <br>
         <br>
         <br>
         <?php 
         }
        /** else
         { 
            ?> <table  style=" position:relative; left:50px; width:90%; height:50px; font-size: 20px; margin-top:50px; text-align:center;">
           <tr style="background-color:green;">
                  <th style="width=60px; height:60px">Subject Code</th>
                  <th>Subject Name </th>
                  <th>Department</th>
                  <th>Semester</th>
                  <th>Roll No</th>
                  <?php  if($row1['L'] != 0) { ?>
                       <th>Mid Term</th>
                       <th>Faculty Assessment</th>
                       <th>Internal Evaluation</th>
                       <?php } ?>
                  <?php  if($row1['T'] != 0) { ?>
                       <th>Internal </th>
                       <?php } ?>
                  <?php  if($row1['P'] != 0) { ?>
                       <th>CAP</th>
                       <th>MTEP</th>
                       <th>Internal</th>
                       <?php } ?>    
                   <th>External</th>  
                   <th>Grades</th>         
                  <th>Show Results</th>    

          </tr>
  
           <tr>
            <td><?php printf("%s ", $row['SubCode']); ?></td>
            <td><?php printf("%s ", $row['SubName']); ?></td>
            <td><?php printf("%s ", $row['Course']); ?></td>
            <td><?php printf("%s ", $row['Sem']); ?></td>
            <td><?php printf("%s To %s ", $row['RangeStart'],$row['RangeEnd']); ?></td>
            <?php  if($row1['L'] != 0) { ?>
                       <td><a href='rollno_midterm.php?id=<?=$i?>'>Mid Term</a></td>
            <td><a href='rollno_fa.php?id=<?=$i?>'>Faculty Assessment</a></td> 
            <td><a href='display.php?id=<?=$i?>'>Internal Evaluation</a></td> 
                       <?php } ?>
            <!-- <td><a href='rollno_midterm.php?id=<?=$i?>'>Mid Term</a></td>
            <td><a href='rollno_fa.php?id=<?=$i?>'>Faculty Assessment</a></td>  -->
                  <!-- <?php if($row1['P'] != 0) { ?>            
            <td><a href='rollno_practical.php?id=<?=$i?>'>Practical</a></td>
                   <?php 
                 } ?> -->
               <?php  if($row1['T'] != 0) { ?>
                       <td><a href='rollno_internal.php?id=<?=$i?>'>Internal Marks</a></td> 
                       <?php } ?>  
                <?php  if($row1['P'] != 0) { ?>
                       <td><a href='rollno_midterm.php?id=<?=$i?>'>CAP</a></td>
            <td><a href='rollno_fa.php?id=<?=$i?>'>MTEP</a></td> 
            <td><a href='display.php?id=<?=$i?>'>Internal Evaluation</a></td>
                       <?php } ?> 
        <!--   <td><a href='rollno_grades.php?id=<?=$i?>'>Grades</a></td>
           <td><a href='display.php?id=<?=$i?>'>Internal Evaluation</a></td>   -->
           <td><a href='rollno_external.php?id=<?=$i?>'>External</a></td> 
           <td><a href='generate_grades.php?id=<?=$i?>'>Generate  Grades</a></td>  
           <td><a href='show_result.php?id=<?=$i?>'>Results</a></td> 

           </tr>
         </table>
         <?php
         } **/

         }


    ?>


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