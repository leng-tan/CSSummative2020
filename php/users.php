<?php

//class User{


//  function __construct(){
//    // Create connection to the mysql database
//    $conn = mysqli_connect("localhost", "username", "password","cssummativedb");

    // Check connection
//    if (!$conn) {
//      die("Connection failed: " . mysqli_connect_error());
//      echo "Connection failed";
//    }
//  }
//} 

class Student{

  //constructor
  public function __construct(){

  }

  public function register($firstname, $lastname, $email, $password){
    include "connect.php";
    
    $password = md5($password); //encrypts password using MD5 encrypting algorithm
    
    //MAKE A CHECKER IF EMAIL ALREADY EXISTS
    //$sql = ("SELECT id FROM studentDB WHERE email='$email'");//checks if email already exists
    
    $sql = "INSERT INTO StudentDB (firstname, lastname, email, password, present) VALUES ('$firstname', '$lastname', '$email', '$password' , true)";

    if ($conn->query($sql) === TRUE) {
      echo "New record created successfully <br>";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
            
    $conn -> close();

  }

  function login($email, $password){
    include "connect.php";
    $password = md5($password);
    
    $sql = "SELECT * FROM studentDB WHERE email = '".$email."' and password = '".$password."'"; //'".md5($password)."'";
    
    //checks if the email is in the database by going through each row and checking
    $result = mysqli_query($conn,$sql) or die(mysqli_error());
    $rowcount = mysqli_num_rows($result); 
    if($rowcount == 1){
      $_SESSION['email']= $email;


      //update timestamp
      $sql = "UPDATE studentDB SET reg_date = now() WHERE email = '".$email."'";
      $result = mysqli_query($conn,$sql);
      if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
      } else {
        echo "Error updating record: " . $conn->error;
      }
      header("Location: ./studentPage.php"); //Redirects user to the student page
      return true;
      
    }else{
      return false;
    }
  }

  public function session(){
    if (isset($_SESSION['login'])){
      return $_SESSION['login'];
    }
  }
  public function logout(){
    $_SESSION['login'] = false;
    session_destroy();
  }

}


class Teacher{



  public function construct(){
    include "connect.php";
  }


  //function register(){
  //}
  function login($email, $password){
    include "connect.php";
    //$password = md5($password);
    
    
    
    $sql = "SELECT * FROM teacherDB WHERE email = '".$email."' and password = '".$password."'"; //'".md5($password)."'";
    
    //checks if the email is in the database by going through each row and checking
    $result = mysqli_query($conn,$sql) or die(mysqli_error());
    $rowcount = mysqli_num_rows($result); 
    if($rowcount == 1){
    $_SESSION['email']= $email;

    header("Location: ./teacherTable.php");
      
      return true;
    }else{
      return false;
    }
  }
  



}










//move the functions to student class
function editstudent($id){

  include "connect.php";
    $sql= "SELECT * FROM studentdb where id='".$id."'";

    $firstname =$_REQUEST['firstname'];
    $lastname =$_REQUEST['lastname'];
    $email =$_REQUEST['email'];
    $present =$_REQUEST['present'];
    //$sql = "UPDATE studentdb set firstname='".$firstname."', lastname='".$lastname."', email='".$email."'"'
    $sql = "UPDATE studentdb SET firstname='".$firstname."', lastname='".$lastname."', email='".$email."', present='".$present."'
    WHERE id='".$id."'
    ";
    if ($conn->query($sql) === TRUE) {
      echo "Record updated successfully";
    } else {
      echo "Error updating record: " . $conn->error;
    }



}



function deleteStudent($id){

include "connect.php";

    //finds the id of the row to delete from studentdb
    $sql = "DELETE FROM studentdb WHERE id='".$id."'";

    //checks if row in table is deleted.
    if ($conn->query($sql) === TRUE) {
      echo "Deleted record sucessfully";
    } else {
      echo "Error deleting record: " . $conn->error;
    }
}




?>