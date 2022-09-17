<?php
include "./Connection/dbcon.php";
if(isset($_GET['deleteid'])){
$id = $_GET['deleteid'];
$designation = $_GET['deletedesignation'];

// ============================================
// ============= For Admin=====================


    $sql="DELETE FROM `employee` WHERE id = $id";
    $result=mysqli_query($con,$sql);

    if($result ){
        header('location:OP1_manageemployee.php');
    }




// ============================================
// ============= For Pharmacist=====================


}
