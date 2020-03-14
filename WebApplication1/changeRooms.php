<?php include ('config.php');
session_start();
$user = $_SESSION['username'];
if (isset($_POST['set'])) {
	$q = "select * from rooms" ;
	$res = mysqli_query($db,$q);
	while($row = mysqli_fetch_assoc($res)){
		$id = $row["Id"];
		if(isset($_POST["$id"."del"])){
			$q1 = "delete from rooms where Id = '$id'";
			mysqli_query($db,$q1);
		}
		if(!empty($_POST["$id"."b"])){
		$b = mysqli_real_escape_string($db, $_POST["$id"."b"]);
		$q1 = "update rooms set Benches = '$b' where Id = '$id'";
			mysqli_query($db,$q1);
		}
	}
}
?>