<?php include("head.php");
session_start();

if (isset($_SESSION["ac_name"])) {

    $err = array('deposited'=>'','success'=>'');
if (isset($_POST['deposite'])) {
    
    $old_date = $account_no = $dptAmount = $curbalance = $Amount = '';

    //validation for Amount text box
    // $with = is_float($_POST['amount']);
    if (empty($_POST['amount'])) {
      $err['deposited'] = "Must be Enter amount";
    }
    else {
    if (($_POST['amount']>=500) & ($_POST['amount']<=25000)) {
        if ($_POST['amount']%500 == 0) {
    //Validation is ok
        include("connect.php");
        $old_date = select_trans($con,$_SESSION["ac_no"]);
            if($old_date) {
                $account_no = $old_date['account_no'];
                $deposite = $_POST['amount']; 
                $curbalance = $old_date['current_balance'];

                $Amount = $curbalance+$dptAmount;
                $date = date('Y-m-d H:i:s');
                //transection Inserter                                  deposite      balance   
                $insert_acc = "INSERT INTO transaction_tbl value('null',{$dptAmount},0,{$Amount},'{$date}',{$account_no});";
                $tran = mysqli_query($con,$insert_acc);
                if($tran) {
                $err['success'] = "<div class='alert alert-success text-center'>Transection has been Successful.</div>";
                    
                    mysqli_close($con);
                }
            }
        }else {
        $err['deposited'] = "Must be Amount like(500, 1000, 1500 or 25,000)";
        }
    }
    else {
        $err['deposited'] = "Deposite Amount in limit 500 to 25000 only.";
    }
    }


}
?>
<div class="container">

    <div class="row " >
        <div class="col-md-3 "></div>
        
        <div class="col-md-6 mt-5">
        <div class="card">
            <div class="card-header text-center font-weight-bold"><h3>Deposite Amount</h3></div>
            <div class="card-body">
                
            <?php echo $err['success'];?>
            <form action="" method="post" class="p-5">
                <div class="form-group ">
                    <label for="dep">Deposite Amount</label>
                    <input type="text" name="amount" class="form-control pwd"   placeholder="Enter Deposite Amount" id="dep" >
                    <div class="text-danger"><?php echo $err['deposited'];?></div>
                </div>
                
                <div class="">
                    <button type="submit" name="deposite" class="btn btn-primary btn-block"><i class="fas fa-hand-holding-usd"></i> Deposite</button>
                </div>
            </form>


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