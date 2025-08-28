<?php
session_start();
include 'db_connection.php';



if (isset($_POST['login'])) {
  $email = trim($_POST['email']);
  $password = trim($_POST['password']);

  
       $check_user = "SELECT * FROM admin WHERE email = '$email' AND password='$password'";
       $run = mysqli_query($dbcon,$check_user);
       if (mysqli_num_rows($run)>0) {
        $_SESSION['email'] = $email;
          echo "<script>window.open('dashboard.php','_self')</script>";
        }else{
         echo "<script>window.open('login.php?msg=error','_self')</script>";
      } 
}



// i implement it in profile page

// if (isset($_POST['update_profile'])) {
//   $username = trim($_POST['username']);
//   $email = trim($_POST['email']);
//   $password = trim($_POST['password']);


//   $sql =  "UPDATE admin SET email = '$email', password = '$password', username = '$username' ";
//   if (mysqli_query($dbcon,$sql)) {
//     echo "<script>window.open('profile.php?msg=success','_self')</script>";
//   }
//   else{
//     echo "<script>window.open('profile.php?msg=error','_self')</script>";
//   }
// }





?>
