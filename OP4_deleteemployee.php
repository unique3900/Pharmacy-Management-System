<?php
include "./Connection/dbcon.php";
if(isset($_GET['deleteid'])){
$id = $_GET['deleteid'];
$designation = $_GET['deletedesignation'];

// ============================================
// ============= For Admin=====================

if ($designation == 'Admin') {
    $sql="DELETE FROM `admin` WHERE id = $id";
    $result=mysqli_query($con,$sql);

    if($result ){
        header('location:OP1_manageemployee.php');
    }


}


// ============================================
// ============= For Pharmacist=====================

if ($designation == 'Pharmacist') {
    $sql="DELETE FROM `pharmacist` WHERE id = $id";
    $result=mysqli_query($con,$sql);

    if($result ){
        header('location:OP1_manageemployee.php');
    }


}
}
