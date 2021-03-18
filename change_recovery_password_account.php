<?php
session_start();
include_once 'pars/connection.php';

$get_token=$_GET['token'];
// $email=$_SESSION['user_mail_from_pass'];

?>
<!doctype html>
<html lang="en">
<style>

    body {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    #hd{
        margin-top:100px !important;
               width: 400px;
        /* margin-top: 150px; */
        border: 2px solid #11374e;
        border-radius: 6px;
        padding: 20px;
    }
   .inp{
       border:2px solid #fd0c0c !important;
   }
</style>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Change Password</title>
</head>

<body>

    <div class="conatiner mx-4 my-4" id="hd">
    <div id="massage-box"></div>
        <form action="<?php $_SERVER["REQUEST_URI"] ?>" method="post">
            <div class="form-group">
                <label for="new_password">New password</label>
                <input type="password" name="new_pass" class="form-control" id="inp1" aria-describedby="emailHelp"
                    placeholder="Enter new password">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">confirm password</label>
                <input type="password" name="c_pass" class="form-control" id="inp" placeholder="Password">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Update password</button>
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

$tk_sql="SELECT * FROM `user` WHERE `token`='$get_token'";
$result=mysqli_query($conn,$tk_sql);
while($data=mysqli_fetch_assoc($result)){
    $email=$data['email'];
}

$row=mysqli_num_rows($result);

if($row==1){
     if(isset($_POST['submit'])){
         $n_pass=$_POST['new_pass'];
         $c_pass= $_POST['c_pass'];
         if($n_pass==$c_pass){
             $password_hash=password_hash($n_pass,PASSWORD_DEFAULT);
             $update="UPDATE `user` SET `password`='$password_hash' WHERE `email`='$email' AND `token`='$get_token'";
             $update_result=mysqli_query($conn,$update);
             if($update_result){
                 echo "password update sucess";
                header("Location: http://localhost/disc/forget_password.php?account_status=update-sucess");
             }
             else{
             ?>
                <script>
                    let msg=document.getElementById("massage-box");
                    let str=`<div class="alert alert-danger" role="alert">Password not update </div>`;
                    msg.innerHTML=str
                    setTimeout(() => {
                    msg.innerHTML="";
                    }, 20000);
             </script>
        <?php

            }
            }
         else{
                    ?>
                <script>
                    let msg=document.getElementById("massage-box");
                    let str=`<div class="alert alert-danger" role="alert">Password not matching</div>`;
                    msg.innerHTML=str
                    setTimeout(() => {
                    msg.innerHTML="";
                    }, 20000);
             </script>
        <?php
         }
     }
}
else{
        ?>
    <script>
        let msg=document.getElementById("massage-box");
        let str=`<div class="alert alert-danger" role="alert">Invalid url check your url </div>`;
         msg.innerHTML=str
         setTimeout(() => {
         msg.innerHTML="";
         }, 20000);
     </script>
     <?php
}

?>