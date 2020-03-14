<?php 
//$db = mysqli_connect('localhost', 'mobileed_student', 'root@123', 'mobileed_webapp1');
$db = mysqli_connect('localhost', 'root', '', 'student');
$q = "select Enrollment_No from register where Branch = 'IT' and Course = 'B.Tech' and `Enrollment_No` > '07301012019'";
$res = mysqli_query($db, $q);
while($rec = mysqli_fetch_assoc($res)){
	$roll = $rec["Enrollment_No"];
	$q2 = "INSERT INTO `21_1_2019` (`rollno`, `CC1`, `CN1`, `CD1`, `CC2`, `CN2`, `CD2`, `CC3`, `CN3`, `CD3`, `CC4`, `CN4`, `CD4`, `CC5`, `CN5`, `CD5`, `CC6`, `CN6`, `CD6`) 
							VALUES ('$roll','BAS-101','Applied Mathematics-I',4,'BAS-103','Applied Physics-I',4,'BAS-105','Applied Chemistry',4,'BMA-110','Engineering Mechanics',4,'BMA-120','Workshop Practice',2,'BCS-110','Programming in C Language',3)";
	mysqli_query($db, $q2);
}
?>