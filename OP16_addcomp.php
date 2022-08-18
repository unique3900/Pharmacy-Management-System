<?php
            include "./Connection/dbcon.php";

            session_start();
            if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
                header("location: login.php");
                exit;
            }
            if (isset($_POST['submit'])) {
            $name=$_POST['comp_name'];
            // To check wheather the medicine is already exist
            $sql = "SELECT * FROM company_record WHERE name='$name'";
            $result = mysqli_query($con, $sql);
            $count = mysqli_num_rows($result);
            if ($count > 0) {
                    echo "<script>alert('Company  Already Exist')</script>";
                }
                else {
                    $sql="INSERT INTO `company_record` (`name`) VALUES('$name')";
                    $result=mysqli_query($con,$sql);
                        if ($result) {
                        echo "<script>alert('Company added successfully')</script>";
                            header('location:OP13_managesupp.php');
                            }
                        else {
                        die( mysqli_error($con));
                                }
                            }
                }
?>
<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
    <title>Add Company</title>
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
                    max-width: 500px;
                    width: 100%;
                    background-color: #fff;
                    padding: 25px 30px;
                    border-radius: 5px;
                    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
                }

                .add-form-container .title {
                    margin-bottom: 20px;
                    text-align: center;
                    font-size: 35px;
                    font-weight: bold;
                    position: relative;
                }

                .add-form-container .form-content form  {
                    display: flex;
                    flex-wrap: wrap;
                    justify-content: space-between;
                    margin-top: 30px;
                    margin-bottom: 10px;
                }

                .add-form-container form .user-details .input-box {
                    margin-bottom: 20px;
                    /* 50%-20 px auto adjust garna help garcha */
                    width: calc(100% / 2 - 20px);
                }

                .add-form-container form .input-box span.details {

                    display: block;
                    font-weight: 500;
                    margin-bottom: 5px;
                }
                .add-form-container .input-box input {
                    margin-top: 10px;
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




                .add-form-container  form  #add_user_btn {
                    margin: 40px 0;
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
                    .add-form-container  {

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
            <div class="title">Add Company</div>
                <form action="" method="POST">
                        <div class="input-box">
                            <span class="details">Companys Full Name</span>
                            <input type="text" placeholder="Enter Companys Full Name" name="comp_name" id="add_name" onkeyup="validateName()" required minlength="8">
                            <span id="nameErr"></span>
                        </div>

                    <div class="button">
                        <!-- <button id="add_user_btn" name="submit" value="Add User" onclick="validateform()">Submit</button> -->
                        <button type="submit" id="add_user_btn" name="submit" value="Add Supplser" onclick="validateform()">Submit</button>
                        <span id="submitErr"></span>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        var nameErr = document.getElementById('nameErr');


        function validateName() {
            var name = document.getElementById('add_name').value;

            if (name.length == 0) {
                nameErr.innerHTML = "*Required"
                return false;
            }
            
            nameErr.innerHTML = "Valid";
            return true;
        }




    </script>
</body>

</html>
