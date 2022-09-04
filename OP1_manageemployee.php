<?php
include "./Connection/dbcon.php";
include("./sidebar.php");

$modalid=$_SESSION['id'];

// SELECT MONTHNAME(date) as mname, sum(total_sale) as total FROM sale_record GROUP BY MONTH(date);


if(isset($_POST['profilepic_change'])){

$extension_image=pathinfo($_FILES['file']["name"],PATHINFO_EXTENSION);
if(!in_array($extension_image,['png','jpeg','jpg','svg']))
{
    echo'
    <div class="alert alert-danger mt-4 ml-auto w-50 alert-dismissible fade show  float-center" role="alert">
    <strong>Invalid File Type!</strong> Only PNG,JPEG,JPG and SVG files Allowed
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
    ';

}
else{
//checking file type if image format ko ho ki haina vanera




// Givimg ramdom number suru ma kinaki repeat huna ne sakcha same name so overwrite nahos
$filefname=rand(1000,10000) ."-".$_FILES["file"]["name"];

// Creating temporary file for storage
$tname=$_FILES["file"]["tmp_name"];

// Add uploaded file to local storage i.e profile_uploads
$uploadfolder='./uploads';
move_uploaded_file($tname,$uploadfolder .'/'. $filefname);



if ($_SESSION['designation'] == 'Admin'){


$sql="UPDATE `admin` SET `profile_photo` = '$filefname' WHERE `admin`.`id` = $modalid";
$result=mysqli_query($con,$sql);

        if($result){
            echo "<script>alert('Successfully Changed')</script>";
        }

}

if ($_SESSION['designation'] == 'Pharmacist'){

    $sql="UPDATE `pharmacist` SET `profile_photo` = '$filefname' WHERE `pharmacist`.`id` = $modalid";
    $result=mysqli_query($con,$sql);


    if($result){
        echo "<script>alert('Successfully Changed')</script>";
    }
}
}

}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/all.min.css">
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/jquery.dataTables.min.css">
     <!-- <link rel="stylesheet" href="../CSS/style.css"> -->
    <script src="../JS/Script.js"></script>
    <link rel="stylesheet" href="CSS/jquery.dataTables.min.css">
    <style>
            *{
                margin: 0;
                padding: 0;
                outline: none;
                box-sizing: border-box;
                text-decoration: none;
                font-family: 'Arizonia', cursive;
                font-family: 'Hahmlet', serif;
                font-family: 'Roboto', sans-serif;
            }

            /* Primart Colors For Background And Texts */
            :root {
                --primary-color: rgb(255, 255, 255);
                --primary-color-cards: rgb(250, 253, 255);
                --secondary-color: rgb(232, 241, 234);
                --secondary-color2: rgb(219, 255, 255);
                --text-color1: black;
                --text-color-2: white;
            }

            /* Primart Colors to toggle when dark theme is on */
            .dark-theme {
                --primary-color: rgb(66, 66, 66);
                --primary-color-cards: rgb(199, 199, 199);
                --secondary-color: rgb(138, 138, 138);
                --secondary-color2: rgb(163, 163, 163);
                --text-color1: rgb(240, 220, 220);
                --text-color-2: black;
            }



            /* ================================= Login Form CSS  ===========================
            ========================================================================================= */

            /* Sidebar Ko lagi CSS */
            .containers #sidebar {
                align-items: center;
                position: fixed;
                top: 0;
                bottom: 0;
                height: 100vh;
                left: 0;
                width: 280px;
                background-image: linear-gradient(to right top, #a4ffb5, #90ffb0, #77ffac, #56ffa9, #11ffa7);
                border-radius: 0.5rem;
                overflow-x: hidden;
                z-index: 1;
                transition: 0.6s;

                box-shadow: 0 20px 35px rgba(0, 0, 0, 0.1);
            }
            #sidebar.hide{
            width: 0;
            }


            nav:hover {
                width: 280px;
            }

            nav img {
                margin-bottom: 3px;
                position: relative;
                width: 40px;
                height: 20px;
                top: 20px;
                font-size: 20px;
                text-align: center;
            }
            nav .side_btn img {
                margin-bottom: 3px;
                position: relative;
                width: 40px;
                height: 20px;
                top: 20px;
                font-size: 20px;
                text-align: center;
            }

            nav a {
                position: relative;
                width: 280px;
                font-size: 20px;
                color: var(--text-color-1);
                display: table;
                padding: 10px;
            }

            .logo {
                text-align: center;
                display: flex;
                margin: 10px 0 0 10px;
                padding-bottom: 3rem;
            }

            .logo img {
                position: relative;
                width: 40px;
                height: 30px;
                top: 20px;
                font-size: 20px;
                text-align: center;
            }

            .logo span {
                color: var(--text-color1);
                text-transform: uppercase;
                font-weight: bold;
                margin-top: 10px;
                padding-left: 15px;
            }

            .nav-item {
                text-align: center;
                position: relative;
                top: 12px;
                margin-left: 10px;
            }

            a:hover {
                text-decoration: none;
                background: rgba(194, 194, 194, 0.1);
            }

            .mode {
                position: absolute;
                bottom: 100px;
            }
            .pwd_change{
            position: absolute;
            bottom:150px
            }

            .logout {
                position: absolute;
                bottom: 100px;

            }

            .containers {
                display: flex;
            }

            #icon_logo {
                width: 30px;
            }

            #icon {
                bottom: 50px;
                cursor: pointer;
            }

            /* Sidebar menu Open Close Button */
            #opensidemenu {
                font-size: 2rem;
                height: 40px;
                width: 20px;

            }

            #closesidemenu {
                position: relative;
                margin-left: 220px;
                width: 20px;
                height: 30px;
            }
            #sidebar.hide ~ #main {
                width: calc(100% - 10px);
                left: 10px;
            }







            /* Main Section Where Display garincha */
            .main {
                position: relative;
                padding: 20px;
                width: calc(100% - 260px);
                left: 260px;
                transition: .3s ease;
            }

            .main h1 {
                color: var(--text-color1);
                font-size: 3rem;
                margin: auto;
                text-align: center;
                margin-bottom: 10px;
            }

            .main-top {
                display: flex;
                width: 100%;
            }
            .main img {
                margin-bottom: 3px;
                position: relative;
                width: 40px;
                height: 20px;
                top: 20px;
                font-size: 20px;
                text-align: center;
            }
            .main-top i {
                position: absolute;
                right: 0;
                margin: 10px 30px;
                color: gray;
                cursor: pointer;
            }

            .main .users {
                display: flex;
                justify-content: space-around;
                flex-wrap: wrap;
                width: 100%;
            }

            .users .card {
                overflow-x: auto;
                overflow-y: auto;
                /* width: 35%; */
                flex: 1 1 200px;
                /* Jaba DIsplay Ko size Ghatcha Taba Auto Matically cardsa ko size adjust huncha (flex-grow,shrink and width */
                margin: 10px;
                background: rgb(255, 255, 255);
                text-align: center;
                border-radius: 10px;
                padding: 10px;
                box-shadow: 0 20px 35px rgba(0, 0, 0, 0.1);
            }

            .users .card img {
                width: 100px;
                height: 100px;
                border-radius: 25%;

            }

            .users .card h4 {
                color: var(--text-color1);
                text-transform: uppercase;
                text-align: center;
            }

            .users .card p {
                color: var(--text-color1);
                text-transform: uppercase;
                font-size: 15px;
                margin-bottom: 15px;
            }

            .users table {
                margin: auto;
            }

            .users .per span {
                color: var(--text-color1);
                padding: 5px;
                /* background: rgb(255, 255, 250); */
            }

            .users td {
                text-align: center;
                font-size: 15px;
                padding-right: 20px;
            }

            .users table a {
                cursor: pointer;
                text-emphasis: none;
                text-decoration: none;
            }

            .users .card #btn_view {
                position: relative;
                width: 130px;
                height: 45px;
                background-color: var(--primary-color);
                color: var(--text-color1);
                margin-top: 15px;
                background: var(--primary-color);
                border-radius: 10px;
            }

            .users .card a:hover {
                cursor: pointer;
                background: var(--primary-color-cards);
                color: var(--text-color-1);
                transition: 0.2s;
            }





            /* Css for Crud Table */

            #Add_btn {
                width: 100px;
                background-color: darkblue;
                color: white;
                outline: none;
                height: 40px;
                margin-bottom: 15px;
                border-radius: 5px;
                box-shadow: 0 10px 10px rgba(0, 0, 0, 0.2);
                margin-right: 2px;

            }

            .t_table {
                width: calc(100% - 280px);
                        left: 280px;
                        width: 100%;
                        border-collapse: collapse;
            }

            .t_table td,
            .t_table th {
                padding:12px 15px;
                border:1px solid #ddd;
                text-align: center;
                font-size:16px;
            }

            .t_table th {
                background-color: darkblue;
                color:#ffffff;
            }

            .t_table tr {
                color: var(--text-color1);
            }

            .t_table tbody tr:nth-child(even) {
                background-color: var(--secondary-color2);
            }

            #up_btn {
                width: 90px;
                background-color: darkblue;
                color: white;
                outline: none;
                height: 30px;
                border-radius: 5px;
                box-shadow: 0 10px 10px rgba(0, 0, 0, 0.2);
                margin-right: 2px;

            }

            #del_btn {
                width: 90px;
                background-color: darkred;
                color: white;
                outline: none;
                height: 30px;
                border-radius: 5px;
                box-shadow: 0 10px 10px rgba(0, 0, 0, 0.2);


            }
            */


            /* Main.form vaneko hamile document ko body ko rup ma maneko so height ra width full rakheko */


                    #Add_btn {
                        width: 100px;
                        background-color: darkblue;
                        color: white;
                        outline: none;
                        height: 40px;
                        margin-bottom: 5px;
                        border-radius: 5px;
                        box-shadow: 0 10px 10px rgba(0, 0, 0, 0.2);
                        margin-right: 2px;

                    }

                    .t_table {
                    width: calc(100% - 280px);
                left: 280px;
                        width: 100%;
                        border-collapse: collapse;
                    }

                    .t_table td,
                    .t_table th {
                        padding: 12px 15px;
                        border: 1px solid #ddd;
                        text-align: center;
                        font-size: 16px;
                    }

                    .t_table th {
                        background-color: darkblue;
                        color: #ffffff;
                    }

                    .t_table tbody tr:nth-child(even) {
                        background-color: #f5f5f5;
                    }

                    #up_btn {
                        width: 90px;
                        background-color: darkblue;
                        color: white;
                        outline: none;
                        height: 30px;
                        border-radius: 5px;
                        box-shadow: 0 10px 10px rgba(0, 0, 0, 0.2);
                        margin-right: 2px;

                    }
                    #v_btn {
                        width: 90px;
                        background-color: darkblue;
                        color: white;
                        outline: none;
                        height: 30px;
                        border-radius: 5px;
                        box-shadow: 0 10px 10px rgba(0, 0, 0, 0.2);
                        margin-right: 2px;

                    }

                    #del_btn {
                        width: 90px;
                        background-color: darkred;
                        color: white;
                        outline: none;
                        height: 30px;
                        border-radius: 5px;
                        box-shadow: 0 10px 10px rgba(0, 0, 0, 0.2);


                    }








                    /*responsive*/


                    @media(max-width: 500px) {
                        .t_table thead {
                            display: none;
                        }

                        .t_table,
                        .t_table tbody,
                        .t_table tr,
                        .t_table td {
                            display: block;
                            width: 100%;
                            overflow: auto;
                        }

                        .t_table tr {
                            margin-bottom: 15px;
                        }


                        .t_table td {
                            text-align: right;
                            padding-left: 50%;
                            text-align: right;
                            position: relative;
                        }

                        .t_table td::before {
                            content: attr(data-label);
                            position: absolute;
                            left: 0;
                            width: 50%;
                            padding-left: 15px;
                            font-size: 15px;
                            font-weight: bold;
                            text-align: left;
                        }
                    }
    </style>
    <title>Employee</title>
</head>

<body>
    <div class="containers">




<section class="sidebar" id="sidebar">
  <nav id="side">


       <!-- <i class="fas fa-solid fa-xmark" id="closesidemenu" onclick="closesidemenu()" class="sidemenuicon"></i> -->

       <!-- <img src="./icons/close.svg" class="fas sidemenuicon" id="closesidemenu" onclick="closesidemenu()" alt=""> -->

       <!-- Specifix designation lai specific option dekhauna ko lagi -->
       <ul>
                                    <?php
                            echo '

                            <li>
                                <a href="#" class="logo">

                                    <span class="nav-item"> Hi, ' . $_SESSION['name'] . '</span>
                                </a>
                            </li>';


                            echo '

                            <li>
                                <a href="dashboard.php">
                                    <!-- <i class="fas fa-solid fa-house"></i> -->
                                    <img src="icons/home_icon.svg" class="fas" alt="">
                                    <span class="nav-item">Home</span>
                                </a>
                            </li>
                            ';

                            if ($_SESSION['designation'] == 'Admin') {

                                echo '

                            <li>
                                <a href="OP1_manageemployee.php">
                                    <!-- <i class="fas fa-solid fa-plus-minus"></i> -->
                                    <img src="icons/plus.svg" class="fas" alt="">
                                    <span class="nav-item">Manage Employee</span>
                                </a>
                            </li>
                            ';
                            echo '

                                <li>
                                    <a href="OP11_viewinventory.php">
                                        <!-- <i class="fas fa-solid fa-eye"></i> -->
                                        <img src="icons/view.svg" class="fas" alt="">
                                        <span class="nav-item">View Inventory</span>
                                    </a>
                                </li>
                                ';

                            }
                            if ($_SESSION['designation'] == 'Pharmacist') {


                                echo '

                                <li>
                                    <a href="OP5_ViewEmployee.php">
                                        <!-- <i class="fas fa-solid fa-eye"></i> -->
                                        <img src="icons/view.svg" class="fas" alt="">
                                        <span class="nav-item">View Employee</span>
                                    </a>
                                </li>
                                ';
                            }




                            if ($_SESSION['designation'] == 'Pharmacist') {
                                echo '

                                <li>
                                    <a href="OP6_manageinventory.php">
                                        <!-- <i class="fas fa-solid fa-plus-minus"></i> -->
                                        <img src="icons/plus.svg" class="fas" alt="">
                                        <span class="nav-item">Manage Inventory</span>
                                    </a>
                                </li>
                                ';
                            }









                            if ($_SESSION['designation'] == 'Pharmacist') {
                                echo '

                            <li>
                                <a href="OP13_managesupp.php">
                                    <!-- <i class="fas fa-solid fa-plus-minus"></i> -->
                                    <img src="icons/plus.svg" class="fas" alt="">
                                    <span class="nav-item">Manage Supplier</span>
                                </a>
                            </li>
                            ';
                            }


                            if ($_SESSION['designation'] == 'Admin') {

                                echo '

                            <li>
                                <a href="OP18_viewsupp.php">
                                    <!-- <i class="fas fa-solid fa-eye"></i> -->
                                    <img src="icons/view.svg" class="fas" alt="">
                                    <span class="nav-item">View Supplier</span>
                                </a>
                            </li>
                            ';
                            }
                            echo '

                            <li>
                                <a href="notepad.php">
                                    <!-- <i class="fas fa-solid fa-right-from-bracket"></i> -->
                                    <img src="icons/info.svg" class="fas" alt="">
                                    <span class="nav-item">Notepad</span>
                                </a>
                            </li>
                            ';
                           

                                        if ($_SESSION['designation'] == 'Pharmacist') {
                                            echo '

                                                    <!-- Dark Mode  -->
                                                    <li>
                                                        <a href="OP20_Leave_Req.php" class="mode" id="icon">
                                                            <!-- <i class="fas fa-solid fa-right-from-bracket"></i> -->
                                                            <img src="icons/leave.svg" class="fas" alt="" id="icon_logo">
                                                            <span class="nav-item">Request leave</span>
                                                        </a>
                                                    </li>
                                                    ';
                                                    }

                                                    if ($_SESSION['designation'] == 'Admin') {
                                                        echo '

                                                                <!-- Dark Mode  -->
                                                                <li>
                                                                    <a href="OP21_manageleave.php" class="mode" id="icon">
                                                                        <!-- <i class="fas fa-solid fa-right-from-bracket"></i> -->
                                                                        <img src="icons/leave.svg" class="fas" alt="" id="icon_logo">
                                                                        <span class="nav-item">Leave Requests</span>
                                                                    </a>
                                                                </li>
                                                                ';
                                                                }

                            echo '

                            <li>
                                <a href="logout.php" class="logout">
                                    <!-- <i class="fas fa-solid fa-right-from-bracket"></i> -->
                                    <img src="icons/logout.svg" class="fas" alt="">
                                    <span class="nav-item">Logout</span>
                                </a>
                            </li>
                            ';





                             ?>
                </ul>
   </nav>
</section>

        <!-- Main Section / Table Section -->




        <section class="main" id="main">
            <!-- <i class="fa-solid fa-bars" id="opensidemenu" onclick="opensidemenu()" class="sidemenuicon"></i> -->
            <!-- <img src="menu.svg" id="opensidemenu" onclick="opensidemenu()" class="fas sidemenuicon" alt=""> -->
            <div class="side_btn">
                            <img src="icons/menu.svg" class="side_btn" id="opensidemenu" onclick="opensidemenu()" class="fas sidemenuicon" alt="">
                        </div>
            <div class="main-top">
                <h1>Employee Section</h1>

                                    <div class="modal" id="profilemodal">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="text-primary">Your Profile</h3>
                                                    <button type="button" class="close " data-dismiss="modal">&times;</button>

                                                </div>

                                                <!-- Importing Details for modal informat -->
                                                <?php
                                                if ($_SESSION['designation'] == 'Admin'){
                                                $sql_modal="SELECT * FROM `admin` WHERE `id` = $modalid";
                                                $result_modal=mysqli_query($con,$sql_modal);
                                                }
                                                if ($_SESSION['designation'] == 'Pharmacist'){
                                                    $sql_modal="SELECT * FROM `pharmacist` WHERE `id` = $modalid";
                                                    $result_modal=mysqli_query($con,$sql_modal);
                                                    }

                                                while($row_modal=mysqli_fetch_assoc($result_modal)){
                                                    $modal_name=$row_modal['name'];
                                                    $modal_email=$row_modal['email'];
                                                    $modal_phone=$row_modal['phone'];
                                                    $modal_taddreaa=$row_modal['temporary_address'];
                                                    $modal_paddress=$row_modal['permanent_address'];
                                                    $modal_designation=$row_modal['designation'];
                                                    $modal_profilepic=$row_modal['profile_photo'];



                                            ?>


                                                <div class="modal-body">
                                                    <form action="dashboard.php" method="POST" enctype="multipart/form-data">

                                                        <div class=" form-group mb-3">

                                                            <img src="<?php echo 'uploads/'. $row_modal['profile_photo'] ; ?>"
                                                                id="profile-pic" srcset="" class="rounded-circle mb-3 mx-auto d-block"
                                                                alt="Profile_picture" width="500" height="500">
                                                            <!-- <p><?php echo  $row_modal['profile_photo'] ; ?></p> -->
                                                        </div>

                                                        <?php
                                                                 }

                                                        ?>
                                                        <div class="form-group">
                                                            <label for="email">Name:</label>
                                                            <input type="text" value="<?php echo $modal_name  ?>" name="u_email"
                                                                class="form-control" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email">Email:</label>
                                                            <input type="text" value="<?php echo $modal_email  ?>" name="u_email"
                                                                class="form-control" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email">Phone:</label>
                                                            <input type="text" value="<?php echo $modal_phone  ?>" name="u_phone"
                                                                class="form-control" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email">Permanent Address:</label>
                                                            <input type="text" value="<?php echo $modal_paddress  ?>" name="u_paddress"
                                                                class="form-control" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email">Temporary Address:</label>
                                                            <input type="text" value="<?php echo $modal_taddreaa ?>" name="u_taddredd"
                                                                class="form-control" readonly>
                                                        </div>
                                                        <div class="form-group border-bottom-4">
                                                            <label for="email">Designation:</label>
                                                            <input type="text" value="<?php echo $modal_designation  ?>"
                                                                name="u_designation" class="form-control" readonly>
                                                        </div>


                                                        <div class="form-group">
                                                            <label for="">Change Profile Photo:</label>

                                                            <input type="file" name="file" id="" class="inputelem form-control"> <br>


                                                        </div>
                                                        <div class="form-group">
                                                            <button type="submit" name="profilepic_change"
                                                                class="btn btn-info">Change</button>


                                                        </div>



                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
            </div>

            <a href="OP2_adduser.php"><button id="Add_btn">Add User</button></a>

            <div class="t_users">
                <table class="t_table" id="crud_table">
                    <thead>
                        <th>S.N</th>
                        <th>Name</th>
                        <th>Date Of Birth</th>
                        <th>Gender</th>
                        <th>Age</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Permanent Address</th>
                        <th>Temporary Address</th>
                        <th>Designation</th>
                      
                        <th>Operations</th>
                    </thead>
                    <tbody>

                        <?php

                        $sql = "SELECT * FROM `admin`";
                        $result = mysqli_query($con, $sql);
                        $count1 = 1;
                        while ($row = mysqli_fetch_assoc($result)) {

                            $id = $row['id'];
                            $name = $row['name'];
                            $gender = $row['gender'];

                            $dob = $row['dob'];
                            $phone = $row['phone'];
                            $email = $row['email'];
                            $permanent_address = $row['permanent_address'];
                            $temporary_address = $row['temporary_address'];

                            $designation = $row['designation'];



                            $age = (date('Y') - date('Y', strtotime($dob)));



                            // =========== Important Is Here=========
                            // =====================================





                            //Print Imported Data
                            echo '
                        <tr>
                            <td data-label="S.N">' . $count1 . '</td>
                            <td data-label="name">' . $name . '</td>


                            <td data-label="dob">' . $dob . '</td>

                            <td data-label="gender">' . $gender . '</td>
                            <td data-label="age">' . $age . '</td>

                            <td data-label="Email">' . $email . '</td>
                            <td data-label="Pnone Number">' . $phone . '</td>
                            <td data-label="Permanent_Address">' . $permanent_address . '</td>
                            <td data-label="Temporary_Address">' . $temporary_address . '</td>
                            <td data-label="designation">' . $designation . '</td>
                           

                            <td data-label="Operations"><a href="OP3_updateemployee.php?updatedesignation=' . $designation . '&updateid=' . $id . '"><button id="up_btn">Update</button></a>
                             <a href="OP4_deleteemployee.php?deleteid=' . $id . '&deletedesignation=' . $designation . '"><button id="del_btn">Delete</button></a></td>
                        </tr>';
                            $count1++;
                        }
                        ?>



                        <!-- ====================================================
                    =============================For Pharmacist Display=========-->

                        <?php
                        $sql = "SELECT * FROM `pharmacist`";
                        $result = mysqli_query($con, $sql);
                        $count2 = $count1;
                        while ($row = mysqli_fetch_assoc($result)) {

                            $id = $row['id'];
                            $name = $row['name'];
                            $dob = $row['dob'];
                            $gender = $row['gender'];
                            $phone = $row['phone'];
                            $email = $row['email'];
                            $permanent_address = $row['permanent_address'];
                            $temporary_address = $row['temporary_address'];

                            $designation = $row['designation'];






                            $age = (date('Y') - date('Y', strtotime($dob)));
                            // =========== Important Is Here=========
                            // =====================================





                            //Print Imported Data
                            echo '
                        <tr>
                            <td data-label="S.N">' . $count2 . '</td>
                            <td data-label="name">' . $name . '</td>


                            <td data-label="dob">' . $dob . '</td>

                            <td data-label="gender">' . $gender . '</td>
                            <td data-label="age">' . $age . '</td>

                            <td data-label="Email">' . $email . '</td>
                            <td data-label="Pnone Number">' . $phone . '</td>
                            <td data-label="Permanent_Address">' . $permanent_address . '</td>
                            <td data-label="Temporary_Address">' . $temporary_address . '</td>
                            <td data-label="designation">' . $designation . '</td>
                          

                            <td data-label="Operations">
                                <a href="OP3_updateemployee.php?updatedesignation=' . $designation . '&updateid=' . $id . '"><button id="up_btn">Update</button></a>
                                <a href="OP4_deleteemployee.php?deletedesignation=' . $designation . '&deleteid=' . $id . '"><button id="del_btn">Delete</button></a>
                            </td>
                        </tr>';
                            $count2++;
                        }
                        ?>





                    </tbody>
                </table>
            </div>




        </section>




    </div>

    <script src="JS/jquery.js"></script>
    <script src="JS/jquery.dataTables.min.js"></script>
    <script src="JS/Script.js"></script>
    <script>
        $(document).ready( function () {
    $('#crud_table').DataTable();
} );
    </script>
</body>

</html>
