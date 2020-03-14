<?php include ('config.php');
session_start();
$user = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lan="en">
<head>
    <title>Attendance Sheet Generation</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width-device-width,initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style5.css" />
	<script src="includes/jquery-1.6.2.js" type="text/javascript"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
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
			<li><a href="sitting.php">Generate Sitting Plan</a></li>
			<li><a href="#">Generate Attendance</a></li>
    </div>
    <br>
    <div id="navbar1">
        <ul>
            <li><a href="#enrollno.">Welcome <?php echo $user; ?></a></li>
            <li><a href="front.php?logout='1'">Log Out</a></li>

        </ul>
    </div>
	<div id="maincontent">
	<form method="post" action ="attendance.php">
	<table cellpadding=25px >
			<tr><td>Exam <select class='form-control' name='exam' id="select1" required>
			<option value=''>Please select from below</option>
			<option value='Mid-Term'>Mid-Term</option>
			<option value='End-Term'>End-Term</option>

			<td>Date <select class='form-control' name='dt' id="select3" required>
			<option value=''>Please select from below</option>
			<option name='Mid-Term' value='02/03/2020'>02/03/2020</option>
			<option name='Mid-Term' valu1='03/03/2020'>03/03/2020</option></select></td>

			<td>Session <select class='form-control' name='session' id="select2" required>
			<option value=''>Please select from below</option>
			<option name='Mid-Term' value='9:30 am - 11:00 am'>9:30 am - 11:00 am</option>
			<option name='Mid-Term' value='11:30 am - 1:00 pm' >11:30 am - 1:00 pm</option>
			<option name='Mid-Term' value='2:00 pm - 3:30 pm' >2:00 pm - 3:30 pm</option>
			<option name='Mid-Term' value='4:00 pm - 5:30 pm'>4:00 pm - 5:30 pm</option>
			<option name='End-Term' value='10:00 am - 1:00 pm'>10:00 am - 1:00 pm</option>
			<option name='End-Term' value='2:00 pm - 5:00 pm' >2:00 pm - 5:00 pm</option>
			</select></td>
			
			
			</tr>

			<tr><td>Programme <select class='form-control' name='prog' id="prog" required>
			<option value=''>Please select from below</option>
			<option value='B.Tech IT'>B.Tech IT</option>
			<option value='B.Tech CSE'>B.Tech CSE</option>
			<option value='B.Tech ECE'>B.Tech ECE</option>
			<option value='B.Tech MAE'>B.Tech MAE</option>
			<option value='B.Arch'>B.Arch</option>
			<option value='M.Plan'>M.Plan</option>
			<option value='BBA'>BBA</option>
			<option value='M.Tech IT'>M.Tech IT(Information Security Management)</option>
			<option value='M.Tech CSE'>M.Tech CSE(Artificial Intelligence)</option>
			<option value='M.Tech MAE'>M.Tech MAE(Robotics and Automation)</option>
			<option value='M.Tech ECE'>M.Tech ECE(VLSI Design)</option>
			<option value='MCA'>Master of Computer Application(MCA)</option></select></td>

			<td>Semester <select class='form-control' name='sem' id="sem" required>
			<option value='1' selected>1</option>
			<option value='2'>2</option></select></td>
			<td>Room <select class='form-control' name='room' id="room" required>
			<option value=''>Please select from below</option>
			<?php
			$q = "Select * from rooms";
			$res = mysqli_query($db,$q);

			while($row = mysqli_fetch_assoc($res)){
				$rm = $row["Room No"];
				$b = $row["Block"];
			?>			
			<option value='<?php echo ($b.' '.$rm);?>'><?php echo ($b.' '.$rm);?></option>
			<?php
			}
			?>
			</select></td>
			</tr></table><br>
			<script>
		$(document).ready(function(){
          $("#select1").change(function() {
             if ($(this).data('options') === undefined) {
      /*Taking an array of all options-2 and kind of embedding it on the select1*/
      $(this).data('options', $('#select2 option').clone());
	 $(this).data('options1', $('#select3 option').clone());
      }
          var id = $(this).val();
		  //window.alert(id);
          var options = $(this).data('options').filter('[name="' + id + '"]');
		  var options1 = $(this).data('options1').filter('[name="' + id + '"]');
          $("#select2").html(options);
		  $("#select3").html(options1);
        });
    });
	
</script>
	<button type="submit" value="submit"  style="width:30%; border-radius: 20px; position:realtive; left:50px;  ">Generate Attendance Sheet</button>
	</form>
	</div>
<div id="last" >
        <h2 style="color: white">Copyright of IGDTUW</h2>
    </div>
    <div id="blc">
        <h2>IGDTUW-EXAMINATION DIVISION</h2>
    </div>    
</body>
</html>