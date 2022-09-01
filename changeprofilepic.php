<?php
include "./Connection/dbcon.php";
// session_start();
include("sidebar.php");
            if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
                header("location: index.php");
                exit;
            }
    $modalid=$_SESSION['id'];
    
            if(isset($_POST['profilepic_change'])){
                // Givimg ramdom number suru ma kinaki repeat huna ne sakcha same name so overwrite nahos
                $origfilename= rand(1000,10000)."-".$_FILES['files']["name"];

                // Creating temporary file for storage
                $tempfilename=$_FILES['files']["tmp_name"];

                // Add uploaded file to local storage i.e profile_uploads
                $upload_dir= '/profile_uploads';
                move_uploaded_file($tempfilename,$upload_dir.'/'.$origfilename);



                if ($_SESSION['designation'] == 'Admin'){


                $sql="UPDATE `admin` SET `profile_photo` = 'abc.jpg' WHERE `admin`.`id` = $modalid";
                $result=mysqli_query($con,$sql);

                }

                if ($_SESSION['designation'] == 'Pharmacist'){
                    $sql="UPDATE `pharmacist` SET `profile_photo` = 'abc.jpg' WHERE `pharmacist`.`id` = $modalid";
                    $result=mysqli_query($con,$sql);
                }

            }





?>
