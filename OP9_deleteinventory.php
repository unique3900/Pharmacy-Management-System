<?php
    include "./Connection/dbcon.php";
    if(isset($_GET['deleteid'])){
    $id = $_GET['deleteid'];


    $sql="DELETE FROM `medicine_record` WHERE id = $id";
        $result=mysqli_query($con,$sql);

        if($result ){
            header('location:OP6_manageinventory.php');
        }
        else{
            echo "<script>alert('Cannot Delete This Since other Information Might Get Affected');</script>";
            
            

        }

    }


?>
