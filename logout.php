<?php
session_start();
session_unset(); //Destroy All the Session varialbles
session_destroy();
header('location:index.php');
exit;


?>