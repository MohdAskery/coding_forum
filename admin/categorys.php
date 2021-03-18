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
        .icons{
            color:#000;
            font-size:30px;
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
    <a class="nav-link " aria-current="page" href="index.php">Dashboard</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="users.php">Users</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="categorys.php">Categorys</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="comments.php">Comments</a>
  </li>
</ul>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
</body>

</html>