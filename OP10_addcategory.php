<?php
        include "./Connection/dbcon.php";
        session_start();
        if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
            header("location: index.php");
            exit;
        }

        if (isset($_POST['submit'])) {
            $category_name = $_POST['med_category'];

            $sql = "SELECT * FROM `medicine_type` WHERE `type` LIKE '$category_name'";
            $result = mysqli_query($con, $sql);

            $count = mysqli_num_rows($result);
            if ($count > 0) {
                echo "<script>alert('Category Already Exist')</script>";
            }
            else{
                $sql="INSERT INTO `medicine_type` (`type`) VALUES ( '$category_name')";
                $result = mysqli_query($con, $sql);
                if (!$result) {
                    echo "<script>alert('Somethin Went Wrong')</script>";
                }
                else{
                    header('location:OP6_manageinventory.php');
                }

            }
        }


?>



<html lang="en" dir="ltr">

<head>
    <title>Add Category</title>
    <meta charset="UTF-8">

    <!-- <link rel="stylesheet" href="style.css"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        /* Main.form vaneko hamile document ko body ko rup ma maneko so height ra width full rakheko */
        .add_main-form {
            width: 100vw;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
            background: linear-gradient(135deg, #00c354, #049c41);
        }

        .add-form-container {
            height: 300px;
            margin-top: 10px;
            max-width: 800px;
            width: 100%;
            background-color: #fff;
            padding: 25px 30px;
            border-radius: 5px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
        }

        .add-form-container .title {
            text-align: center;
            font-size: 35px;
            font-weight: bold;
            position: relative;
        }

        .add-form-container .form-content form .user-details {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        .add-form-container form .user-details .input-box {
            margin-bottom: 20px;
            /* 50%-20 px auto adjust garna help garcha */
            width: 100%;
        }

        .add-form-container form .input-box span.details {
            display: block;
            font-weight: 500;
            margin-bottom: 5px;
        }

        .add-form-container .user-details .input-box input,
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

        .add-form-container form .gender-details .gender-title {
            font-size: 20px;
            font-weight: 500;
        }

        /* Yo Rakhena Vane row ma aaucha so flex and space between rakhne */
        .add-form-container form .category {
            display: flex;
            width: 80%;
            margin: 14px 0;
            justify-content: space-between;
        }

        .add-form-container form .category label {
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .add-form-container form .category label .dot {
            height: 18px;
            width: 18px;
            border-radius: 50%;
            margin-right: 10px;
            background: #d9d9d9;
            border: 6px solid transparent;
            transition: all 0.3s ease;
            margin-bottom: 5px;
        }

        /* Yesle gard chai yedi radio button ma check vayo vane background color green aaucha ra border ma white huncha */
        #dot-1:checked~.category label .one,
        #dot-2:checked~.category label .two,
        #dot-3:checked~.category label .three {
            background: #62f1a0;
            border-color: #d9d9d9;
        }

        /* Hamile Khas ma radio button use garirako chainam .. dot vanne span tag lai 50% border-radius deyera circular check box jasto banairako cham....so no need of the radip button */
        .add-form-container form input[type="radio"] {
            display: none;
        }

        .add-form-container #designation {
            outline: none;
            margin-top: 2px;
            padding: 5px;
        }

        .add-form-container form #add_user_btn {
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

        .form-designation {
            margin-top: 10px;
        }


        /* Just reverse garideyeko - value deyera */
        .add-form-container form #add_user_btn:hover {
            background: linear-gradient(-135deg, #5df7be, #7df483);
        }

        /* Yo chai display ko size anusar adjust gareko attribute taki responsive hoss hamro form */
        @media(max-width: 590px) {
            .add-form-container {
                max-width: 100%;

            }

            .add-form-container form .user-details .input-box {
                margin-bottom: 15px;
                width: 100%;
            }

            .add-form-container form .category {
                width: 100%;
            }

            /* Y axix ma chai scroll garna milne huncha overflow rokcha */
            .add-form-container .content form .user-details {
                max-height: 300px;
                overflow-y: auto;
            }

            .add-form-container .user-details::-webkit-scrollbar {
                width: 5px;
            }
        }

        /* Jaba sisplay size less than 459 huncha tetibela row ma haina ki column ko rup ma display huncha.....helps to avoid overflow */
        @media(max-width: 470px) {
            .add-form-container {
                overflow-y: auto;
                flex-direction: column;
            }

            /* .form-container .title{
      display: none;
             } */
            .add-form-container .form-content .category {
                flex-direction: column;
                overflow: auto;
            }
        }
    </style>
</head>

<body>
    <div class="add_main-form">
        <div class="add-form-container">
            <div class="title">Add Category</div>
            <div class="form-content">
                <form action="OP10_addcategory.php" method="POST">
                    <div class="user-details">
                        <div class="input-box">
                            <span class="details">Enter Category</span>
                            <input type="text" placeholder="Enter a valid Category" name="med_category" id="add_name">

                        </div>
                    </div>

                    <div class="button">
                        <!-- <button id="add_user_btn" name="submit" value="Add User" onclick="validateform()">Submit</button> -->
                        <button type="submit" id="add_user_btn" name="submit" value="Add Category">Submit</button>

                    </div>

                </form>
            </div>
        </div>
    </div>



</body>

</html>