<?php include ('changeRooms.php');?>
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
input[type=number]:focus {
  border: 3px solid #555;

}
input{
	height:auto;
	width:"10";
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
			<li><a href="#">Manage Rooms</a></li>
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
	<form method="post">
<table id="room" style="text-align:center">
  <thead>
  <tr>  
   <th>S.No.</th>
    <th>Block</th>
    <th>Floor</th>
    <th>Room</th>
    <th>Benches</th>
    <th>Delete Room</th>
  </tr>
  </thead>
  <tbody id="body_id">
  <?php 
	$q = "select * from rooms" ;
	$res = mysqli_query($db,$q);
	$num=0;
	while($row = mysqli_fetch_assoc($res)){
	$num++;
	$id = $row["Id"];
		$b =$row["Block"];
		$f = $row["Floor"];
		$r = $row["Room No"];
		$bn=$row["Benches"];
  ?>
  <tr>
  <td><?php echo $num;?></td>
    <td><?php echo $b;?></td>
    <td><?php echo $f;?></td>
    <td><?php echo $r;?></td>
    <td><?php echo $bn;?><br>
    <input type="text" id="<?php echo $id;?>" name="<?php echo $id.'b';?>" placeholder="<?php echo $bn;?>"></td>
    
    <td><input name="<?php echo $id.'del';?>" type="checkbox" id="checkbox[]" value="<? echo $rows['id']; ?>"></td>
  </tr>
  <?php 
  }
  ?>
  </tbody>
</table><br><br>
<div class="wrapper">
<button type="submit" name="set" value="submit">Submit Changes</button><br><br>
</div><br><br>
</form>
</div>

<div id="last" >
  <h2 style="color: white">Copyright of IGDTUW</h2>
</div>
<div id ="blc">
  <h2>IGDTUW-EXAMINATION DIVISION</h2>
</div>

</body>
</html>