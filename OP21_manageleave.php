<?php
include "./Connection/dbcon.php";
include("sidebar.php");



?> 
<!doctype html > 
<html lang="en"> 
    <head >
<!-- Required meta tags --> <meta charset="utf-8">
    <meta
        name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="CSS/bootstrap.min.css">
        <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->

            <title>Leaves</title>
        </head>
        <body>
        <a href="dashboard.php"><img src="./icons/goback.svg" alt="" class="rounded float-start mx-5 my-2"  width="70px" height="70px" name="go_back"></a>
            

            <div class="container">
                <h1 class="text-center">Leave Requests</h1>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">S.N</th>
                            <th scope="col">Name</th>
                            <th scope="col">Reason</th>
                            <th scope="col">Submitted Date</th>
                            <th scope="col">From</th>
                            <th scope="col">To</th>
                            <th scope="col">Previous Action</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                             $sql="SELECT * FROM `leaverequests` WHERE `status` = 0 OR 2";
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

                                        if($row['status']==0||$row['status']==2){
                                        
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
            
                                        <a href="OP22_grant_leave_req.php?updateid=' . $row['u_id'] . '"><button type="button" class="btn btn-primary">Grant</button></a>
                                           
                                         <a href="OP23_decline_leave_req.php?deleteid=' . $row['u_id'] . '"><button type="button" class="btn btn-danger"">Decline</button></a>
                                        </td>
                                    </tr>
                                

                                
                                
                                        ';
                                        }
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
            <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
        </body>
    </html>
