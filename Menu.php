<?php include("head.php") ; 
session_start();
if (isset($_SESSION["ac_name"])) {
// $session = ;
// $user_data = SelectUserId($con,$_SESSION["user_id"]);
?>

<div class="container">
  <div class="row ">
    
    <div class="col-md-6"></div>
  </div>
  
  <div class="card row mt-5">
    <div class="card-header">Welcome <?php echo $_SESSION["ac_name"]; ?></div>
    <div class="card-body">

          <div class="row mt-2">
            <div class="col-md-6 col-sm-6">
              <a href="balanceInquiry.php" class="text-center">
                <div class="card">
                  <div class="card-body">Balance Inquiry</div>
                </div>
              </a>
            </div>
            <div class="col-md-6  col-sm-6" >
              <a href="showTrans.php" class="text-center">
                <div class="card">
                    <div class="card-body">Show Transections</div>
                </div>
              </a>
              </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-6  ">
              <a href="fastcash.php" class="text-center">
                <div class="card">
                    <div class="card-body">Fast Cash</div>
                </div>
              </a>
            </div>
            <div class="col-md-6  ">
              <a href="withdrawal.php" class="text-center">
                <div class="card">
                    <div class="card-body">Cash Withdrawal</div>
                </div>
              </a>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-6  ">
              <a href="deposite.php" class="text-center">
                <div class="card">
                    <div class="card-body">Deposite</div>
                </div>
              </a>
            </div>
            <div class="col-md-6  ">
              <a href="fund.php" class="text-center">
                <div class="card">
                    <div class="card-body">Fund Transfer</div>
                </div>
              </a>
            </div>
          </div>

    </div> 
    <div class="card-footer">
                <div class="clearfix">
                    <!-- <a href="Menu.php" class="float-left btn btn-success" role="button"><i class="fas fa-arrow-circle-left"></i> Back Menu</a> -->
                    <a href="server.php?logout" class="float-right btn btn-danger" role="button"><i class="fas fa-sign-out-alt"></i>Exit Application</a>

                </div>
            </div>
    
  </div>
</div>

<?php 
}else{
  header("Location:index.php");
}
include("footer.php");?>