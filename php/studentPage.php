<!DOCTYPE html>

<?php
include "./users.php";
include "./connect.php";
//get the session and check if user is logged in, if not then redirect to relogin

//echo the current session user to show they are logged in
session_start();

$student = new Student();
$email = $_SESSION['email'];




//if user tries to go to this page without logging in, it will redirect them to index.php
if(!$student->session()||$_SESSION["usertype"] == "teacher"){
	header("Location: ./index.php");
}

if(isset($_GET['logoutsession'])){
	$student->logout();
	header("Location: ./index.php");
}


?>



<html lang=en>
	<head>
	<title>Student Page</title>
	<link rel="stylesheet" href="style.css">
	</head>

	<header>
		<h2 id="title">Student Page</h2>
	<?php
	
	//displays user email
	if($student->session()){
		echo "<h4 id='displayuser'>Currently logged in as: ".$_SESSION['email']."</h4>";
	}
	
	?>
	<a href="?logoutsession" id="logoutbutton">Log out</a>


	</header>
	<body>
		<div class="box">

			<?php
			if(isset($_GET['signin'])){

				$student->loginAttendance($email);
				echo "<h3>Logged in for attendance </h3>";
			}
			
			if(isset($_GET['logout'])){
				$student->logoutAttendance($email);
				echo "<h3>Logged out for attendance</h3>";
			}
			?>


			<a href="?signin" class="button">Sign in for attendance</a>
			<a href="?logout" class="button">Sign out for attendance</a>
		</div>
		
		
	</body>
</html>