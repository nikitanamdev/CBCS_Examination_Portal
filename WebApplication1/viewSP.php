<?php include ('config.php');
session_start();
$user = $_SESSION['username'];
?>
<?php $q = "select * from SP";
$results = mysqli_query($db, $q);
?>
<!DOCTYPE html>
<html>
<head>
<title>exam portal</title>
	<meta charset="utf-8">
	
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<meta name ="viewport" content ="width-device-width,initial-scale=1">

	<link rel="stylesheet" type="text/css" href="style5.css" />
	<script src="includes/jquery-1.6.2.js" type="text/javascript"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
	
<style>
#room {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#room td, #room th {
  border: 1px solid #ddd;
  padding: 8px;
}
#room input{
 width:20%;
 }

#room tr:nth-child(even){background-color: #f2f2f2;}

#room tr:hover {background-color: #ddd;}

#room th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
.wrapper {
    text-align: center;
}

.button {
    position: absolute;
    top: 50%;
}

.header {
  padding: 0.3px;
  text-align:left;
  background: #4CAF50;
  color: white;
  font-size: 10px;
  width:60%;
  border: 4px solid #006400;
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
            <li><a href="homeA.php">Home</a></li>		
			<li><a href="datesheet.php">Enter Date Sheet</a></li>
			<li><a href="rooms.php">Manage Rooms</a></li>
			<li><a href="sitting.php">Generate Seating Plan</a></li>
			<li><a href="Gattendance.php">Generate Attendance</a></li>
    </div>
    <br>
    <div id="navbar1">
        <ul>
            <li><a href="#enrollno.">Welcome <?php echo $user; ?></a></li>
            <li><a href="front.php?logout='1'">Log Out</a></li>

        </ul>
    </div>
	<div class="maincontent">
	<input type="hidden" id="id" name="id" value="0"/>
<table id="room" style="text-align:center">
  <thead>
  <tr>  
   <th>S.No.</th>
    <th>Block</th>
    <th>Floor</th>
    <th>Room No.</th>
    <th>Programme</th>
    <th>Paper Code and Paper Name</th>
	<th>No. of Students</th>
	<th></th>
  </tr>
  </thead>
  <tbody id="body_id">
  <?php
  $i = 1;
  while($row=mysqli_fetch_assoc($results)){
	$b = $row["Block"];
	$f = $row["Floor"];
	$rm = $row["Room No"];
	$p = $row["Course"].' '.$row["Branch"];
	$paper = $row["Paper"].' '.$row["Title"];
	$num = $row["Count"];
	$st = $row["Start"];
	$end = $row["End"] ;
	$sp = $row["Id"];
	?>
	<tr>
	<td><?php echo $i; ?></td>
	<td><?php echo $b; ?></td>
    <td><?php echo $f; ?></td>
    <td><?php echo $rm; ?></td>
    <td><?php echo $p; ?></td>
    <td><?php echo $paper; ?></td>
	<td><?php echo $num; ?>(Rollno from : <?php echo $st; ?> to <?php echo $end; ?>)</td>
	<script>document.getElementById("id").value ++;</script>
	<td><?php echo "<button name='set' style='width:50%; border-radius: 20px;  ' onclick =\"location.href='row.php?id=$sp'\" type='submit' value='submit'>" ?>Download Seat Matrix</button></td>
	</tr>
	<?php
	$i++;  
  }
  ?>
  </tbody>
</table><br><br>
<button type="submit" value="submit" onclick ="location.href = 'downloadSP.php'">DOWNLOAD SEATING PLAN</button><br><br>
</div>

<div id="last" >
  <h2 style="color: white">Copyright of IGDTUW</h2>
</div>
<div id ="blc">
  <h2>IGDTUW-EXAMINATION DIVISION</h2>
</div>

</body>
</html>