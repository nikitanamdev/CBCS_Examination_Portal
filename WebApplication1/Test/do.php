<?php 
//$db = mysqli_connect('localhost', 'mobileed_student', 'root@123', 'mobileed_webapp1');
$db = mysqli_connect('localhost', 'root', '', 'student');
$query = "SELECT * FROM master_table where Course ='M.Plan'";
    $results = mysqli_query($db, $query);
    while($row = mysqli_fetch_assoc($results)){
	$rollno = $row["enrollment_no"];
	$name = $row["name"];
	$c_b = $row["course"];
    $arr = explode(" ", $c_b);
	$course = $arr[0];
	$branch = $arr[1];
	if(empty($branch)){
		$branch = "NULL";
	}
	$fname = $row["father_name"];
	$mname = $row["mother_name"];
	$dob = $row["dob"];
	$add = $row["address"];
	$distt = $row["district"];
	$state = $row["state"];
	$pin = $row["pin_code"];
	$contact = $row["contact"];
	$alter = $row["alternate_contact"];
	$password = password_hash("igdtuw".$rollno,PASSWORD_DEFAULT);
	$email  = $row["email"];
	$secq= $row["security"];
	$ans = $row["answer"];
	$ten = $row["marks_10th"];
	$tw = $row["marks_12th"];
	$passn = $row["passing_year_12th"];
	$query1 = "INSERT INTO `register` (`ID`, `Enrollment_No`, `Name`, `Course`, `Branch`, `Semester`, `Year`, `Father's_Name`, `Mother's_Name`, `DOB`, `Address Line 1`,  `District`, `State`, `Pincode`, `Contact_No`, `Alternate_Contact`, `Password`, `Email_ID`, `Security_Question`, `Security_Answer`, `10th_percent`, `12th_percent`, `Passing_12th`) VALUES (NULL, '$rollno', '$name', '$course', '$branch', '1', 2019, '$fname', '$mname', '$dob', '$add', '$distt', '$state', '$pin', '$contact', '$alter', '$password', '$email', '$secq', '$ans', '$ten', '$tw', '$passn')";
	mysqli_query($db, $query1);
		}

?>