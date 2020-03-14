<?php include('config.php');
         session_start();
         $con = $db;//mysqli_connect('localhost','root','root','student');
         
         $_SESSION['sub'] = $_POST['sub'];
         $sem  = $_POST['sem'];
         $_SESSION['sem'] = $sem.'_';
         $_SESSION['year'];

        if($sem == 1 || $sem == 2)
         $_SESSION['year'] = date("Y") - 1;
        else if($sem == 3 || $sem == 4)
         $_SESSION['year'] = date("Y") - 2;
        else if($sem == 5 || $sem == 6)
         $_SESSION['year'] = date("Y") - 3;
        else
         $_SESSION['year'] = date("Y") - 4;	

          header( "refresh:1;url=hod_grades.php" );
?>