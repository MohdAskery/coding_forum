<div class="modal fade" id="loginmodal" tabindex="-1" role="dialog" aria-labelledby="loginmodalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginmodalLabel">Login coding</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/disc/pars/handleLogin.php" method="post">
                <div class="modal-body">
                <div class="alert alert-success" role="alert">
                </script>
                 <?php 
                 include 'connection.php';
                 $sql='SELECT * FROM `user`';
                 $result=mysqli_query($conn,$sql);
                 while($row=mysqli_fetch_assoc( $result)){
                    $user_ststus=$row['status'];
                    if($user_ststus=='active'){
                        $_SESSION['email_send_msg']="<h4 class='text-center my-0'>Login Here</h4>";
                    }
                    else{
                        $_SESSION['email_send_msg']="<h5 class='my-0'>Please verified you account email send on ".$_SESSION['email_sender']."</h5>";
                    }
                 }
                  if(isset($_SESSION['email_send_msg'])){
                     echo $_SESSION['email_send_msg'];
                  }
                  else{
                      echo "<h4 class='text-center my-0'>Login Here</h4>";
                  }
                 ?>
                        </div>

                    <div class="form-group">
                        <label for="email_login">Email address</label>
                        <input type="email" value="<?php if(isset($_COOKIE['email'])){echo $_COOKIE['email'];}
 ?>" class="form-control" id="email_login" name="email_login" aria-describedby="emailHelp"
                            placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="login_pass">Password</label>
                        <input type="password" value="<?php if(isset($_COOKIE['password'])){echo $_COOKIE['password'];}
 ?>" class="form-control" id="login_pass" name="login_pass" placeholder="Password">
                    </div>
                    <div class="form-check my-4 mx-3">
                        <input type="checkbox" name="rememberme" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label"  for="exampleCheck1">Remember Me</label>
                    </div>
                    <button type="submit" class="btn btn-primary mx-2">Submit</button>
                    <a href="forget_password.php" class="primary mx-3 my-3" style="font-size:17px;">Forget Password</a>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            
                </div>
            </form>
        </div>
    </div>
</div>