<?php
$servername = "localhost";
$username = "root";
$password = "";
$database="disc";

$conn =mysqli_connect($servername, $username, $password,$database);

$email=$_GET['email'];
$sql="SELECT * FROM `user` WHERE `email` IN ($email)";
 $result=mysqli_query($conn,$sql);
              while($row=mysqli_fetch_assoc($result)){
                  $id_c=$row['id'];
                  $sql_c="SELECT * FROM `comments` WHERE `comment_by`='$id_c'";
                  $result2=mysqli_query($conn,$sql_c);
                  $data_comments=mysqli_num_rows($result2);

                  $sql_t="SELECT * FROM `threads` WHERE `thread_user_id`='$id_c'";
                  $result3=mysqli_query($conn,$sql_t);
                  $data_th=mysqli_num_rows($result3);
                //   echo "<h1>".$data_comments."</h1>";
                echo '<tr>
                    <th scope="row">'.$row['id'].'</th>
                    <td>'.$row['first_name'].'</td>
                    <td>'.$row['last_name'].'</td>
                    <td>'.$row['username'].'</td>
                    <td>'.$row['email'].'</td>
                    <td>'.$row['status'].'</td>
                    <td> '.$data_th.'</td>
                    <td>'.$data_comments.'</td>
                    <td><a class="li" href="edit_user.php?id='.$row['id'].'" class="icons">Edit <i class="fa fa-pencil-square-o mx-1 icn_d" aria-hidden="true"></a></i></td>
                    <td><a class="li" href="delete_user.php?id='.$row['id'].'" class="icons">Delete <i class="fa fa-trash" aria-hidden="true"></i></a></td>
              </tr>';
 }
?>