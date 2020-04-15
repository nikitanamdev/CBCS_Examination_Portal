<?php include ('config.php') ;
 $con =  $db;//mysqli_connect('localhost','root','root','student');
  session_start();  ?> 
    <!DOCTYPE html>
<html lan="en">
<head>
    <title>exam portal</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width-device-width,initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style5.css" />
    <script src="includes/jquery-1.6.2.js" type="text/javascript"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

    <style>
{
  box-sizing: border-box;
}
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
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
height: 25px;}
        

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

.container {
 
    overflow: hidden;

}
        .floatLeft { width: 50%; float: left; }
.floatRight {width: 50%; float: right; }

.col-25 {
  float: left;
  width: 20%;
  margin-top: 6px;
}

.col-75 {
  float: left;
  width: 40%;
  margin-top: 6px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
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

<h2>Provide the details</h2>

<div class="container">
    <div id = 'main' class="floatLeft">
  <form action="dean_ms2.php" method="post">
    <div class="row">
      <div class="col-25">
        <label for="course">Course</label>
      </div>
      <div class="col-75">
<select id="dept" name="course" required>
  <option value=''>Please select from below</option>
   <option value="20">B.Tech Computer Science Engineering(Batch1)</option>
   <option value="21">B.Tech Computer Science Engineering(Batch2)</option>
    <option value="22">B.Tech Information Technology(Batch1) </option>
     <option value="23">B.Tech Information Technology(Batch2) </option>
    <option value="24">B.Tech Electrical Engineering</option>
    <option value="25">B.Tech Mechanical Engineering</option>
    <option value="26">B.Arch</option>
      <option value="27">BBA</option>
      <option value="28">MCA</option>
      <option value="29">M.Tech Computer Science Engineering</option>
      <option value="30">M.Tech Information Technology</option>
      <option value="31">M.Tech Electrical Engineering</option>
      <option value="32">M.Tech Mechanical Engineering</option>
        <option value="33">M.Plan</option>
  </select>
        </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="semester">Semester</label>
      </div>
      <div class="col-75">
   <select id="sem" name="sem" required>
    <option value=''>Please select from below</option>
    <option value="1">1</option>
    <option value="2">2 </option>
  </select>
      </div>
    </div>
    <br>
<div >
  <center>
      <input type="submit" value="Submit">
    </center>
  </div>
  </form>
</div>
    
    </body>
</html>