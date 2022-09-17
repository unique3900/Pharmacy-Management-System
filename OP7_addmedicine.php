<?php
    include "./Connection/dbcon.php";
    session_start();
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
        header("location: index.php");
        exit;
    }

    if (isset($_POST['submit'])) {





        $med_name =$_POST['med_name'];
        $med_id =$_POST['med_id'];
        $batch_number=$_POST['Batch_Number'];
        $med_type = $_POST['med_type'];
        $date_of_purchase = $_POST['purchase_date'];
        $expiry_date = $_POST['expiry_date'];
        $purchase_quantity = $_POST['purchase_quantity'];
        $purchase_rate = $_POST['purchase_Rate'];
        $purchase_amount = $_POST['purchase_amount'];
        $total_payment = $_POST['total_payment'];
        $pending_payment = $_POST['pending_payment'];
        $entered_by = $_POST['entered_by'];
        $seller = $_POST['seller'];


        $batch_number_nospace=trim($batch_number);


        $full_med_name=$med_name ."(".$batch_number.")";
        $med_name_nospace=str_replace(' ', '', $full_med_name);
        $current_remaining_quantity=$purchase_quantity;

        $today_date = date("Y-m-d");

        $exp_date=strtotime($expiry_date);

        if($expiry_date>$today_date){
                if($pending_payment>=0){
                        $sql2="SELECT * FROM `medicine_record` WHERE `Medicine_id`= '$med_id' AND `med_name`= '$med_name_nospace' ";
                        $result2 = mysqli_query($con, $sql2);
                        $countmed=mysqli_num_rows($result2);
                        if($countmed>0){
                            echo "<script>alert('Medicine of Same Detail (Batch Or ID) Exist Already')</script>";
                        }
                        else{


                        // $sql = "INSERT INTO `medicine_record` ( `med_name`, `Batch_no`, `med_type`, `date_of_purchase`, `expiry_date`, `total_purchase_amount`, `total_purchase_quantity`, `purchase_rate`, `total_payment`, `pending_payment`, `entered_by`, `seller`, `remaining_quantity`) VALUES ( '$med_name_nospace','$batch_number_nospace','$med_type', '$date_of_purchase', '$expiry_date', '$purchase_amount', '$purchase_quantity', '$purchase_rate', '$total_payment', '$pending_payment', '$entered_by', '$seller', '$current_remaining_quantity')";

                        $sql = "INSERT INTO `medicine_record` ( `Medicine_id`,`med_name`, `med_type`, `date_of_purchase`, `expiry_date`, `total_purchase_amount`, `total_purchase_quantity`, `purchase_rate`, `total_payment`, `pending_payment`, `entered_by`, `seller`, `remaining_quantity`) VALUES ( '$med_id','$med_name_nospace','$med_type', '$date_of_purchase', '$expiry_date', '$purchase_amount', '$purchase_quantity', '$purchase_rate', '$total_payment', '$pending_payment', '$entered_by', '$seller', '$current_remaining_quantity')";
                        $result = mysqli_query($con, $sql);
                        if (!$result) {
                            echo "<script>alert('Something Went Wrong || Check if Medicine ID Already Exist')</script>";
                        }
                        else {
                            header('location:OP6_manageinventory.php');
                        }
                        }
                    }

                else{
                    echo "<script>alert('Invalid Entry! Total Payment cannot be greater than total purchase amount')</script>";
                }

            }
            else{
                echo "<script>alert('Invalid Entry!Expiry date should be greater')</script>";
            }
    }


?>





<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
    <title>Add Medicine</title>
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
            height: 840px;
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
            <div class="title">Add Medicine</div>
            <div class="form-content">
                <form method="POST">
                    <div class="user-details">
                        <div class="input-box">
                            <span class="details">Medicine Name</span>
                            <input type="text" placeholder="Enter Medicine Name" name="med_name" id="add_name" required>

                        </div>
                        <div class="input-box">
                            <span class="details">Medicine Id</span>
                            <input type="number" placeholder="Enter Medicine Id" name="med_id" id="add_id" required>

                        </div>
                        <div class="input-box">
                            <span class="details">Batch No.</span>
                            <input type="number" placeholder="Enter Batch Number" name="Batch_Number" id="add_name" required>

                        </div>
                        <div class="input-box">


                            <span class="details">Medicine Type</span>
                            <select name="med_type" id="">

                                <?php
                                $sqli="SELECT * FROM medicine_type";
                                $result1=mysqli_query($con,$sqli);
                                while($row=mysqli_fetch_array($result1)){
                                    echo '<option value='.$row['id'].'>'.$row['type'].'</option>';

                                }


                                ?>
                            </select>
                        </div>

                        <div class="input-box">
                            <span class="details">Purchase Date</span>
                            <input type="date" name="purchase_date" id="purchase_date" required>

                        </div>
                        <div class="input-box">
                            <span class="details">Expiry Date</span>
                            <input type="date" name="expiry_date" id="expiry_date" required>

                        </div>
                        <div class="input-box">
                            <span class="details">Purchase Quantity(pcs.)</span>
                            <input type="number" value="0" onchange="calculatepurchaseamount()" name="purchase_quantity" id="purchase_quantity" placeholder="Enter Purchase Quantity" required>

                        </div>
                        <div class="input-box">
                            <span class="details">Purchase Rate(per pcs.)</span>
                            <input type="number" value="0" onchange="calculatepurchaseamount()" id="purchase_rate" name="purchase_Rate" placeholder="Enter Purchase Rate" required>

                        </div>
                        <div class="input-box">
                            <span class="details">Purchase Amount</span>
                            <input type="number" value="0" onchange="calculatependingamount()" id="purchase_amount" name="purchase_amount" placeholder="Enter Purchase Amount" required  readonly>

                        </div>
                        <div class="input-box">
                            <span class="details">Total Payment</span>
                            <input type="number" value="0" onchange="calculatependingamount()" id="total_payment" name="total_payment" placeholder="Enter Purchase Amount" required>

                        </div>
                        <div class="input-box">
                            <span class="details">Pending Payment</span>
                            <input type="number" value="0" id="pending_payment" name="pending_payment" placeholder="Enter Pending Payment"  required readonly >

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
                        <button type="submit" id="add_user_btn" name="submit" value="Add User">Submit</button>
                        <span id="submitErr" style="color:red"></span>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
       function calculatepurchaseamount(){
           let purchase_quantity=document.getElementById("purchase_quantity").value;
           let purchase_rate=document.getElementById("purchase_rate").value;
           let purchase_amount=purchase_quantity*purchase_rate;

           document.getElementById("purchase_amount").value=purchase_amount;

        }

        function calculatependingamount(){
            let total_payment=document.getElementById("total_payment").value;
            let purchase_amount=document.getElementById("purchase_amount").value;

            let pending_payment=purchase_amount-total_payment;

            document.getElementById("pending_payment").value=pending_payment;





        }
    </script>


</body>

</html>
