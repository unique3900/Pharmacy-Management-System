<?php
include "./Connection/dbcon.php";
include("sidebar.php");
$req=$_GET['deleteid'];
if($req){
    $sql="DELETE FROM `leaverequests` WHERE `leaverequests`.`u_id` = $req" ;
    $result=mysqli_query($con,$sql);
    if($result){
        // echo "<script>alert('Successfully Deleted');</script>";
        header("location:OP20_Leave_Req.php");
    }
}



?>