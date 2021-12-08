<?php include("head.php");
session_start();
if (isset($_SESSION["ac_name"])) {


// $session = ;
$acc_data = select_trans($con,$_SESSION["ac_no"]);
?>
<div class="container">

    <div class="row " >
        <div class="col-md-3 "></div>
        
        <div class="col-md-6 mt-5">
        <div class="card">
            <div class="card-header text-center"><h3>Balance Inquriy</h3></div>
            <div class="card-body text-center">
                <p>Account No#: <b> <?php echo $acc_data["account_no"];?></b></p>
                <p>Current Balance: <b>Rs. <?php echo $acc_data["current_balance"];?></b></p>
            </div>
            <div class="card-footer">
                <div class="clearfix">
                    <a href="Menu.php" class="float-left btn btn-success" role="button"><i class="fas fa-arrow-circle-left"></i> Back Menu</a>
                    <a href="server.php?logout" class="float-right btn btn-danger" role="button"><i class="fas fa-sign-out-alt"></i>Exit Application</a>

                </div>
            </div>
        </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>




<?php
}else{
    header("Location:index.php");
}
include("footer.php");?>