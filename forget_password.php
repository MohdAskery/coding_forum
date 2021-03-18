<?php
// session_start();
include_once 'pars/connection.php';


?>

<!doctype html>
<html lang="en">

<head>
    <style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .center_iteam {
        width: 400px;
        margin-top: 150px;
        border: 2px solid #11374e;
        border-radius: 6px;
        padding: 20px;

    }
    </style>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>recover account</title>
</head>

<body>
    <div class="center_iteam">
    <div id="massage-box">
    
    </div>
        <form action="forget_password.php" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Send Email </button>
            <a href="http://localhost/disc/index.php" class="mx-4">Login</a>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>


<?php

if(isset($_POST['submit'])){
    $get_email=$_POST['email'];
            function checkEmail($email) {
                $find1 = strpos($email, '@');
                $find2 = strpos($email, '.');
                return ($find1 !== false && $find2 !== false && $find2 > $find1);
    }
    if(checkEmail($get_email)){
      $sql="SELECT * FROM `user` WHERE `email`='$get_email' AND `status`='active'";
      $result=mysqli_query($conn,$sql);
      $row=mysqli_num_rows($result);
      if($row>0){
        while($data=mysqli_fetch_assoc($result))
        {
            $token=$data['token'];
            $username=$data['username'];
            $email=$data['email'];
        }

                $to_email = $email;
                $subject = "Recover your account ";
                $body = "Hi $username, click on link to change you account password\nhttp://localhost/disc/change_recovery_password_account.php?token=$token;
                ";
                $headers = "From: techahideas@gmail.com";

                if (mail($to_email, $subject, $body, $headers)) {
                    // $_SESSION['user_mail_from_pass']=$email;
                    ?>
                    <script>
                        let msg=document.getElementById("massage-box");
                        let str=`<div class="alert alert-success" role="alert">email sucessfully send check you mail box </div>`;
                         msg.innerHTML=str
                         setTimeout(() => {
                         msg.innerHTML="";
                         }, 10000);
                     </script>
                     <?php
                    
                } else {
                    
                    ?>
                    <script>
                        let msg=document.getElementById("massage-box");
                        let str=`<div class="alert alert-danger" role="alert">email send failed</div>`;
                         msg.innerHTML=str
                         setTimeout(() => {
                         msg.innerHTML="";
                         }, 4000);
                     </script>
                     <?php
                }

        // header("Location: http://localhost/disc/change_recovery_password_account.php?token=$token");

      }
      else
      {
        ?>
        <script>
        let msg=document.getElementById("massage-box");
        let str=`<div class="alert alert-danger" role="alert">This email does not exist in our database</div>`;
        msg.innerHTML=str
        setTimeout(() => {
            msg.innerHTML="";
            }, 4000);
        </script>

    <?php
   
      }
    }

  
}


if(isset($_GET['account_status']) AND $_GET['account_status']=="update-sucess"){
                    ?>
                    <script>
                        let msg=document.getElementById("massage-box");
                        let str=`<div class="alert alert-success" role="alert">Password update sucessfully</div>`;
                         msg.innerHTML=str
                         setTimeout(() => {
                         msg.innerHTML="";
                         }, 20000);
                     </script>
                     <?php
}
?>