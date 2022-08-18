<?php
      include "./Connection/dbcon.php";

      if (isset($_GET['deleteid'])){
        $id=$_GET['deleteid'];
        $sql= "DELETE FROM supp_record WHERE supp_id = $id";
        $result=mysqli_query($con,$sql);
          if ($result) {
            header('location:OP13_managesupp.php');
            }
      else {
          die(mysqli_error($con));
            }
        }

 ?>
