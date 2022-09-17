<?php
            include "./Connection/dbcon.php";
            include("sidebar.php");

            //Todays date
            $current_date=date("Y/m/d");

            $con=mysqli_connect($servername,$username,$password,$dbname);
            //Current Logged in user ko id


            $curren_user_id= $_SESSION['id'];
            $current_designation=$_SESSION['designation'];
            //   echo $curren_user_id;
            //   echo $current_designation;


            if(isset($_POST['submit'])){
                $leave_id=$curren_user_id;
                $name=$_POST['name'];
                $reason=$_POST['reason'];
                $from_date=$_POST['start_date'];
                $submitted_date=$_POST['submitted_date'];
                $end_date=$_POST['end_date'];
                
            

                // $sql="INSERT INTO `leaverequests` ( `Name`, `Reason`, `Date`, `end_date`) VALUES ( '$name', '$reason', '$from_date', '$end_date')";
                // $result=mysqli_query($con,$sql);

                // Fetch the employee id from employee table
                $sql1="SELECT `Emp_id` FROM `employee` WHERE `id` = $curren_user_id";
                $result2= mysqli_query($con, $sql1);
                while($row1=mysqli_fetch_assoc($result2)){
                    $employee_id=$row1['Emp_id'];
                }

            
                $sql = "INSERT INTO `leaverequests` (`u_id`,`leave_id`,`Name`, `Reason`,`submitted_date`, `Date`, `end_date`, `status`) VALUES ('$employee_id','$curren_user_id', '$name', '$reason','$submitted_date', '$from_date', '$end_date','2')";
                $result = mysqli_query($con, $sql);
                if($result){
                    echo "<script>alert('Successfull');</script>";
                }
                else{
                    $myerr=mysqli_error($con);
                    echo $myerr;

                }
            }




?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->

    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <title>Request leave</title>
    <!-- <style>
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
                .container #sidebar {
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

                .container {
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

                .users .card {
                    display:inline-block;
                    overflow-x: auto;
                    overflow-y: auto;
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

                .users .card img {
                    width: 100px;
                    height: 100px;
                    border-radius: 25%;
                    margin-bottom: 25px;
                }

                .users .card h4 {
                    margin-bottom: 5px;
                    color: black;
                    font-size:30px;
                    text-transform: uppercase;
                    text-align: center;
                }

               

                .users table {
                    margin: auto;
                }

                .users .per span {
                    color:red;
                    
                    padding: 5px;
                    font-size: 35px;
                    font-weight:bold;
                    
                    /* background: rgb(255, 255, 250); */
                }
                .users .per p{
                    color:green;
                    font-size:20px;
                    font-weight:bold;
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
                    margin-bottom: 5px;
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
    </style> -->
</head>

<body>  
        <a href="dashboard.php"><img src="./icons/goback.svg" alt="" class="rounded float-start mx-5 my-2"  width="70px" height="70px" name="go_back"></a>
            

        <h1 class="text-center my-1 ">Apply Leave</h1>


        <form class="my-5 mx-5 w-5" method="POST">
            <div class="form-group">
                <label for="exampleFormControlInput1">Your Name</label>
                <input type="text" class="form-control" id="exampleFormControlInput1"
                    value="<?php echo $_SESSION['name']    ?>" name="name" readonly>
            </div>

            <div class="form-group">
                <label for="exampleFormControlTextarea1">Purpose</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="reason" Required></textarea>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Submitted Date</label>
                <input type="text" class="form-control" id="exampleFormControlInput1"
                    value="<?php echo $current_date; ?>" name="submitted_date" readonly>
            </div>

            </div>

            <div class="form-group">
                <label for="exampleFormControlTextarea1">Starting Date</label>
                <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com"
                    name="start_date" Required>
            </div>

            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Ending Date</label>
                <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com"
                    name="end_date" Required>
            </div>

            </div>

            <button type="submit" id="add_user_btn" name="submit" value="Submit" class="btn btn-primary">Submit</button>
            <!-- <button name="bur"  type="submit" class="btn btn-primary">Primary</button> -->
        </form>


        <div class="container">
            <h1 class="text-center">My Request's</h1>
           
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">S.N</th>
                        <th scope="col">Name</th>
                        <th scope="col">Reason</th>
                        <th scope="col">Submitted Date</th>
                        <th scope="col">Start Date</th>
                        <th scope="col">End Date</th>
                        <th scope="col">Status</th>
                        <th scope="col">Option</th>
                    </tr>
                </thead>
                <tbody>
                
                    <?php
     
                             $sql="SELECT * FROM `leaverequests` WHERE `leave_id` = $curren_user_id";
                            $result=mysqli_query($con,$sql);
                            if($result){
                                $count=mysqli_num_rows($result);
                                if($count>0){
                                    $sn=1;
                                    while($row=mysqli_fetch_assoc($result)){
                                        if($row['status']==0){
                                            $prev_action="Declined";
                                        }
                                        elseif($row['status']==2){
                                            $prev_action="Pending";
                                        }
                                        elseif($row['status']==1){
                                            $prev_action="Granted";
                                        }

                                        echo '
                                        <tr>
                                        <th scope="row">' . $sn . '</th>
                                        <td>'.$row['Name'].'</td>
                                        <td>'.$row['Reason'].'</td>
                                        <td>'.$row['submitted_date'].'</td>
                                        <td>'.$row['Date'].'</td>
                                        <td>'.$row['end_date'].'</td>
                                        <td>'.$prev_action.'</td>
                                        <td>
            
                                        <a href="OP21_delete_request.php?deleteid=' . $row['u_id'] . '"><button type="button" class="btn btn-danger">Delete</button></a>
                                           
                                         
                                        </td>
                                    </tr>

                                
                                
                                        ';
                                        $sn++;

                                    }


                                
                                
                                }
                    
                            }



                ?>

                </tbody>
            </table>


        </div>


        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="JS/bootstrap.min.js"></script>

        <script type="text/javascript">
        //toggle Sidebar
        const menuBar = document.querySelector('.side_btn');
        const sidebar = document.getElementById('sidebar');

        menuBar.addEventListener('click', function() {
            sidebar.classList.toggle('hide');
        })
        </script>
        <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
</body>

</html>