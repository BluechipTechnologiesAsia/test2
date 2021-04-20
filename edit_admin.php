<?php
 require_once('db.php');
  if (isset($_POST['submit'])) {
      $email = $_POST['email'];
      
      $cksql = "SELECT id FROM admin WHERE email = '$email'";
      $chkemail = mysqli_query($connection, $cksql);


      /*if (mysqli_num_rows($chkemail)>0) {
          // email already EXISTS
            echo "Oops...This email already exists!";
            die();
      }
      else {*/

        $password = password_hash($_POST['password'],PASSWORD_BCRYPT,array('cost'=>12));

      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                  $emailErr = "Invalid email format";
                  echo $emailErr;
                  die();
                  $email = $_POST['email'];
               }
               else {

               }
      //-- Get Employee Data --//
      $fname = $_POST['fname'];
      $lname = $_POST['lname'];
      $role = $_POST['role'];
      $location = $_POST['ulocation']; 
      $mobile = $_POST['mobile'];  
      $empid = $_POST['empid']; 
      $userid =  $_POST['userid'];  

      if ($role !="QA") 
      {
         $location ="";
        }  

      //-- Insert Data Into DB --//
      $sql = "UPDATE `admin` SET `fname`='$fname',`lname`='$lname',`location`='$location',`email`='$email',`mobile`='$mobile',`role`='$role',`password`='$password' WHERE `id`='$userid'";
      
      $sql2="UPDATE `inc_email` SET `role`='$role',`email`='$email',`location`='$location' WHERE `empid`='$empid'";

      //-- Insert Data Into DB --//

     

      try {
       
        mysqli_query($connection, $sql); 
        mysqli_query($connection, $sql2); 
        header('Location:../users.php?editsuccess');

      }

       catch (Exception $e) {
          $e->getMessage();
          echo "Error";
      }


      
      // END OF - CHECK IF EMPLOYEE EMAIL EXISTS //
      }
?>