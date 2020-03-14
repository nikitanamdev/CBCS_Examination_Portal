<?php 
//$db = mysqli_connect('localhost', 'mobileed_student', 'root@123', 'mobileed_webapp1');
$db = mysqli_connect('localhost', 'root', '', 'student');
$q = "select `Enrolment No.`,I,E,T from result where BRANCH = 'MAE'";
$results = mysqli_query($db, $q);
    while($row = mysqli_fetch_assoc($results)){
		$rollno = $row["Enrolment No."];
		$internal = $row["I"];
		$ext = $row["E"];
		$tot = $row["T"];
		if($internal == 'AB'){
			$internal = -1;
		}
		if($ext == 'AB'){
			$ext = -1;
		}
		if($tot == 'AB'){
			$tot = -1;
		}
		$q2 = "update `25_1_2019` set `ET1` = $ext, `Internal1` = $internal, `total1` = $tot where rollno = $rollno ";
		mysqli_query($db, $q2);
	}
?>