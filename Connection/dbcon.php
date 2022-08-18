<?php
$servername="localhost";
$username="root";
$password="";
$dbname="hamro_pms";

$con=mysqli_connect($servername,$username,$password,$dbname);
if(!$con){
    echo "<script>alert('cannot make a connectiion!!Wait and Try again!!'</script>";
}


?>
