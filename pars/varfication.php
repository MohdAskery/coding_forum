<?php
session_start();
include 'connection.php';
 if(isset($_GET['token']))
 {
  $token=$_GET['token'];
  $sql="UPDATE `user` SET status='active' WHERE token='$token'";
  $result=mysqli_query($conn,$sql);
  if($result){
      if($_SESSION['email_send_status']){
          $_SESSION['email_send_msg']="Account Activated sucessfully";
          header("Location:/disc/index.php?email_varified=true");
          exit();
      }
      else{
      }
  }
  else{
      header("Location: /disc/index.php?varified=filed");
  }
 }
else{
    echo '<font color="red">sorry some this is wrong</font>';
}

?>