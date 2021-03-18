<?php
session_start();
error_reporting(0);
if(isset($_SESSION['loggeduser']) && $_SESSION['loggeduser']==true){

    // echo 'you are login';

}
else{
   echo "<h1>404 Page not found</h1>";
   exit();
}

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/my_account.css">

    <title>My my_account</title>
</head>

<body>
    <?php include 'pars/header.php';?>
    <?php include 'pars/connection.php';?>

    <?php include 'pars/my_account_modal.php';?>


    <?php

if(isset($_SESSION['loggeduser'])){
  //! slect user data from database 
  $sql="SELECT * FROM `user`";
  $result=mysqli_query($conn,$sql);
  if($result){
    while($row=mysqli_fetch_assoc($result)){
      $id=$row['id'];
      $username=$row['username'];
      $first_name=$row['first_name'];
      $last_name=$row['last_name'];
      $email=$row['email'];
    }
  }
  else{
    
  }
}
?>
    <div id="div-msg">

    </div>
    <div class="container my-4">
        <h2 class="text-center my-4">Update Profile</h2>
        <form action="<?php $_SERVER["REQUEST_URI"] ?>" method="POST">
            <div class="form-group">
                <label for="username">User name</label>
                <input type="text" class="form-control" value="<?php echo $username;?>" id="username" name="username"
                    aria-describedby="emailHelp" placeholder="User name">
            </div>

            <div class="form-group">
                <label for="username">First name</label>
                <input type="text" class="form-control" value="<?php echo $first_name;?>" id="first_name"
                    name="first_name" aria-describedby="emailHelp" placeholder="First name">
            </div>

            <div class="form-group">
                <label for="username">Last name</label>
                <input type="text" class="form-control" value="<?php echo $last_name;?>" id="last_name" name="last_name"
                    aria-describedby="emailHelp" placeholder="Last name">
            </div>

            <div class="form-group">
                <label for="username">email</label>
                <input type="text" readonly class="form-control" value="<?php echo $email;?>" id="emial" name="email"
                    aria-describedby="emailHelp" placeholder="Last name">
            </div>



            <button type="submit" class="btn btn-primary" name="submit">Update</button>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Change Password
            </button>
        </form>

        <?php
if(isset($_POST['submit'])){
$up_username=$_POST['username'];
$up_first_name=$_POST['first_name'];
$up_last_name=$_POST['last_name'];


$up_username = str_replace("<", "&lt;",$up_username);
$up_username = str_replace(">", "&gt;", $up_username);

$up_first_name = str_replace("<", "&lt;",$up_first_name);
$up_first_name = str_replace(">", "&gt;", $up_first_name);

$up_last_name = str_replace("<", "&lt;",$up_last_name);
$up_last_name = str_replace(">", "&gt;", $up_last_name);



if($username==$up_username && $first_name==$up_first_name && $last_name==$last_name){

}
else{
  $sql_update="UPDATE `user` SET `username` = '$up_username',`first_name`='$up_first_name',`last_name`='$up_last_name' WHERE `id` = '$id' AND `email` = '$email'";
  $result_update=mysqli_query($conn,$sql_update);
  if($result_update){
      $_SESSION["first_name"]=$up_first_name;
      ?>
        <script>
        let div = document.getElementById("div-msg");
        let html_div = `<div class="alert alert-success alert-dismissible fade show" role="alert">
                 <strong>Update!</strong> Update sucessfully
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>`;
        div.innerHTML = html_div;
        setTimeout(function() {
        div.innerHTML = "";
        location.reload();
        }, 3000);
        </script>
        <?php
  }
}

}

?>


    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
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
// !  code for update password
$sql_for_password="select * from `user` where email='$email' and status='active'";
$result_for_password=mysqli_query($conn,$sql_for_password);
if($result_for_password){
   while($row_for_password=mysqli_fetch_assoc($result_for_password))
    {
        $password_from_database=$row_for_password['password'];
    }
    // echo $password_from_database;

}
else{

}
 if(isset($_POST['password_btn'])){
$current_password=$_POST['cu_password'];
$new_password=$_POST['new_password'];
$new_password_confirm=$_POST['c_pass'];
    if(password_verify($current_password,$password_from_database)){
        if($new_password==$new_password_confirm){
          $update_hash=password_hash($new_password,PASSWORD_DEFAULT);
          $sql_update_password="UPDATE `user` SET `password` = '$update_hash' WHERE `id` = '$id' AND `email` = '$email'";
          $result_for_update_password=mysqli_query($conn,$sql_update_password);
          if($result_for_update_password){
              ?>
                      <script>
        let div = document.getElementById("div-msg");
        // document.getElementById("div-msg").innerHTML = "Hello World";

        let html_div = `<div class="alert alert-success alert-dismissible fade show" role="alert">
                 <strong>Password update!</strong> Password Update sucess
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>`;
        // alert("You are logged out in 5 seconds");
        div.innerHTML = html_div;
        setTimeout(function() {
            div.innerHTML = "";
            // window.location = "http://localhost/disc/pars/_logout.php";
        }, 5000);
        </script>
              <?php
          }
          else{
                            ?>
                      <script>
        let div = document.getElementById("div-msg");
        // document.getElementById("div-msg").innerHTML = "Hello World";

        let html_div = `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                 <strong>Password update!</strong> Password Does not update
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>`;
        // alert("You are logged out in 5 seconds");
        div.innerHTML = html_div;
        setTimeout(function() {
            div.innerHTML = "";
            // window.location = "http://localhost/disc/pars/_logout.php";
        }, 5000);
        </script>
              <?php
          }
        }
        else{
                          ?>
                      <script>
        let div = document.getElementById("div-msg");
        // document.getElementById("div-msg").innerHTML = "Hello World";

        let html_div = `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                 <strong>Password update!</strong> Confirm password does not match 
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>`;
        // alert("You are logged out in 5 seconds");
        div.innerHTML = html_div;
        setTimeout(function() {
            div.innerHTML = "";
            // window.location = "http://localhost/disc/pars/_logout.php";
        }, 5000);
        </script>
              <?php
        }
    }
    else{
                          ?>
                      <script>
        let div = document.getElementById("div-msg");
        // document.getElementById("div-msg").innerHTML = "Hello World";

        let html_div = `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                 <strong>Incorrect Password!</strong> incorrect password password not match
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>`;
        // alert("You are logged out in 5 seconds");
        div.innerHTML = html_div;
        setTimeout(function() {
            div.innerHTML = "";
            // window.location = "http://localhost/disc/pars/_logout.php";
        }, 5000);
        </script>
              <?php
    }
 }





?>
