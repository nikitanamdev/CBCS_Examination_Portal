<?php include ('config.php');
session_start();
$user = $_SESSION['username'];
$errors = array();
if (isset($_POST['set'])) {
$exam = mysqli_real_escape_string($db, $_POST['exam']);
$date = mysqli_real_escape_string($db, $_POST['dt']);
$session = mysqli_real_escape_string($db, $_POST['session']);
	$id = $_POST['id'];
	if($id == 0){
		array_push($errors,"Please select a paper!!!s");
	}
	while($id > 0){
		if(isset($_POST["select1$id"])){
			$c_b = mysqli_real_escape_string($db, $_POST["select1$id"]);
			$arr = explode(" ", $c_b);
			$course = $arr[0];
			if(preg_match('/\s/',$c_b)){
				$branch = $arr[1];
			}
			else {
				$branch = '';
			}
			$subCode = mysqli_real_escape_string($db, $_POST["select2$id"]);
			$sem = mysqli_real_escape_string($db, $_POST["select3$id"]);
			$q = "insert into datesheet values('','$exam','$date','$session','$subCode','$course','$branch','$sem')";
			mysqli_query($db,$q);
		}
		$id--;
	}
}

?>