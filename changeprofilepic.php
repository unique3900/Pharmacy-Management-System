<?php
include "./Connection/dbcon.php";
// session_start();
include("sidebar.php");
            if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
                header("location: index.php");
                exit;
            }
    $modalid=$_SESSION['id'];
    






?>
