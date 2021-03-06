<?php
include "./connect.php";
include "./users.php";

$id = $_REQUEST['id'];
$student = new Student();
$teacher = new Teacher();
session_start();

//checks if user is logged in
if(!(($_SESSION["usertype"]) == "teacher")){
	header("Location: ./index.php");
}





?>


<!DOCTYPE html>
<html lang=en>


	<head>
		<title>edit student</title>
		<link rel="stylesheet" href="style.css">
  </head>
<body>
  
<div class="box">

<h1>Edit Student</h1>
  <?php
    if(isset($_POST['submit'])){
      $daysPresent = $_POST['dayspresent'];
      if($daysPresent<0){
        echo "not a valid number";
      }else{
      $student->editstudent($id);
      header("Location: ./teacherTable.php");
        
      }

      
    }
    if(isset($_POST['deleteStudent'])){
      $student->deletestudent($id);
      header("Location: ./teacherTable.php");
    }
    echo"
    <form method='POST'>
    <label> First name: </label> <input type='text' name='firstname' autocomplete='off' value='".$student->getFirstName($id)."'   required><br>
    <label>Last name:</label> <input type='text' name='lastname' autocomplete='off' value='".$student->getLastName($id)."' required> <br>
    <label>Email:</label> <input type='email' name='email' autocomplete='off' value='".$student->getEmail($id)."' required> <br>
   
    <label>Present:</label> <select name='present'>
      <option value='1'>Present</option>
      <option value='0'>Absent</option>
    </select><br>
    <label> Days Present: </label> <input type='number' name='dayspresent' min='1' value='".$student->getDaysPresent($id)."' required> <br>
    <label>Days Absent:</label> <input type='number' name='daysabsent' min='0' value='".$student->getDaysAbsent($id)."' required><br>
    <input name='submit' type='submit' value='Update Student'>
    </form>
  ";
  ?>

  <!-- Show the modal -->
  <button id='deleteButton'>Delete Student</button>
</div>





<!-- The Modal -->
  <div id='modal' class='modal'>

    <!-- content in the modal, gives option to confirm, sending a post request to delete the row, or to close the modal when denying -->
    <div class='modal-content'>
      <span class='close'>&times;</span>
      <h2>Are you sure you want to delete the student from the list?</h2>
      <form method='POST'>
        <input type='submit' name='deleteStudent' value='Yes' id="confirmButton">
        
      </form>
      
      <button onclick = "modal.style.display = 'none'" id="denyButton">No</button>
    </div>
  </div>
</body>

<script>

// Get the modal
var modal = document.getElementById("modal");



// Get the button that opens the modal
var btn = document.getElementById("deleteButton");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

var box = document.getElementsByClassName("box");

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
  box.style.display = "none";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
 
}
</script>


</html>