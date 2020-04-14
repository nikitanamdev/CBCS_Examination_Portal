<?php
session_start();
include ('config.php');
$username = "";
$errors = array();
if (isset($_POST['login_user'])) {

  $username = mysqli_real_escape_string($db, $_POST['uname']);
  $password = mysqli_real_escape_string($db, $_POST['psw']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }
  if(!empty($_POST['captcha'])){
  if(!($_POST['captcha'] == $_SESSION['vercode'])){
	array_push($errors, "Wrong Captch Code");
  }
  }
  if (count($errors) == 0) {
        $url = '';
  //	$password = password_hash($password,PASSWORD_DEFAULT);
  if(is_numeric($username)){
  	$query = "SELECT Password FROM register WHERE Enrollment_No='$username'";
  	$results = mysqli_query($db, $query);
	$row=mysqli_fetch_assoc($results);
  	if ((mysqli_num_rows($results) == 1) and password_verify($password,$row['Password'])){
  	  $_SESSION['username'] = $username;
	  $url = 'home.php';
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }else if($username == 'admin'){
        $query = "SELECT Password FROM users WHERE User='$username'";
  	$results = mysqli_query($db, $query);
	$row=mysqli_fetch_assoc($results);
	if($password == $row['Password']){
	$_SESSION['username'] = $username;
        $url = 'homeA.php';
	}else{
		array_push($errors, "Wrong Password, Access Denied for admin login");
	}
  }else if($username == 'hod'){
        $query = "SELECT Password FROM users WHERE User='$username'";
  	$results = mysqli_query($db, $query);
	$row=mysqli_fetch_assoc($results);
	if($password == $row['Password']){
	$_SESSION['username'] = $username;
        $url = 'homeH.php';
	}else{
		array_push($errors, "Wrong Password, Access Denied for HOD login");
	}
  }
  else{
		$query = "SELECT Password FROM faculty WHERE User='$username'";
  	$results = mysqli_query($db, $query);
	$row=mysqli_fetch_assoc($results);
  	if ((mysqli_num_rows($results) == 1) and password_verify($password,$row['Password'])){
  	  $_SESSION['username'] = $username;
	  $url = 'homeF.php';
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
header("location: $url");
//echo "<script type='text/javascript'> document.location = '$url' ; </script>";
  }
}
?>