<?php include("head.php");
session_start();
if (isset($_SESSION["ac_name"])) {

?>
<div class="container">
    <div class="row">        
        <div class="col-md-12 ">
        <div class="card">
            <div class="card-header text-center">
                <h3>All Transiction</h3>
                Account No#: <b> <?php echo $_SESSION["ac_no"];?> </b>
                Account Holder: <b><?php echo $_SESSION["ac_name"];?></b>
        </div>
            <div class="card-body text-center">
           <!-- //here we show transection Table  -->
           
            <table class="table table-bordered table-hover table-reponsive">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">Serial</th>
                    <th scope="col">Deposited</th>
                    <th scope="col">WithDrawal</th>
                    <th scope="col">Currenct Balance</th>
                    <th scope="col">Sender Account</th>
                    <th scope="col">Reciever Account</th>
                    <th scope="col">Transection Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    include ("connect.php");
                     //Pagination variable
                     $limit = 7;  
                        
                     if (isset($_GET['page'])) {
                         $page = $_GET['page'];
                     }else{
                         $page = 1;
                     }
                     $offset = ($page-1)*$limit; //Starting Record Number (id) on that page 

                    $fatch_query = "SELECT * FROM  transaction_tbl right join fund_transfer on account_no = sender_account
                    WHERE  account_no = ".$_SESSION["ac_no"]." ORDER BY trans_id DESC LIMIT {$offset},{$limit};";
                    $run_select = mysqli_query($con,$fatch_query)  or die("Select query is not correct");
                    $total_raw = mysqli_num_rows($run_select);
                    if ($total_raw >0) { 
                        
                        while ($acc_data = mysqli_fetch_assoc($run_select)) {
                        ?>
                        <tr>
                        <th scope="row"><?php echo $acc_data['trans_id'] #$acc_data["trans_id"];?></th>
                        <td><?php echo $acc_data["deposit"];?></td>
                        <td><?php echo $acc_data["withdrawal"];?></td>
                        <td><?php echo $acc_data["current_balance"];?></td>
                        <td><?php  echo $acc_data["sender_account"];?></td>
                        <td><?php  echo $acc_data["receiver_account"];?></td>
                        <td><?php echo $acc_data["trans_date"];?></td>
                        </tr>
                    <?php
                    } 
                }
                else{
                    echo "there is connection problem";

                }?>
                    
                </tbody>
            </table>






            </div>
            <div class="card-footer">
                <div class="row">
                <div class="col-md-4">
                    <a href="Menu.php" class="float-left btn btn-success" role="button"><i class="fas fa-arrow-circle-left"></i> Back Menu</a>
                    </div>
<!--  ----------------------------------------Start pagination --------------------------------------------------------------------------- -->
                    <div class="col-md-4">
        <?php //pagination get same table 
            $sql_page = "SELECT * FROM transaction_tbl WHERE  account_no= ".$_SESSION["ac_no"].";";
            $resutl = mysqli_query($con,$sql_page) or die("Query Feiled");
            $row = mysqli_num_rows($resutl);
            if ($row > 0) {
                $total_records = $row;
                $total_page = ceil($total_records / $limit);
            
            echo '<ul class="pagination justify-content-center " style="text-align: center;">';
                if ($page > 1) {
                echo '<li class="page-item"><a class="page-link" href="showTrans.php?page='.($page - 1).'">Prev</a></li>';
                }
                for ($i=1; $i <= $total_page ; $i++) { 
                    if ($i == $page) {
                        $active = "active";
                    }else {
                        $active = "";
                    }
                    echo '<li class="page-item '.$active.'"><a class="page-link" href="showTrans.php?page='.$i.'">'.$i.'</a></li>';
                }
                if ($total_page > $page) {
                    echo '<li class="page-item"><a class="page-link" href="showTrans.php?page='.($page + 1).'">Next</a></li>';
                }
                echo "</ul>";
            } 
        ?>
    </div>
<!--  ----------------------------------------end pagination --------------------------------------------------------------------------- -->

                    <div class="col-md-4">
                        <a href="server.php?logout" class="float-right btn btn-danger" role="button"><i class="fas fa-sign-out-alt"></i>Exit Application</a>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- <div class="col-md-3"></div> -->
    </div>
</div>




<?php
}else{
    header("Location:index.php");
}
include("footer.php");?>