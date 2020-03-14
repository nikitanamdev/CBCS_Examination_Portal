<?php include ('config.php') ?>
<?php

session_start();
$user = $_SESSION['username'];
$session = mysqli_real_escape_string($db, $_POST['select2']);
$date = mysqli_real_escape_string($db, $_POST['select3']);
$exam = mysqli_real_escape_string($db, $_POST['select1']);
$_SESSION['exam'] = $exam;
$_SESSION['date'] = $date;
$_SESSION['session'] = $session;

$q = "select Id from datesheet where `Exam Type` = '$exam' and Date = '$date' and Session = '$session' order by Course,Branch";
$results = mysqli_query($db, $q);
while($row=mysqli_fetch_assoc($results)){
$id=$row["Id"];
	$q1 = "delete from `sitting plan` where DS_Id = $id";
	mysqli_query($db, $q1);
}
$q = "select distinct Paper from datesheet where `Exam Type` = '$exam' and Date = '$date' and Session = '$session'";
$results = mysqli_query($db, $q);
while($row=mysqli_fetch_assoc($results)){
	$paper = $row["Paper"];
	$q3 = "select * from rooms";
	$results3 = mysqli_query($db, $q3);
	$row3=mysqli_fetch_assoc($results3);
	$rn = $row3["Id"];
	$cap = $row3["Benches"];
	$q1 = "select Id,Course,Branch,Sem from datesheet where `Exam Type` = '$exam' and Date = '$date' and Session = '$session' and Paper = '$paper'";
	$results1 = mysqli_query($db, $q1);
	$num =0;
	while($row1=mysqli_fetch_assoc($results1)){
	$ct=0;
		$table = '';
		$table2 = '';
		$id = $row1["Id"];
		$course = $row1["Course"];
		$branch = $row1["Branch"];
		$sem = $row1["Sem"];
		$year = date("Y")-(int)($sem/2);
		$mon = date("m");
		if(($sem%2!=0)&&($mon<'07'))
		$year--;
		if($course == 'B.Tech'){
			if($branch == 'CSE'){
					$table = '20_'.$sem.'_'.$year;
					$table2 = '21_'.$sem.'_'.$year;
			}else if($branch == 'IT'){
				$table = '22_'.$sem.'_'.$year;
				$table2 = '23_'.$sem.'_'.$year;
			}else if($branch == 'ECE'){
				 $table = '24_'.$sem.'_'.$year;
			}else if($branch == 'MAE'){
				 $table = '25_'.$sem.'_'.$year;
			}
		}
		else if($course == 'B.Arch'){
			$table = '26_'.$sem.'_'.$year;
		}
		else if($course == 'BBA'){
			$table = '27_'.$sem.'_'.$year;
		}
		else if($course == 'MCA'){
			$table = '28_'.$sem.'_'.$year;
		}
		else if($course == 'M.Tech'){
			if($branch == 'CSE'){
				$table = '29_'.$sem.'_'.$year;
			}else if($branch == 'IT'){
				$table = '30_'.$sem.'_'.$year;
			}else if($branch == 'ECE'){
				 $table = '31_'.$sem.'_'.$year;
			}else if($branch == 'MAE'){
				 $table = '32_'.$sem.'_'.$year;
			}
		}
		else if($course == 'M.Plan'){
			$table = '33_'.$sem.'_'.$year;
		}
		if($table2 == '')
		$q2 = "select * from $table order by rollno";
		else
		$q2 = "(select * from $table) union (select * from $table2) order by rollno";
		$results2 = mysqli_query($db, $q2);
		$i = 2; 
		$st = '';
		$end = '';
		while($obj = mysqli_fetch_row($results2)){
		$fieldcount = mysqli_num_fields($results2);
			while($i < $fieldcount - 4){  
				if($obj[$i] != NULL){
					 $subcode = $obj[$i] ;
					 $roll = $obj[0];
					 if($subcode == $paper){
						if($st == '')
						$st = $roll;
						$end = $roll;
						$num++;
						$ct++;
						if($num == $cap){
							$q4 = "insert into `sitting plan` values('',$id,'$rn','$st','$end','$ct')";
							mysqli_query($db, $q4);
							$st = '';
							$end = '';
							$num = 0;
							$ct=0;
							if($row3=mysqli_fetch_assoc($results3)){
								$rn = $row3["Id"];
								$cap = $row3["Benches"];
							}else{
								$results3 = mysqli_query($db, $q3);
								$row3=mysqli_fetch_assoc($results3);
								$rn = $row3["Id"];
								$cap = $row3["Benches"];
								$q4 = "update rooms set Two = 1 where Id = $rn";
								mysqli_query($db, $q4);
							}							
						}
						break;
					 }
				}
				$i+=11;
			 }
		 }
		 if($st!=''){
			$q4 = "insert into `sitting plan` values('',$id,'$rn','$st','$end','$ct')";
			mysqli_query($db, $q4);
		 }
	}
}
$q = "drop view SP";
mysqli_query($db, $q);
$q = " create view SP as select datesheet.`Exam Type`,datesheet.`Date`,datesheet.`Session`,datesheet.`Paper`,datesheet.`Course`,datesheet.`Branch`,datesheet.`Sem`,rooms.`Room No`,rooms.`Block`,rooms.`Floor`,rooms.`Benches`,rooms.`Two`,`sitting plan`.*,papers.Code,papers.Title from datesheet,rooms,`sitting plan`,papers where `Exam Type` = '$exam' and Date = '$date' and Session = '$session' and datesheet.Id = `sitting plan`.DS_Id and `sitting plan`.Room = Rooms.Id and papers.Code = datesheet.Paper";
mysqli_query($db, $q);
header('location: viewSP.php');


?>