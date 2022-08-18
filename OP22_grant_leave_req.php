<?php
include "./Connection/dbcon.php";
include("sidebar.php");
$req=$_GET['updateid'];
if($req){
    $sql="SELECT * FROM `leaverequests` WHERE `u_id` = $req" ;
    $result=mysqli_query($con,$sql);
    if($result){
        $sql="UPDATE `leaverequests` SET `status` = '1' WHERE `leaverequests`.`u_id` = $req";
        $result2=mysqli_query($con,$sql);
        if($result2){
            header("location:OP21_manageleave.php");
        }
    }
}



?>