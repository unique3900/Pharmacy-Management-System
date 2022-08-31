<?php
include "./Connection/dbcon.php";
// session_start();
include("sidebar.php");
            if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
                header("location: index.php");
                exit;
            }
    $modalid=$_SESSION['id'];

// SELECT MONTHNAME(date) as mname, sum(total_sale) as total FROM sale_record GROUP BY MONTH(date);



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
        <!-- <link rel="stylesheet" href="CSS/style.css"> -->

        <script src="../JS/Script.js"></script>
        <link rel="stylesheet" href="CSS/jquery.dataTables.min.css">
        <style>
        * {
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
        .containerr #sidebar {
            align-items: center;
            position: fixed;
            top: 0;
            bottom: 0;
            height: 100vh;
            left: 0;
            width: 280px;
            background-image: linear-gradient(to right top, #a4ffb5, #90ffb0, #77ffac, #56ffa9, #11ffa7);
            border-radius: 0.5rem;
            transition: 0.6s;
            overflow-x: hidden;
            z-index: 1;

            box-shadow: 0 20px 35px rgba(0, 0, 0, 0.1);
        }

        #sidebar.hide {
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

        .pwd_change {
            position: absolute;
            bottom: 150px
        }

        .logout {
            position: absolute;
            bottom: 100px;

        }

        .containerr {
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

        #sidebar.hide~#main {
            width: calc(100% - 10px);
            left: 10px;
        }

        #profile-pic {

            height: 160px;
            width: 160px;


        }







        /* Main Section Where Display garincha */
        .main {
            position: relative;
            padding: 20px;
            width: calc(100% - 280px);
            left: 280px;
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

        .users .cards {
            display: inline-block;
            overflow-x: auto;
            overflow-y: auto;
            /* max-height:600px; */
            /* width: 35%; */
            flex: 1 1 200px;
            /* Jaba DIsplay Ko size Ghatcha Taba Auto Matically cardsa ko size adjust huncha (flex-grow,shrink and width */
            margin: 10px;
            background-image: linear-gradient(to right top, #a4ffb5, #90ffb0, #77ffac, #56ffa9, #11ffa7);

            text-align: center;
            border-radius: 10px;
            padding: 10px;
            box-shadow: 0 20px 35px rgba(0, 0, 0, 0.1);
        }

        .users .cards img {
            width: 100px;
            height: 80px;
            border-radius: 25%;
            margin-bottom: 25px;
        }

        .users .cards h4 {
            margin-bottom: 5px;
            color: black;
            font-size: 30px;
            text-transform: uppercase;
            text-align: center;
        }



        .users table {
            margin: auto;
        }

        .users .per span {
            color: red;

            padding: 5px;
            font-size: 35px;
            font-weight: bold;

            /* background: rgb(255, 255, 250); */
        }

        .users .per p {
            color: green;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 15px;
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

        .users .cards #btn_view {
            position: relative;
            width: 130px;
            height: 45px;
            background-color: var(--primary-color);
            color: var(--text-color1);
            margin-top: 15px;
            background: var(--primary-color);
            border-radius: 10px;
        }

        .users .cards a:hover {
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

        .main-button {
            text-align: center;
        }

        .monthly-table {

            padding: 10px;
            width: 100%;
            border-collapse: collapse;

        }

        .monthly-table td,
        .monthly-table th {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: center;
            font-size: 23px;
        }

        .monthly-table th {
            background-color: darkblue;
            color: white;
        }

        .monthly-table tr {
            color: var(--text-color1);
        }

        .monthly-table tbody tr:nth-child(even) {
            background-color: var(--secondary-color2);
        }

        @media(max-width: 500px) {
            .monthly-table thead {
                display: none;
            }

            .monthly-table,
            .monthly-table tbody,
            .monthly-table tr,
            .monthly-table td {
                display: block;
                width: 100%;
                overflow: auto;
            }

            .monthly-table tr {
                margin-bottom: 15px;
            }

            .monthly-table td {
                text-align: right;
                padding-left: 50%;
                text-align: right;
                position: relative;
            }

            .monthly-table::before {
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
        <title>Dashboard</title>
    </head>

    <body>
        <div class="containerr">



            <!-- Main Section / Dashboard Section -->

            <section class="sidebar" id="sidebar">
                <nav id="side">


                    <!-- <i class="fas fa-solid fa-xmark" id="closesidemenu" onclick="closesidemenu()" class="sidemenuicon"></i> -->

                    <!-- <img src="./icons/close.svg" class="fas sidemenuicon" id="closesidemenu" onclick="closesidemenu()" alt=""> -->

                    <!-- Specifix designation lai specific option dekhauna ko lagi -->

                    <ul>
                        <?php
                            echo '

                            <li>
                           
                            <a href="#" class="">

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
                            echo '

                                        <li>
                                            <a href="OP19_change_Password.php?updatedesignation=' . $_SESSION['designation'] . '&updateid=' . $_SESSION['id']  . '" class="pwd_change">
                                                <!-- <i class="fas fa-solid fa-right-from-bracket"></i> -->
                                                <img src="icons/password.svg" class="fas" alt="">
                                                <span class="nav-item">Change Password</span>
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

            <section class="main" id="main">


                <!-- <i class="fa-solid fa-bars" id="opensidemenu" onclick="opensidemenu()" class="sidemenuicon"></i> -->
                <div class="side_btn">
                    <img src="icons/menu.svg" class="side_btn" id="opensidemenu">
                </div>


                <!-- Your Profile Button -->


                <div class="main-top">
                    <h1>Dashboard</h1>


                    <!-- Modal For View Profile of the Current User -->




                    <button type="button" class="btn btn-primary my-3" data-target="#profilemodal"
                        data-toggle="modal">View Profile</button>


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
                                    
                                }

                            ?>


                                <div class="modal-body">
                                    <form action="changeprofilepic.php" method="POST">

                                        <div class=" form-group mb-3">

                                            <img src="profile_uploads/my pic.jpg" id="profile-pic" srcset=""
                                                class="rounded-circle mb-3 mx-auto d-block" alt="Profile_picture" width="500" height="500">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Name:</label>
                                            <input type="text" value="<?php echo $modal_name  ?>" name="u_email"
                                                class="form-control" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email:</label>
                                            <input type="text"    value="<?php echo $modal_email  ?>"   name="u_email" class="form-control" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Phone:</label>
                                            <input type="text"   value="<?php echo $modal_phone  ?>"  name="u_phone" class="form-control" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Permanent Address:</label>
                                            <input type="text"   value="<?php echo $modal_paddress  ?>"  name="u_paddress" class="form-control" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Temporary Address:</label>
                                            <input type="text"    value="<?php echo $modal_taddreaa ?>" name="u_taddredd" class="form-control" readonly>
                                        </div>
                                        <div class="form-group border-bottom-4">
                                            <label for="email">Designation:</label>
                                            <input type="text"   value="<?php echo $modal_designation  ?>"  name="u_designation" class="form-control" readonly>
                                        </div>
                              

                                        <div class="form-group">
                                            <label for="">Change Profile Photo:</label>
                                            <input type="file" name="u_profilechange" class="form-control">

                                            
                                        </div>
                                        <div class="form-group">
                                        <button type="submit" name="profilepic_change" class="btn btn-info">Change</button>

                                            
                                        </div>
                                       


                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="users">
                    <div class="cards">
                        <img src="icons/medicine.png" alt="">
                        <h4>Medicine</h4>
                        <div class="per">
                            <table>
                                <tr>
                                    <td><span>
                                            <p>Total Available Medicine</p>
                                            <?php
                                            $sql = "SELECT id FROM `medicine_record` ORDER BY id";
                                            $result = mysqli_query($con,$sql);
                                            $row = mysqli_num_rows($result);
                                            echo $row ." Types";        
                                        ?>
                                        </span></td>
                                </tr>

                                <tr>
                                    <td> <span>
                                            <p>Total Expired Medicine</p>
                                            <?php
                                                    $today_date = date("Y/m/d");
                                            $sql = "SELECT * FROM medicine_record WHERE expiry_date<CURDATE()";
                                            $result = mysqli_query($con,$sql);
                                            $row = mysqli_num_rows($result);
                                            echo $row  ." Types"; 
                                         ?>
                                        </span></td>

                                </tr>
                                <tr>
                                    <td><span>
                                            <p>Medicine Out of Stock</p>
                                            <?php
                                                $sqll = "SELECT * FROM medicine_record WHERE remaining_quantity=0";
                                                $result = mysqli_query($con,$sqll);
                                                $row = mysqli_num_rows($result);
                                                    echo $row ." Types";  
                                         ?>
                                        </span></td>

                                </tr>

                            </table>
                        </div>
                        <!-- <a href="#"><button id="btn_view">View More Details</button></a> -->
                    </div>

                    <div class="cards">
                        <img src="icons/employees.png" alt="">
                        <h4>Employees</h4>

                        <div class="per">
                            <table>
                                <tr>
                                    <td><span>
                                            <p>Total Employees</p><?php
                                   $sql = "SELECT id FROM `admin` ORDER BY id";
                                   $result1 = mysqli_query($con,$sql);
                                   $row1 = mysqli_num_rows($result1);

                                   $sql1 = "SELECT id FROM `pharmacist` ORDER BY id";
                                   $result2 = mysqli_query($con,$sql1);
                                   $row2 = mysqli_num_rows($result2);
                                     echo $row1+$row2 ." People" ;  ?>
                                        </span></td>



                                </tr>
                                <tr>
                                    <td><span>
                                            <p>Total Admin</p><?php
                                 $sql = "SELECT id FROM `admin` ORDER BY id";
                                 $result1 = mysqli_query($con,$sql);
                                 $row1 = mysqli_num_rows($result1);
                                 echo $row1 ." People" ; ?>
                                        </span></td>
                                </tr>

                                <tr>
                                    <td><span>
                                            <p>Total Pharmacist</p><?php
                                            $sql = "SELECT id FROM `pharmacist` ORDER BY id";
                                            $result1 = mysqli_query($con,$sql);
                                            $row = mysqli_num_rows($result1);
                                            echo $row ." People"; ?>
                                        </span></td>
                                </tr>

                            </table>
                        </div>
                        <!-- <a href="OP11_viewinventory.php"><button id="btn_view">View More Details</button></a> -->
                    </div>

                    <div class="cards">
                        <img src="icons/supply.png" alt="">
                        <h4>Suppliers</h4>
                        <div class="per">



                            <table>
                                <tr>
                                    <td><span>
                                            <p>Total Suppliers</p>
                                            <?php
                                            $sql = "SELECT * FROM `supp_record` ";
                                            $result = mysqli_query($con,$sql);
                                            $row = mysqli_num_rows($result);
                                            echo $row ." People" ;        
                                    ?>
                                        </span></td>

                                </tr>
                                <tr>
                                    <td><span>
                                            <p>Total Pending payment</p><?php
                                 $sql = "SELECT SUM(pending_payment) as value_sum FROM `medicine_record`;";
                                 $result1 = mysqli_query($con,$sql);
                                 $row = mysqli_fetch_array($result1);
                                 echo "NRS.".  $row['value_sum']."/-";
                                ?>
                                        </span></td>
                                </tr>


                            </table>
                            <!-- <a href="OP18_viewsupp.php"><button id="btn_view">View More Details</button></a> -->
                        </div>
                    </div>
                </div>








                <!-- <i class="fa-solid fa-bars" id="opensidemenu" onclick="opensidemenu()" class="sidemenuicon"></i> -->
                <div class="main-button">
                    <h1>Sales Record</h1>
                </div>



                <div class="monthsummary">
                    <table class="monthly-table">

                        <!-- Month Wise To total Sum Garera Import garna lageko -->



                        <thead>

                            <th>Month</th>
                            <th>Total Sale</th>
                            <th>Profit/Loss</th>


                        </thead>
                        <tbody>


                            <?php
                    $sql="SELECT MONTHNAME(date) as mname,YEAR(date) as yname, sum(total_sale) as total, sum(profit_on_sale) as profit FROM sale_record GROUP BY MONTH(date) ";
                          $result=mysqli_query($con,$sql);


                         while($row=mysqli_fetch_assoc($result)){
                            $yearname=$row['yname'];
                             $month_name=$row['mname'];
                             $total_sale=$row['total'];
                             $total_profit=$row['profit'];

                             echo '
                             <tr>

                                 <td data-label="m_name">' . $yearname. ' - ' . $month_name. '</td>
                                 <td data-label="total_sale">' . $total_sale. '</td>
                                 <td data-label="total_profit">' ."Rs.".  $total_profit. '</td>
                             </tr>
                             ';

                         }

                    ?>

                        </tbody>
                    </table>
                </div>

                <!-- My profile dialog Box Container Starts Here -->





            </section>
            <script src="JS/jquery.js"></script>
            <script src="JS/jquery.dataTables.min.js"></script>
            <script src="JS/Script.js"></script>
            <script>
            $(document).ready(function() {
                $('.monthly-table').DataTable();
            });
            </script>
            <script type="text/javascript">
            //toggle Sidebar
            const menuBar = document.querySelector('.side_btn');
            const sidebar = document.getElementById('sidebar');

            menuBar.addEventListener('click', function() {
                sidebar.classList.toggle('hide');
            })
            </script>
            <script src="JS/bootstrap.min.js"></script>
    </body>

</html>