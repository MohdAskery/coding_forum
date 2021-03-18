<?php
session_start();
include 'connection.php';
echo "<b>Wating...</b>";
session_destroy();
header("Location: /disc/index.php?logout=true");

?>