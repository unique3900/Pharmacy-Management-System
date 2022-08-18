<?php

$loginstatus = false;
include "./Connection/dbcon.php";


//Step1: Details line paila form bata
if (isset($_POST["login_req"])) {
    $login_email = $_POST["login_email"];
    $login_password = $_POST["login_password"];
    $login_designation = $_POST["login_designation"];



    //Step 2: Desognation Wise login garaune vayera condition check garne
    if ($login_designation == 'Admin') {


        $sql2 = "SELECT * FROM `admin`";
        $result2 = mysqli_query($con, $sql2);
         while ($row = mysqli_fetch_assoc($result2)) {

        $name = $row['name'];
        $db_uid=$row['id'];
        $db_email=$row['email'];

         }

         $sql = "SELECT * FROM `admin` WHERE `email` LIKE '$login_email'";
         $result = mysqli_query($con, $sql);


        //Step 3:Database ma kati ota admin cha count garne
        $count = mysqli_num_rows($result);
        if ($count == 1) {
            //Step 4: Vaidate password by decrypting it
            while ($row = mysqli_fetch_assoc($result)) {
                if (password_verify($login_password, $row['password'])) {
                    $loginstatus = true;
                    session_start();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['designation'] = $login_designation;
                    $_SESSION['name']=$row['name'];
                    $_SESSION['id']=$row['id'];
                    $_SESSION['email']=$row['email'];

                    header('location:dashboard.php');
                }
                else{
                    echo "<script>alert('Incorrect Password')</script>";
                }
            }
        } else {
            echo "<script>alert('no user Found')</script>";
        }
    }

    //Step 6:Checking if the request is for Pharmacist
    if ($login_designation == 'Pharmacist') {




        $sql2 = "SELECT * FROM `pharmacist`";
        $result2 = mysqli_query($con, $sql2);
         while ($row = mysqli_fetch_assoc($result2)) {

            $name = $row['name'];
            $db_uid=$row['id'];
            $db_email=$row['email'];
        

         }

        $sql = "SELECT * FROM `pharmacist` WHERE `email` LIKE '$login_email'";
        $result = mysqli_query($con, $sql);

        //Step 3:Database ma kati ota admin cha count garne
        $count = mysqli_num_rows($result);
        if ($count == 1) {
            //Step 4: Vaidate password by decrypting it
            while ($row = mysqli_fetch_assoc($result)) {
                if (password_verify($login_password, $row['password'])) {
                            $loginstatus = true;
                            session_start();
                            $_SESSION['loggedin'] = true;
                            $_SESSION['designation'] = $login_designation;
                            $_SESSION['name']=$row['name'];
                            $_SESSION['id']=$row['id'];
                            $_SESSION['email']=$row['email'];

                            header('location:dashboard.php');
                    
                    
                    
                }
                else{
                    echo "<script>alert('Incorrect Password')</script>";
                }
            }
        } else {
            echo "<script>alert('no user Found')</script>";
        }
    }
}







?>








<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
    <title>Login</title>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/loginpage.css">
    <!-- <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        .login-main-form {
            width: 100vw;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
            background: linear-gradient(135deg, #00c354, #049c41);
        }

        .login-form-container {
            height: 600px;
            max-height: 700px;
            margin-top: 10px;
            max-width: 700px;
            width: 100%;
            background-color: #fff;
            padding: 25px 30px;
            border-radius: 5px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
        }

        .login-form-container .title {
            text-align: center;
            font-size: 35px;
            font-weight: bold;
            position: relative;
        }

        .login-form-content form .login-user-details {
            display: flex;
            flex-direction: column;
            flex-wrap: wrap;
            width: 100%;
            justify-content: space-between;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        .login-user-details .login-input-box {
            position: relative;
            margin-bottom: 20px;
            /* 50%-20 px auto adjust garna help garcha */
            width: calc(100% - 20px);
        }

         .login-input-box input,
        select {
            height: 45px;
            width: 100%;
            outline: none;
            font-size: 16px;
            border-radius: 5px;
            padding-left: 15px;
            border: 1px solid #ccc;
            border-bottom-width: 2px;
            transition: all 0.3s ease;
        }

        #designation {
            outline: none;
            margin-top: 2px;
            padding: 5px;
        }

        .login-form-content form #login_btn {
            margin: 35px 0;
            height: 60px;
            width: 100%;
            border-radius: 5px;
            border: none;
            color: #fff;
            font-size: 18px;
            font-weight: 500;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: linear-gradient(135deg, #5df7be, #2ae233);
        }

        .login-form-content form #login_btn:hover {
            background: linear-gradient(-135deg, #5df7be, #7df483);
        }

        #pharm_title {
            padding: 10px;
            text-align: center;
            color: silver;
            margin-bottom: 15px;
            border-bottom: 1px solid black;
        }


        /* Yo chai display ko size anusar adjust gareko attribute taki responsive hoss hamro form */
        @media(max-width: 590px) {
            .login-form-container {
                max-width: 100%;

            }

            .login-form-content form .login-user-details .input-box {
                margin-bottom: 15px;
                width: 100%;
            }

            .login-content form .user-details {
                max-height: 300px;
                overflow-y: auto;
            }

            .login-user-details::-webkit-scrollbar {
                width: 5px;
            }
        }

        @media(max-width: 470px) {
            .login-form-container {
                overflow-y: auto;
                flex-direction: column;
            }
        }
    </style> -->
</head>

<body>
    <div class="login-main">
        <div class="login-form-container">
            <h1 id="pharm_title">Pharmacy Management System</h1>
            <div class="login-title">User Login</div>
            <div class="login-form-content">
                <form action="index.php" method="POST">
                    <div class="login-user-details">
                        <div class="login-input-box">
                            <span class="login-details">Email</span>
                            <input type="email" name="login_email" id="add_email" placeholder="Enter Email Address" required>
                        </div>
                        <div class="login-input-box">
                            <span class="login-details">Password</span>
                            <input type="password" name="login_password" id="add_password" placeholder="Enter Password" required>
                        </div>
                    </div>

                    <div class="login-form-designation">
                        <span class="login-details">Designation</span>
                        <select name="login_designation" id="login-designation">
                            <optgroup label="Select Post">
                                <option value="Admin">Admin</option>
                                <option value="Pharmacist">Pharmacist</option>
                            </optgroup>
                        </select>
                    </div>

                    <div class="login-button">
                        <button id="login-btn" value="Add User" name="login_req">Login</button>

                    </div>
                </form>
            </div>
        </div>
    </div>


</body>

</html>
