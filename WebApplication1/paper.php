<?php include ('config.php') ?>
<?php
session_start();
//$db = mysqli_connect('localhost', 'root', '', 'student');
$user = $_SESSION['username'];
$sem= 0;
$errors = array();
if (isset($_GET['error'])) {
	array_push($errors, "Please select the required papers");
	$_POST['submit'] = 0;
}
?>
<!DOCTYPE html>
<html lan="en">
<head>
    <title>paper registration</title>
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
            <li><a href="home.php">Home</a></li>
            <li><a href="paper.php">Display Papers</a></li>
            <li><a href="result.php">Results</a></li>
			<li><a href="admitcard.php">Admit Card</a></li>
            <li><a href="#about">Notifications</a></li>
        </ul>
    </div>
    <br>
    <div id="navbar1">
        <ul>
            <li><a href="#enrollno.">Welcome <?php echo $user; ?></a></li>
            <li><a href="changePassword.php">Change password</a></li>
            <li><a href="front.php?logout='1'">Log Out</a></li>

        </ul>
    </div>

    <div id="maincontent">



    </div>
    <div id="side">
        <p style="background-color:green;color:white;padding:20px;margin-right:15%;border-radius:10px;font-size: 30px">PAPER REGISTRATION</p>
       

        <?php
		$query = "SELECT * FROM register WHERE Enrollment_No='$user'";
        $results = mysqli_query($db, $query);
        $row=mysqli_fetch_assoc($results);
        $branch = $row["Branch"];
        $course = $row["Course"];
        $sem = $row["Semester"];
		$year = $row["Year"];
		$table = "table";
		
		if($course == 'B.Tech'){
			if($branch == 'CSE'){
				if($user <= '08201012016'){
					$table = '20_'.$sem.'_'.$year;
				}else{
					$table = '21_'.$sem.'_'.$year;
				}
			}else if($branch == 'IT'){
				if($user <= '07301012016'){
					$table = '22_'.$sem.'_'.$year;
				}else{
					$table = '23_'.$sem.'_'.$year;
				}
			}else if($branch == 'ECE'){
				 $table = '24_'.$sem.'_'.$year;
			}else if($branch == 'MAE'){
				 $table = '25_'.$sem.'_'.$year;
			}
		}else if($course == 'B.Arch'){
			$table = '26_'.$sem.'_'.$year;
		}else if($course == 'BBA'){
			$table = '27_'.$sem.'_'.$year;
		}else if($course == 'MCA'){
			$table = '28_'.$sem.'_'.$year;
		}else if($course == 'M.Tech'){
			if($branch == 'CSE'){
				$table = '29_'.$sem.'_'.$year;
			}else if($branch == 'IT'){
				$table = '30_'.$sem.'_'.$year;
			}else if($branch == 'ECE'){
				 $table = '31_'.$sem.'_'.$year;
			}else if($branch == 'MAE'){
				 $table = '32_'.$sem.'_'.$year;
			}
		}else if($course == 'M.Plan'){
			$table = '33_'.$sem.'_'.$year;
		}

		if($course == 'B.Tech' and (($sem == 1) or ($sem == 2))){
			if(($branch == 'CSE')||($branch == 'ECE'))
				$branch = 'CseEce';
			else
				$branch = 'ItMae';
		}
		//updating backend for all
		if (isset($_POST['submit'])){
		if($course == 'B.Tech')
			$q1 = "select max(Choice) from papers where Course = '$course' and (Branch = '$branch' or Branch = 'NULL') and Semester = '$sem'";
		else
			$q1 = "select max(Choice) from papers where Course = '$course' and Branch = '$branch' and Semester = '$sem'";
		$res = mysqli_query($db, $q1);
		$rec = mysqli_fetch_assoc($res);
		$i = 1 ;
		$f = 0;
		$max = $rec["max(Choice)"];
		while( $i <= $max ){			
			if(empty($_POST["paper$i"])){
				array_push($errors, "Please select the required papers");
				$f = 1;
				break;
			}
			$i = $i + 1;
		}
		if( $f == 0){
			$q2 = "Insert into $table(rollno) values('$user')";
			mysqli_query($db, $q2);
			if($course == 'B.Tech')
				$q1 = "select * from papers where Course = '$course' and (Branch = '$branch' or Branch = 'NULL') and Semester = '$sem' and Choice = 0 ";
			else
				$q1 = "select * from papers where Course = '$course' and Branch = '$branch' and Semester = '$sem' and Choice = 0 ";
			$res = mysqli_query($db, $q1);	
			$i = 1;
			while( $rec = mysqli_fetch_assoc($res) ){		//compulsory
				$Code = 'CC'.$i ;
				$Name = 'CN'.$i ;
				$Credits = 'CD'.$i;
				$code = $rec["Code"];
				$title = $rec["Title"];
				$credits = $rec["Credits"];
				$q2 = "update $table set $Code = '$code', $Name = '$title', $Credits = $credits where rollno = '$user'";
				$i = $i + 1;
				mysqli_query($db, $q2);
			}
			mysqli_free_result($res);
			$comp = $i - 1;
			if($course == 'B.Tech')
				$q1 = "select max(Choice) from papers where Course = '$course' and (Branch = '$branch' or Branch = 'NULL') and Semester = '$sem'";
			else
				$q1 = "select max(Choice) from papers where Course = '$course' and Branch = '$branch' and Semester = '$sem'";
			$res = mysqli_query($db, $q1);
			$rec = mysqli_fetch_assoc($res);
			$i = 1 ;
			$max = $rec["max(Choice)"];
			while( $i <= $max ){							//optionals
			if(!empty($_POST["paper$i"])){
				$p = $_POST["paper$i"];
				if($course == 'B.Tech')
					$q1 = "select * from papers where Code='$p' and (Branch = '$branch' or Branch = 'NULL') and  Semester='$sem' and Course = '$course'";
				else
					$q1 = "select * from papers where Code='$p' and Branch = '$branch' and  Semester='$sem' and Course = '$course'";
				$res = mysqli_query($db, $q1);
				$rec = mysqli_fetch_assoc($res);
				$code = $rec["Code"];
				$title = $rec["Title"];
				$credits = $rec["Credits"];
				$ind = $comp + $i;
				$q2 = "update $table set CC$ind = '$code', CN$ind = '$title', CD$ind = $credits where rollno = '$user'";
				mysqli_query($db, $q2);
				mysqli_free_result($res);
				}
				$i = $i + 1;
		   }
		}
  }
		$q = "select * from $table where rollno ='$user'";
        $results2 = mysqli_query($db, $q);
		if (mysqli_num_rows($results2) >= 1) {   //already registered for all
			$rows=mysqli_fetch_assoc($results2);
			if($course == 'B.Tech')
				$q_ = "select COUNT(DISTINCT Choice) from papers where Course = '$course' and (Branch = '$branch' or Branch = 'NULL') and Semester = '$sem'";
			else
				$q_ = "select COUNT(DISTINCT Choice) from papers where Course = '$course' and Branch = '$branch' and Semester = '$sem'";
			$results2_ = mysqli_query($db, $q_);
			$rows_ = mysqli_fetch_assoc($results2_);
			$num = $rows_["COUNT(DISTINCT Choice)"];
			if($course == 'B.Tech')
				$q_ = "select COUNT(Choice) from papers where Course = '$course' and (Branch = '$branch' or Branch = 'NULL') and Semester = '$sem' and Choice = 0";
			else
				$q_ = "select COUNT(Choice) from papers where Course = '$course' and Branch = '$branch' and Semester = '$sem' and Choice = 0";
			$results2_ = mysqli_query($db, $q_);
			$rows_ = mysqli_fetch_assoc($results2_);
			$num = $num + $rows_["COUNT(Choice)"] - 1;
			$i = 1;
      ?>
       <div id="selected">
	   <table cellpadding=10px  >
	   <tr style="font-weight:bold"><td></td>
			   <td>Paper Code</td>
			   <td>Paper Title</td>
			   <td>Paper Credits</td></tr>
	  <?php while($i <= $num){
		$Code = 'CC'.$i ;
		$Name = 'CN'.$i ;
		$Credits = 'CD'.$i;

	  ?>
	  <tr>
	  <td><?php echo $rows["$Code"];?></td>
	  <td><?php echo $rows["$Name"];?></td>
	  <td><?php echo $rows["$Credits"];?></td>
	  </tr>
	  <?php 
	  $i = $i + 1;
	  }?>
	 </table>
	   </div>
       <?php 
	   }else{									//not registered, for all
		 ?>
		 
	  	<?php include('errors.php'); ?>
        <div id="select">
   <form action="paper.php" method="post">
                <?php	
		if($course == 'B.Tech')
			$q = "select * from papers where Course = '$course' and (Branch = '$branch' or Branch = 'NULL') and Semester = '$sem' and Choice = 0 ";
        else
			$q = "select * from papers where Course = '$course' and Branch = '$branch' and Semester = '$sem' and Choice = 0 ";
        $results2 = mysqli_query($db, $q);
        ?>
<table cellpadding=10px>
		<tr style="font-weight:bold"><td></td>
			   <td>Paper Code</td>
			   <td>Paper Title</td>
			   <td>Paper Credits</td></tr>
		<?php
                while($rows=mysqli_fetch_assoc($results2)){
                ?>
               <tr><td>   </td>
			   <td> <?php echo $rows["Code"];?></td>
			   <td> <?php echo $rows["Title"];?></td>
			   <td><?php echo $rows["Credits"];?></td></tr>
                
                <?php } ?>
</table>
		<?php
		if($course == 'B.Tech')
			$q = "select max(Choice) from papers where Course = '$course' and (Branch = '$branch' or Branch = 'NULL') and Semester = '$sem'";
		else
			$q = "select max(Choice) from papers where Course = '$course' and Branch = '$branch' and Semester = '$sem'";
		$results2 = mysqli_query($db, $q);
		$rows = mysqli_fetch_assoc($results2);
		$i =1 ;
		$max = $rows["max(Choice)"];
		while($i <= $max){
		?>
		<hr size="5">
<table cellpadding=10px>
		<?php
		if($course == 'B.Tech')
			$q = "select * from papers where Course = '$course' and (Branch = '$branch' or Branch = 'NULL') and Semester = '$sem' and Choice = $i";
		else
			$q = "select * from papers where Course = '$course' and Branch = '$branch' and Semester = '$sem' and Choice = $i";
			$results2 = mysqli_query($db, $q);
                while($rows=mysqli_fetch_assoc($results2)){
				$name = 'paper'.$i;
                ?>
               <tr><td> <input type="radio" name="<?php echo $name?>" value="<?php echo $rows["Code"]?>"></td>
			   <td> <?php echo $rows["Code"];?></td>
			   <td> <?php echo $rows["Title"];?></td>
			   <td><?php echo $rows["Credits"];?></td></tr>
                
                <?php } ?>
</table>
		<?php 
				$i = $i + 1;
				}
				?>
                <button type="submit" class="sbmtbtn" name="submit" value="submit" >Register papers</button>
         </form>
     </div>
		<?php 
				mysqli_free_result($results);
		}
	
mysqli_free_result($results2);


		mysqli_close($db);
		?>
    </div>
    <div id="last">
        <h2 style="color: white">Copyright of IGDTUW</h2>
    </div>
    <div id="blc">
        <h2>IGDTUW-EXAMINATION DIVISION</h2>
    </div>
</body>
</html>