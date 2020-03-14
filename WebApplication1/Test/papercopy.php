<?php 
//$db = mysqli_connect('localhost', 'mobileed_student', 'root@123', 'mobileed_webapp1');
$db = mysqli_connect('localhost', 'root', '', 'student');
$query = "select distinct Code, Title from papers";
$results = mysqli_query($db, $query);
    while($row = mysqli_fetch_assoc($results)){
	$c = $row["Code"];
	$t = $row["Title"];
		$q = "Insert into graderange(subcode,subname) values('$c','$t')";
		mysqli_query($db,$q);
	}
?>