<?php
            include "./Connection/dbcon.php";
            session_start();
            if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
                header("location: index.php");
                exit;
            }



            $id = $_GET['updateid'];




            //Hint Dina ko lagi input field ma
            $sql = "SELECT * FROM `medicine_record` WHERE id=$id";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_assoc($result);
            $u_med_name = $row['med_name'];
            $u_med_id = $row['Medicine_id'];
            $u_med_type = $row['med_type'];
            $u_purchase_quantity = $row['total_purchase_quantity'];
            $u_purchase_rate = $row['purchase_rate'];
            $u_purchase_amount = $row['total_purchase_amount'];
            $u_total_payment  = $row['total_payment'];
            $u_pending_payment = $row['pending_payment'];
            $u_entered_by = $row['entered_by'];
            $u_seller = $row['seller'];




            if (isset($_POST['submit'])) {





                $med_name = $_POST['med_name'];
                $med_id = $_POST['med_id'];
                $med_type = $_POST['med_type'];

                $purchase_quantity = $_POST['purchase_quantity'];
                $purchase_rate = $_POST['purchase_Rate'];
                $purchase_amount = $_POST['purchase_amount'];
                $total_payment = $_POST['total_payment'];
                $pending_payment = $_POST['pending_payment'];
                $entered_by = $_POST['entered_by'];
                $seller = $_POST['seller'];

                $sqli = "SELECT * FROM medicine_record  WHERE `med_name` = '$med_name'";
                $result1 = mysqli_query($con, $sqli);
                while ($row = mysqli_fetch_array($result1)) {
                    $remaining_med = $row['remaining_quantity'];
                }
                $new_quantity=$purchase_quantity+$remaining_med;






                if($pending_payment>=0){

                    $sql = "UPDATE `medicine_record` SET  `med_type` = '$med_type', `total_purchase_quantity` = '$purchase_quantity', `purchase_rate` = '$purchase_rate', `total_payment` = '$total_payment', `pending_payment` = '$pending_payment',`remaining_quantity` = '$new_quantity', `entered_by` = '$entered_by', `seller` = '$seller' WHERE `medicine_record`.`id` = $id";
                    $result = mysqli_query($con, $sql);
                    if (!$result) {
                        echo "<script>alert('Somethin Went Wrong')</script>";
                    } else {
                        header('location:OP6_manageinventory.php');
                    }
                }
                else{
                    echo "<script>alert('Invvalid Entry...Paid amount greater than pending amount')</script>";
                }
            }


?>





<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
    <title>Update Medicine</title>
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
            height: 180vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
            background: linear-gradient(135deg, #00c354, #049c41);
        }

        .add-form-container {
            height: 700px;
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
            <div class="title">Update Medicine</div>
            <div class="form-content">
                <form method="POST">
                    <div class="user-details">
                        <div class="input-box">
                            <span class="details">Medicine Name</span>
                            <input type="text" value="<?php echo $u_med_name;  ?>" placeholder="Enter Medicine Name" name="med_name" id="add_name" readonly>

                        </div>
                        <div class="input-box">
                            <span class="details">Medicine ID</span>
                            <input type="text" value="<?php echo $u_med_id;  ?>" placeholder="Enter Medicine ID" name="med_id" id="add_name" readonly>

                        </div>

                        <div class="input-box">



                            <span class="details">Medicine Type</span>
                            <select name="med_type" id="">

                                <?php
                                $sqli = "SELECT * FROM medicine_type";
                                $result1 = mysqli_query($con, $sqli);
                                while ($row = mysqli_fetch_array($result1)) {
                                    echo '<option value=' . $row['id'] . '>' . $row['type'] . '</option>';
                                }


                                ?>
                            </select>
                        </div>

                        <div class="input-box">
                            <span class="details">Purchase Quantity(pcs.)</span>
                            <input type="number" value="<?php echo $u_purchase_quantity;  ?>" onchange="calculatepurchaseamount()" name="purchase_quantity" id="purchase_quantity" placeholder="Enter Purchase Quantity" readonly required>

                        </div>
                        <div class="input-box">
                            <span class="details">Purchase Rate(per pcs.)</span>
                            <input type="number" value="<?php echo $u_purchase_rate;  ?>" onchange="calculatepurchaseamount()" id="purchase_rate" name="purchase_Rate" placeholder="Enter Purchase Rate" readonly required>

                        </div>
                        <div class="input-box">
                            <span class="details">Purchase Amount</span>
                            <input type="number" value="<?php echo $u_purchase_amount;  ?>" onchange="calculatependingamount()" id="purchase_amount" name="purchase_amount" placeholder="Enter Purchase Amount" required readonly>

                        </div>
                        <div class="input-box">
                            <span class="details">Total Payment</span>
                            <input type="number" value="<?php echo $u_total_payment;  ?>" onchange="calculatependingamount()" id="total_payment" name="total_payment" placeholder="Enter Purchase Amount" required>

                        </div>
                        <div class="input-box">
                            <span class="details">Pending Payment</span>
                            <input type="number" value="<?php echo $u_pending_payment;  ?>" id="pending_payment" name="pending_payment" placeholder="Enter Pending Payment" required readonly>

                        </div>
                        <div class="input-box">
                            <span class="details">Entered By</span>
                            <input type="text" name="entered_by" value="<?php echo $_SESSION['name']; ?>" required readonly>



                        </div>

                        <div class="input-box">
                                                <span class="details">Seller Name</span>
                                <select name="seller" value="<?php echo $com_name; ?>" id="">
                                    <?php
                                    $sqli="SELECT supp_name FROM supp_record";
                                    $result1=mysqli_query($con,$sqli);
                                    while($row=mysqli_fetch_array($result1)){
                                        echo '<option value='.$row['supp_name'].'>'.$row['supp_name'].'</option>';
                                    }
                                    ?>
                                </select>
                        </div>


                    </div>

                    <div class="button">
                        <!-- <button id="add_user_btn" name="submit" value="Add User" onclick="validateform()">Submit</button> -->
                        <button type="submit" id="add_user_btn" name="submit" value="Add User">Update</button>
                        <span id="submitErr"></span>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        function calculatepurchaseamount() {
            let purchase_quantity = document.getElementById("purchase_quantity").value;
            let purchase_rate = document.getElementById("purchase_rate").value;
            let purchase_amount = purchase_quantity * purchase_rate;

            document.getElementById("purchase_amount").value = purchase_amount;

        }

        function calculatependingamount() {
            let total_payment = document.getElementById("total_payment").value;
            let purchase_amount = document.getElementById("purchase_amount").value;

            let pending_payment = purchase_amount - total_payment;

            document.getElementById("pending_payment").value = pending_payment;


        }
    </script>


</body>

</html>
