<?php
$showError="false";
if($_SERVER["REQUEST_METHOD"]=='POST'){
    include 'connection.php';
    $email=$_POST['email_login'];
    $pass=$_POST['login_pass'];

    $sql="select * from `user` where email='$email' and status='active'";
    $result=mysqli_query($conn,$sql);
    $numRows=mysqli_num_rows($result);
    if ($numRows==1)
    {
       $row=mysqli_fetch_assoc($result);
       if (password_verify($pass,$row['password']))
       {
          session_start();
          $_SESSION["loggeduser"]=true;
          $_SESSION["userEmail"]=$email;
          $_SESSION["id"]=$row['id'];
          $_SESSION["first_name"]=$row['first_name'];
          echo "logged" .$email;
          if(isset($_POST['rememberme'])){
            //   setcookie('email',$email,time()+86400);
              setcookie('email', $email, time()+86400, '/disc/index.php', 'localhost', false);
              setcookie('email', $email, time()+86400, '/disc/', 'localhost', false);
              setcookie('password', $pass, time()+86400, '/disc/', 'localhost', false);
              setcookie('password', $pass, time()+86400, '/disc/index.php', 'localhost', false);
            //   setcookie('password',$pass,time()+86400);
              header("Location:/disc/index.php");

          }
          header("Location:/disc/index.php");
          exit();
        }else{

            header("Location:/disc/index.php?Error=password");
            exit();
        }
    }
    else{
        header("Location:/disc/index.php?Error=email");
        exit();
    }
header("Location:/disc/index.php?Error=false");
}
?>