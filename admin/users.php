<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://use.fontawesome.com/3b979609bd.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <style>
    .icons {
        color: #000;
        font-size: 20px;
        padding: 0px;
    }
  /* .container-fluid{
    min-height:20vh;
  } */
    .li {
        text-decoration: none;
        color: #000;
    }
    .container nav form{
      display:flex;
      padding:0px 10px;
    }
    .container{
      min-height:55vh;
    }
    </style>
    <title>Dashboard --Admin</title>
</head>

<body>
    <?php
    include 'config.php';
    include 'navbar.php';
    // include 'tab_menu.php';

    ?>


    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="index.php">Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="users.php">Users</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="categorys.php">Categorys</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="comments.php">Comments</a>
        </li>
    </ul>
    <div class="container my-3">
        <!-- <div class="row inli"> -->
            <nav class="navbar navbar-light bg-light">
                <form class="form-inline">
                    <input class="form-control mr-sm-2" id="serch" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0 mx-2" type="submit">Search</button>
                </form>
            <button id="showall" class="btn btn-primary">Show all</button>

            </nav>
        <!-- </div> -->
        <table class="table table-bordered border-primary table-hover">
            <thead>
                <tr>
                    <th scope="col">sno.</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">username</th>
                    <th scope="col">email</th>
                    <th scope="col">Status</th>
                    <th scope="col">Posts</th>
                    <th scope="col">Comments</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody id="tb">
                <?php
            $sql="SELECT * FROM `user` LIMIT 2";
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
                echo '              <tr>
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

            </tbody>
        </table>

    </div>
    <?php
    if(isset($_GET['Delete']) and $_GET['Delete']==true){
        ?>

        <?php
    }
   else if(isset($_GET['Delete']) and $_GET['Delete']==true){
        ?>
        
        <?php
    }
    
    ?>

 <?php include 'comp/footer.php';?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
    <script src="js/serch.js"></script>
</body>

</html>