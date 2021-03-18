<?php
if($_SERVER["REQUEST_METHOD"]=='POST')
{
   session_start();
   $Error="false";
   include 'connection.php';
   $email=$_POST['signupEmail'];
   $pass=$_POST['signuppassword'];
   $cpass=$_POST['signupcpassword'];

   $user_name=$_POST['user_name'];
   $first_name=$_POST['first_name'];
   $last_name=$_POST['last_name'];

//    $user_namemysqli_real_escape_string($conn,$_POST['user_name']);
//    $first_name=mysqli_real_escape_string($conn,$_POST['first_name']);
//    $last_name=mysqli_real_escape_string($conn,$_POST['last_name']);

    $email = str_replace("<", "&lt;", $email);
    $email = str_replace(">", "&gt;", $email); 

    $user_name = str_replace("<", "&lt;", $user_name);
    $user_name = str_replace(">", "&gt;", $user_name);

    $first_name = str_replace("<", "&lt;",$first_name);
    $first_name = str_replace(">", "&gt;", $first_name);

   $extquery="select * from `user` where email='$email'";
   $result=mysqli_query($conn,$extquery);
   $numRows=mysqli_num_rows($result);
   if ($numRows>0){
       $Error="Email Is Already Exists in outr database";
   }
   else{
        
      if ($pass==$cpass){
         $token=bin2hex(random_bytes(15));
         $hash=password_hash($pass,PASSWORD_DEFAULT);
        //  INSERT INTO `user` (`id`, `username`, `first_name`, `last_name`, `email`, `password`, `timestamp`) VALUES ('$user_name', '$first_name', '$last_name', '$email', '$hash', current_timestamp());
        //  $sql="INSERT INTO `user` (`email`, `password`, `timestamp`) VALUES ('$email', '$hash', current_timestamp())";
         $sql="INSERT INTO `user` (`username`, `first_name`, `last_name`, `email`, `password`,`token`,`status`,`timestamp`) VALUES ('$user_name', '$first_name', '$last_name', '$email', '$hash','$token','Active-Not', current_timestamp())";
         $result=mysqli_query($conn,$sql);
         if ($result){
             $showAlert=true;
                
                $to_email = $email;
                $subject = "activate your account your account";
                $body = "Hi, clcik on link to varfi your account
                http://localhost/disc/pars/varfication.php?token=$token;
                ";
                $headers = "From: techahideas@gmail.com";

                if (mail($to_email, $subject, $body, $headers)) {
                    $_SESSION['email_send_msg']="Email successfully sent to ".$to_email."check you email to varifie your account";
                    $_SESSION['email_send_status']=true;
                    $_SESSION['email_sender']=$email;
                    echo  $_SESSION['email_send_msg'];
                } else {
                    echo "Email sending failed...";
                }

             header("Location: /disc/index.php?signupsucess=true");
             exit();
         }

      }
      else{
          $Error="Password Does't match";
      }
   }
   header("LOcation: /disc/index.php?signupsucess=false&error=$Error");



}

?>