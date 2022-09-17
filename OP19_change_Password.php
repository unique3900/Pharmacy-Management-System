<?php       
    include "./Connection/dbcon.php";
    include("sidebar.php");

    $db_mail= $_SESSION['email'];

    // if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    //     header("location: index.php");
    //     exit;
    // } 
    $id = $_GET['updateid'];
    $designation = $_GET['updatedesignation'];

    if(isset($_POST['submit'])){
    //Getting forms input details
    $email=$_POST['email'];
    $old_password=$_POST['old_password'];
    $new_password=$_POST['new_password'];
    $confirm_password=$_POST['c_password'];

    
        if($new_password!=$confirm_password){
            echo "<script>alert('Confirm Password Doesnot Match')</script>";
        }
        else{
                        $sql = "SELECT * FROM `employee` WHERE `id` = $id";
                        $result = mysqli_query($con, $sql);
                        
                        $count = mysqli_num_rows($result);
                        if ($count == 1) {
                            while ($row = mysqli_fetch_assoc($result)){

                                //Check if users old password matches with database password
                            if(password_verify($old_password,$row['password'])){
                                $new_update_password=password_hash($new_password, PASSWORD_DEFAULT);

                                //Update password in database
                                $sql2="UPDATE `employee` SET `password` = '$new_update_password' WHERE `employee`.`id` = $id";
                                $result2 = mysqli_query($con, $sql2);
                                if($result2){
                                    echo "<script>alert('Password Changed Successfully')</script>";
                                    header('location:dashboard.php');
                                }

                            }
                            else{
                                echo "<script>alert('Old password doesnot match')</script>";
                            }
                            }  
                        }
                        else{
                            echo "<script>alert('Somethin Went Wrong')</script>";
                        }
                }
    

   

    }



?>


<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
    <title>Change Password</title>
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
            height: 140vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
            background: linear-gradient(135deg, #00c354, #049c41);
        }

        .add-form-container {
            height:550px;
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
            width: calc(100% / 2 - 20px);
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

        .tacbox {
            display:inline-block;
             padding: 1em;
             /* margin: 2em; */
            border: 3px solid #ddd;
             background-color: #F1EDED;

            max-width: 800px;
        }           

        .tacbox input {
            height: 2em;
            width: 5em;
            vertical-align: middle;
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
            <div class="title">Change password</div>
            <div class="form-content">
                <form  method="POST" enctype="multipart/form-data">
                    <div class="user-details">
                        
                        <div class="input-box">
                            <span class="details">Email</span>
                            <input type="email" id="add_email" name="email" value="<?php echo $db_mail  ?>" onkeyup="validateEmail()" required  readonly>
                            <span id="emailErr" style="color:red"></span>
                        </div>

                        <div class="input-box">
                            <span class="details">Old Password</span>
                            <input type="password" name="old_password" placeholder="Enter Password" required minlength="8" id="oadd_password">
                            <span id="opasswordErr" style="color:red"></span>
                        </div>
                        
                        
                        <div class="input-box">
                            <span class="details">New Password</span>
                            <input type="password" name="new_password" placeholder="Enter Password" required minlength="8" onkeyup="validatePassword()" id="add_password">
                            <span id="passwordErr" style="color:red"></span>
                        </div>
                        <div class="input-box">
                            <span class="details">Confirm Password</span>
                            <input type="password" name="c_password" placeholder="Confirm Password" id="add_confirmpassword" required minlength="8" onkeyup="validateConfirmPassword()">
                            <span id="confirmpasswordErr" style="color:red"></span>
                        </div>
                        <div class="tacbox">
                            <input id="checkbox" type="checkbox"  required/>
                            <label for="checkbox"> I agree to these <a href="changepasswordterms.html" target="_blank">Terms and Conditions</a>.</label>
                            <span id="confirmpasswordErr" style="color:red"></span>
                        </div>



                    </div>
                    
                    
                    <div class="button">
                        <!-- <button id="add_user_btn" name="submit" value="Add User" onclick="validateform()">Submit</button> -->
                        <button type="submit" id="add_user_btn" name="submit" value="Add User" onclick="validateform()">Submit</button>
                        <span id="submitErr"></span>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
       
        var emailErr = document.getElementById('emailErr');
        var passwordErr = document.getElementById('passwordErr');
        var confirmpasswordErr = document.getElementById('confirmpasswordErr');
        var submitErr = document.getElementById('submitErr');


        


        


        function validateEmail() {
            var email = document.getElementById('add_email').value;
            if (email.length == 0) {
                emailErr.innerHTML = "*Required"
                return false;
            }
            if (!email.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)) {
                emailErr.innerHTML = "Invalid Email Format";
                return false;
            }
            emailErr.innerHTML = "Valid";
            return true;
        }

        

        function validatePassword() {
            var password = document.getElementById('add_password').value;
            if (password.length == 0) {
                passwordErr.innerHTML = "*Required";
                return false;
            }
            if (password.length !== 8) {
                passwordErr.innerHTML = "At least 8 Characters"
                return false;
            }
            else{
            passwordErr.innerHTML = "Valid";
            return true;
            }


        }

        function validateConfirmPassword() {
            var password = document.getElementById('add_password').value;
            var confirmpassword = document.getElementById('add_confirmpassword').value;
            if (confirmpassword.length == 0) {
                confirmpasswordErr.innerHTML = "*Required"
                return false;
            }
            else if (confirmpassword !== password) {
                confirmpasswordErr.innerHTML = "Not Matching"
                return false;
            }
            else if(confirmpassword == password){
            confirmpasswordErr.innerHTML = "Matching";
            return true;
            }

        }

        function validateform() {
            if (!validateName() || !validateEmail() || !validateAddress() || !validatePhone() || !validatePassword() || !validateConfirmPassword()) {
                submitErr.style.display = 'block';
                submitErr.innerHTML = "Fix the Problems to Proceed";
                setTimeout(function() {
                    submitErr.style.display = 'none';
                }, 3000);
                return false;

            }

        }
    </script>
</body>

</html>