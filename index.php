<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <link rel="stylesheet" href="/pars/css/footer.css"> -->
    <link rel="stylesheet" href="/pars/css/footer.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>code </title>
</head>

<body>
    <?php include 'pars/header.php' ?>
    <?php include 'pars/connection.php' ?>

    <?php    
    if(isset($_GET['email_varified']) and $_GET['email_varified']==true)
    {
        echo '
    <div class="alert alert-success my-0 alert-dismissible fade show" role="alert">
         <strong>Account varified</strong> Account varified sucessfully you can login now 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
     </button>
    </div>
    ';
}
?>


    <!-- ALERT BOX <DIV></DIV> -->


    <div id="massage-box">

    </div>


    <!-- carouselExampleIndicators -->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="img/slider-1.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="img/slider-2.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="img/slider-3.jpg" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>




    <!-- Optional JavaScript; choose one of the two! -->
    <div class="container my-4">
        <h1 class="text-center my-4">Mohdaskery- Browse-categorys</h1>
        <div class="row my-4">

            <?php


        $sql = "SELECT * FROM `categorys` ORDER BY RAND ( )"; 
         $result = mysqli_query($conn, $sql);
         while($row = mysqli_fetch_assoc($result)){
        //  echo $row['category_id'];
        //  echo $row['category_name'];
        $id=$row['category_id'];
        $cat=$row['category_name'];
        $desc=$row['category_description'];
        echo '<div class="col-md-4 my-2">
          <div class="card" style="width: 18rem;">
             <img class="card-img-top" src="https://source.unsplash.com/500x400/?'. $cat .',coding"
                alt="Card image cap">
                  <div class="card-body">
                   <h5 class="card-title"><a href="threadlist.php?catid='. $id .'">'. $cat .'</a></h5>
                    <p class="card-text">'. substr($desc,0,90) .'...</p>
                 <a href="threadlist.php?catid='. $id .'" class="btn btn-primary"> view Threads</a>
          </div>
      </div>
  </div>';
      }

    //! code for masage box

    if(isset($_GET['Error'])){
           if($_GET['Error']=="password"){
                      ?>
            <script>
            let msg_box = document.getElementById('massage-box');
            str = `<div class="alert my-0 alert-danger alert-dismissible fade show" role="alert">
                    <strong>Wrong password! </strong> You should check your password
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
               </div>`;
               msg_box.innerHTML+=str;
                 setTimeout(() => {
                   msg_box.innerHTML="";
               }, 3000);

            </script>
            <?php

           
           }
    }

      ?>





        </div>
    </div>
    <?php include 'pars/footer.php'  ?>
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
</body>

</html>


<?php
if(isset($_GET['Error'])){
  if($_GET['Error']=="email"){
                ?>
            <script>
            let msg_box = document.getElementById('massage-box');
            str = `<div class="alert my-0 alert-danger alert-dismissible fade show" role="alert">
                    <strong>Wrong Email! </strong> Email not exists in our database
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
               </div>`;
               msg_box.innerHTML+=str;
               setTimeout(() => {
                   msg_box.innerHTML="";
               }, 3000);

            </script>

            <?php
            }
}

?>