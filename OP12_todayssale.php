<?php 
                 include "./Connection/dbcon.php";
                 session_start();
                 if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
                     header("location: index.php");
                     exit;
                 }
                 $today_date = date("Y-m-d");

                 if(isset($_POST['submit']))
                 {
                    $medicine_id=$_POST['med_id'];
                    $sales_rate=$_POST['sales_rate'];
                    $sales_quantity=$_POST['sales_quantity'];
                    $total_sales=$_POST['total_sales'];
                            
                    $entered_by=$_POST['entered_by'];
                    $sale_date=$_POST['entry_date'];

                    
                    $sql_import_medicine_rec="SELECT * FROM `medicine_record` WHERE `Medicine_id` = $medicine_id";
                    $result1=mysqli_query($con,$sql_import_medicine_rec);

                    $count=mysqli_num_rows($result1);
                    if($count>0){
                        while($row=mysqli_fetch_assoc($result1)){
                                                $expiry_date=$row['expiry_date'];
                                                $medicine_name=$row['med_name'];
                                                $remaining_quantity=$row['remaining_quantity'];
                                                $purchase_rate = $row['purchase_rate'];
                        }
                        $profit_on_sales = $total_sales - ($purchase_rate * $sales_quantity);
                        if($expiry_date<$today_date){
                            echo "<script>alert('Invalid! Did you sell expired Product?');</script>";
                        }
                        else{
                        if($sales_quantity<=$remaining_quantity){
                            $sql_insert_sale="INSERT INTO `sale_record` (`Med_id`, `Medicine_Name`, `total_sale`, `profit_on_sale`, `entered_by`, `date`) VALUES ('$medicine_id', '$medicine_name', '$total_sales', '$profit_on_sales', '$entered_by', '$today_date')";
                            $result2=mysqli_query($con,$sql_insert_sale);

                            //Update Medicine Recors
                            if($result2){
                                $sql_search_med_rec="SELECT * FROM `medicine_record` WHERE `Medicine_id` = $medicine_id";
                                $result3=mysqli_query($con,$sql_search_med_rec);
                                if($result3){
                                    while($row_search=mysqli_fetch_assoc($result3)){
                                       
                                        $current_rem_quantity = $remaining_quantity - $sales_quantity;
                                    }

                                    $sql_update_med_rec="UPDATE `medicine_record` SET `remaining_quantity` = '$current_rem_quantity' WHERE `medicine_record`.`Medicine_id` = $medicine_id" ;
                                    $res_update=mysqli_query($con,$sql_update_med_rec);
                                    if($res_update){
                                        header('location:OP6_manageinventory.php');
                                    }
                                }

                            }
                            else{
                                echo "<script>alert('Something Went Wrong');</script>";
                               
                            }

                        }
                        else{
                            echo "<script>alert('Invalid Sales entry!!!! Not enougn in stock');</script>";
                        }

                    }
                }
                    else{
                        echo "<script>alert('Medicine not Found');</script>";
                    }




                            



                 }







?>




<!DOCTYPE html>

<html lang="en" dir="ltr">

    <head>
        <title>Sales</title>
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
            height: 500px;
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

        </div>
        <div class="add_main-form">
            <div class="add-form-container">
                <div class="title">Sales Entry</div>
                <div class="form-content">
                    <form method="POST">
                        <div class="user-details">

                            <div class="input-box">


                                <span class="details">Medicine Name</span>
                                <select name="med_id" id="">

                                    <?php
                                $sqli = "SELECT * FROM  medicine_record";
                                $result1 = mysqli_query($con, $sqli);
                                while ($row = mysqli_fetch_assoc($result1)) {
                                    echo '<option value=' . $row['Medicine_id'] . '>' . $row['med_name'] . '</option>';
                                }


                                ?>
                                </select>
                            </div>

                            <div class="input-box">
                                <span class="details">Sold Quantity(pcs.)</span>
                                <input type="number" onchange="calculatesalesamount()" name="sales_quantity"
                                    id="sales_quantity" placeholder="Enter Sales Quantity" required>

                            </div>
                            <div class="input-box">
                                <span class="details">Sold Rate(per pcs.)</span>
                                <input type="number" onchange="calculatesalesamount()" id="sales_rate" name="sales_rate"
                                    placeholder="Enter Sales Rate" required>

                            </div>


                            <div class="input-box">
                                <span class="details">Total Sale</span>
                                <input type="number" id="sales_amount" name="total_sales" placeholder="Sales Amount"
                                    required readonly>

                            </div>

                            <div class="input-box">
                                <span class="details">Entry By</span>
                                <input type="text" name="entered_by" value="<?php echo $_SESSION['name']; ?>" required
                                    readonly>

                            </div>
                            <div class="input-box">
                                <span class="details">Entry Date</span>
                                <input type="text" name="entry_date" value="<?php echo $today_date;  ?>" required
                                    readonly>

                            </div>




                        </div>

                        <div class="button">
                            <!-- <button id="add_user_btn" name="submit" value="Add User" onclick="validateform()">Submit</button> -->
                            <button type="submit" id="add_user_btn" name="submit" value="Add User">Done</button>
                            <span id="submitErr"></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <script>
        function calculatesalesamount() {
            let sales_quantity = document.getElementById('sales_quantity').value;
            let sales_rate = document.getElementById('sales_rate').value;

            let sales_amount = sales_quantity * sales_rate;

            document.getElementById("sales_amount").value = sales_amount;

        }
        </script>


    </body>

</html>