<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>code </title>
</head>

<body>
    <?php include 'pars/header.php' ?>
    <?php include 'pars/connection.php' ?>
    <?php

    $id = $_GET['catid'];
    $id = str_replace("'", " ", $id);
    $id = str_replace("/", " ", $id); 
    $id = str_replace("\\", " ", $id); 
    $id = str_replace("", " ", $id); 
    $id = str_replace(".", " ", $id); 
    $id = str_replace(",", " ", $id); 
    $id = str_replace("?", " ", $id); 
    $id = str_replace("+", " ", $id); 
    $id = str_replace("=", " ", $id); 
    $id = str_replace("_", " ", $id); 
    $id = str_replace(";", " ", $id); 
    $sql = "SELECT * FROM `categorys` WHERE category_id=$id";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $catname=$row['category_name'];
        $catdesc=$row['category_description'];
    }
    ?>

<?php
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if($method=='POST'){
        // Insert into thread db
        $th_title = $_POST['title'];
        $th_desc = $_POST['desc'];
        $th_title = str_replace("<", "&lt;", $th_title);
        $th_title = str_replace(">", "&gt;", $th_title); 

        $th_desc = str_replace("<", "&lt;", $th_desc);
        $th_desc = str_replace(">", "&gt;", $th_desc); 
        
        $sno = $_POST['id']; 
        $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ( '$th_title', '$th_desc', '$id', '$sno', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
        if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> Your thread has been added! Please wait for community to respond
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                  </div>';
        } 
    }
    ?>
    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4">welcome to <?php echo $catname ?> fourms</h1>
            <p class="lead"><?php echo $catdesc ?></p>
            <hr class="my-4">
            <p>No Spam / Advertising / Self-promote in the forums
                Do not post copyright-infringing material
                Do not post “offensive” posts, links or images
                Do not cross post questions
                Do not PM users asking for help
                Remain respectful of other members at all times. </p>
            <a class="btn btn-success" href="#" role="button">Learn more</a>
        </div>
    </div>
    <?php
    if(isset($_SESSION['loggeduser']) && $_SESSION['loggeduser']==true){
    echo '    <div class="container">
        <h1 class="py-2">Start a Discussion</h1>
         <form action="'.$_SERVER["REQUEST_URI"].'" method="post">
       <div class="form-group">
            <label for="title">Problem Title</label>
            <input type="text" class="form-control" id="title" name="title" aria-describedby="title">
            <small id="emailHelp" class="form-text text-muted">Keep your title as short and crisp aspossible</small>
        </div>
        <div class="form-group">
           <input type="hidden" name="id" value="'. $_SESSION["id"]. '">
            <label for="title">Ellaborate Your Concern</label>
            <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
</form>
    </div>';
    }
    else{
        echo '<div class="container">
        <h1 class="py-2">Start a Discussion</h1>
            <div class="jumbotron">
            <div class="container">
                <p class="lead">You are Not Login </p>
            </div>
            </div></div>';
    }
    ?>


    <div class="container">
        <h1 class="py-3">Browse-Questions</h1>
        <?php
         $id = $_GET['catid'];
         $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id"; 
         $result = mysqli_query($conn, $sql);
         $noResult = true;
         while($row = mysqli_fetch_assoc($result)){
            $noResult = false;
            $id = $row['thread_id'];
            $title = $row['thread_title'];
            $desc = $row['thread_desc']; 
            $thread_time = $row['timestamp']; 
            $thread_user_id = $row['thread_user_id']; 
            $sql2 = "SELECT email FROM `user` WHERE id='$thread_user_id'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
         
            echo '<div class="media my-3">
            <img src="img/userd.png" width="54px" class="mr-3" alt="...">
            <div class="media-body">
               <p class="font-weight-bold my-0 text-white bg-danger w-50  p-1 rounded">'.$row2['email'].' at '.  $thread_time. '</p>
                <h5 class="mt-0"><a class="text-dark" href="thread.php?threadid=' . $id. '">'.$title.'</a></h5>
                '.$desc.'
            </div>
        </div>';
    }
    // echo var_dump($noResult);
        if($noResult){
            echo '<div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <p class="display-4">No Threads Found</p>
                        <p class="lead"> Be the first person to ask a question</p>
                    </div>
                 </div> ';
        }
    ?>

    </div>

    <?php include 'pars/footer.php'  ?>
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
</body>

</html>