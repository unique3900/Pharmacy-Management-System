<?php
include "./Connection/dbcon.php";
include("sidebar.php");
$req=$_GET['updateid'];
if($req){
    $sql="SELECT * FROM `leaverequests` WHERE `id` = $req" ;
    $result=mysqli_query($con,$sql);
    if($result){
        $sql="UPDATE `leaverequests` SET `status` = '1' WHERE `leaverequests`.`id` = $req";
        $result2=mysqli_query($con,$sql);
        if($result2){
            header("location:OP21_manageleave.php");
        }
    }
}



?>