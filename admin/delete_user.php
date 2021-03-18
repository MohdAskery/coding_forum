 <?php
include 'config.php';
    // include 'navbar.php';
$id=$_GET['id'];
$sql="SELECT * FROM `user` WHERE `id`=$id";
$result=mysqli_query($conn,$sql);
$num=mysqli_num_rows($result);
 if($num>0){
         $sql_del="DELETE FROM `user` WHERE `id`='$id'";
         $result2=mysqli_query($conn,$sql_del);


         $sql_comment="DELETE FROM `comments` WHERE `comment_by`='$id'";
         $result3=mysqli_query($conn,$sql_comment);


         $sql_threads="DELETE FROM `threads` WHERE `thread_user_id`='$id'";
         $result4=mysqli_query($conn,$sql_threads);

         
         if($result2){
             header("Location: ".$url."/admin/users.php?Delete=true");
         }
         else{
            header("Location: ".$url."/admin/users.php?Delete=false");

         }

        }
        ?>