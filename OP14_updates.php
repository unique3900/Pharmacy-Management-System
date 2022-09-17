<?php
                include "./Connection/dbcon.php";
                include("./sidebar.php");

                // session_start();
                // if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
                //     header("location: login.php");
                //     exit;
                // }
                $id=$_GET['updateid'];
                $sql="SELECT * FROM supp_record WHERE supp_id = $id";
                $result=mysqli_query($con,$sql);
                $row=mysqli_fetch_assoc($result);

                //database ma tyo row ma j data save xa tyeslai  update form ma dekhauna //
                    $id = $row['supp_id'];
                    $supp_name = $row['supp_name'];
                    $com_name = $row['com_name'];
                    $dop= $row['doe'];
                    $sphone = $row['sphone'];
                    $cphone = $row['cphone'];
                    $email=$row['email'];
                    $paddress=$row['paddress'];
                    $taddress=$row['taddress'];


                if (isset($_POST['submit'])) {
                    $supp_name = $_POST['supp_name'];
                    $com_name = $_POST['com_name'];
                    $sphone = $_POST['sphone'];
                    $cphone = $_POST['cphone'];
                    $email=$_POST['email'];

                    $paddress=$_POST['paddress'];
                    $taddress=$_POST['taddress'];

                    $sql= "UPDATE supp_record SET supp_id=$id,
                    supp_name='$supp_name',com_name='$com_name',sphone='$sphone',
                    cphone='$cphone', email='$email',paddress='$paddress', taddress='$taddress' WHERE supp_id =$id";
                    $result=mysqli_query($con,$sql);
                    if (!$result) {
                    die( mysqli_error($con));

                        // echo "<script>alert('Something Went Wrong')</script>";
                    } else {
                        header('location:OP13_managesupp.php');
                    }
                }


?>



<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
    <title>Update Supplier</title>
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
                    height: 600px;
                    /* margin-top: 10px; */
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
            <div class="title">Update Supplier</div>
            <div class="form-content">
                <form action="" method="POST">
                    <div class="user-details">
                        <div class="input-box">
                            <span class="details">Full Name</span>
                            <input type="text" placeholder="Enter Supplier Full Name" name="supp_name"  value="<?php echo $supp_name; ?>" id="add_name" onkeyup="validateName()" required minlength="8">
                            <span id="nameErr" style="color:red"></span>
                        </div>
                        <div class="input-box">
          <span class="details">Company Name</span>
         <select name="com_name" value="<?php echo $com_name; ?>" id="">
            <?php
            $sqli="SELECT * FROM company_record";
            $result1=mysqli_query($con,$sqli);
            while($row=mysqli_fetch_array($result1)){
                echo '<option value='.$row['id'].'>'.$row['name'].'</option>';
            }
              ?>
        </select>
     </div>
                   <div class="input-box">
                            <span class="details">Supplier Phone</span>
                            <input type="tel" id="add_sphone" name="sphone"  value="<?php echo $sphone; ?>" placeholder="Enter Phone Number" onkeyup="validatesPhone()" required minlength="10">
                            <span id="sphoneErr" style="color:red"></span>
                        </div>
                   <div class="input-box">
                            <span class="details">Company Phone</span>
                            <input type="tel" id="add_phone" name="cphone"  value="<?php echo $cphone; ?>" placeholder="Enter Phone Number" onkeyup="validatePhone()" required minlength="10">
                            <span id="phoneErr" style="color:red"></span>
                        </div>
                        <div class="input-box">
                            <span class="details">Email</span>
                            <input type="email" id="add_email"  value="<?php echo $email; ?>" name="email" placeholder="Enter Email Address" onkeyup="validateEmail()" required>
                            <span id="emailErr" style="color:red"></span>
                        </div>

                        <div class="input-box">
                            <span class="details">Permanent Address</span>
                            <input type="text" name="paddress"  value="<?php echo $paddress; ?>" placeholder="Enter Full Address" onkeyup="validateAddress()" id="add_address" required>
                            <span id="addressErr" style="color:red"></span>
                        </div>
                        <div class="input-box">
                            <span class="details">Temporary Address</span>
                            <input type="text" name="taddress"  value="<?php echo $taddress; ?>" placeholder="Enter Full Address" onkeyup="validateAddresss()" id="add_addresss">
                            <span id="addressErrs" style="color:red"></span>
                        </div>
                      </div>

                    <div class="button">
                        <!-- <button id="add_user_btn" name="submit" value="Add User" onclick="validateform()">Submit</button> -->
                        <button type="submit" id="add_user_btn" name="submit" value="Add Supplser" onclick="validateform()">Submit</button>
                        <span id="submitErr" style="color:red"></span>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        var nameErr = document.getElementById('nameErr');
        var emailErr = document.getElementById('emailErr');
        var phoneErr = document.getElementById('phoneErr');
        var sphoneErr = document.getElementById('sphoneErr');
        var addressErr = document.getElementById('addressErr');
        var addressErrs = document.getElementById('addressErrs');
        var submitErr = document.getElementById('submitErr');

        function validateName() {
            var name = document.getElementById('add_name').value;

            if (name.length == 0) {
                nameErr.innerHTML = "*Required"
                return false;
            }
            if (!name.match(/(\w+)(?:\s[^\s]+)?\s(\w+).*$/)) {
                nameErr.innerHTML = "Write Full Name";
                return false;
            }
            nameErr.innerHTML = "Valid";
            return true;
        }



        function validatesPhone() {
            var phone = document.getElementById('add_sphone').value;
            if (phone.length == 0) {
                sphoneErr.innerHTML = "*Required"
                return false;
            }
            if (!phone.match(/^[9][7-8][0-9]{8}$/)) {
                sphoneErr.innerHTML = "Personal No.shoul start with'9";
                return false;
            }
            if (phone.length !== 10) {
                sphoneErr.innerHTML = "Phone Number should be 10 digits"
                return false;
            }


            sphoneErr.innerHTML = "Valid";
            return true;
        }
        function validatePhone() {
            var phone = document.getElementById('add_phone').value;
            if (phone.length == 0) {
                phoneErr.innerHTML = "*Required"
                return false;
            }
            if (!phone.match(/^[0-9]{10}$/)) {
                phoneErr.innerHTML = "Only Digits Allowed";
                return false;
            }
            if (phone.length !== 10) {
                phoneErr.innerHTML = "Phone Number should be 10 digits"
                return false;
            }


            phoneErr.innerHTML = "Valid";
            return true;
        }


        function validateEmail() {
            var email = document.getElementById('add_email').value;
            if (email.length == 0) {
                emailErr.innerHTML = "*Required*"
                return false;
            }
            if (!email.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)) {
                emailErr.innerHTML = "Invalid Email Format";
                return false;
            }
            emailErr.innerHTML = "Valid";
            return true;
        }

        function validateAddress() {
            var address = document.getElementById('add_address').value;

            if (address.length == 0) {
                addressErr.innerHTML = "*Required*"
                return false;
            }
            addressErr.innerHTML = "Valid";
            return true;

        }
        function validateAddresss() {
            var address = document.getElementById('add_addresss').value;

            if (address.length == 0) {
                addressErrs.innerHTML = "Optional"
                return false;
            }
            addressErrs.innerHTML = "Valid";
            return true;

        }



        function validateform() {
            if (!validateName() || !validateEmail() || !validateAddress() || !validatePhone() || !validatesPhone() ) {
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
