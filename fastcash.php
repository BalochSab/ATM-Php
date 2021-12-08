<?php include("head.php");
session_start();
if (isset($_SESSION["ac_name"])) {
  $err = array('success'=>'');
  if (isset($_GET['cash'])) {
    
    // $old_date = $account_no = $withdrawal = $curbalance = $Amount = '';
    include("connect.php");
    $old_date = select_trans($con,$_SESSION["ac_no"]);
    if($old_date) {
      $withdrawal = $_GET['cash']; 
      $account_no = $old_date['account_no'];
      $curbalance = $old_date['current_balance'];
      
      if ($withdrawal <= $curbalance) {
          $Amount = $curbalance-$withdrawal;
          $date = date('Y-m-d H:i:s');
          //$ad_dep                                               deposite     Withdrawal  balance   
          $xnsert_acc = "INSERT INTO transaction_tbl value('null',0,{$withdrawal},{$Amount},'{$date}',{$account_no});";
          $tran = mysqli_query($con,$xnsert_acc);
          if($tran) {
          // $err['success'] = "<div class='alert alert-success text-center'>Transection has been Successful.</div>";
          $err['success'] = '<div class="container"><div class="alert alert-success alert-dismissible fade show">
                              <button type="button" class="close" data-dismiss="alert">&times;</button>
                              <strong>Thank You!</strong> Banking with us
                            </div></div>';
              
              mysqli_close($con);
          }
      }else {
          $err['success'] = '<div class="alert alert-danger alert-dismissible fade show">
                              <button type="button" class="close" data-dismiss="alert">&times;</button>
                              <strong>Sorry!</strong> Your Current Balance enough for this Transiction!
                            </div>';
        }
            
    }

    
  }
?>

<div class="container">
  <div class="row ">
    <br>
    <div class="col-md-6"></div>
  </div>
  
  <div class="card">
    <div class="card-header text-center"><h3>Fast Cash</h3></div>
    <div class="card-body">
          <?php echo $err['success'];?>

          <div class="row m-2">
            <?php $x = 0;
            while ( $x <= 25000) {
              if ($x==500 || $x==1000 || $x==5000 || $x==10000 || $x==25000 ) {
               ?>
              <div class="col-md-6 ">
                  <button type="button" class="btn btn-primary btn-lg btn-block m-2" data-toggle="modal" data-target="#cash<?php echo $x;?>">
                    <?php echo $x;?>
                  </button>

                  <!-- The Modal -->
                  <div class="modal fade " id="cash<?php echo $x;?>">
                    <div class="modal-dialog">
                      <div class="modal-content ">
                      
                        <!-- Modal Header -->
                        <div class="modal-header ">
                          <h4 class="modal-title text-center">Comfirmation</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body text-center font-weight-bold">
                          Are your Sure ?
                          <!-- to <?php #echo $x;?> Fastcash. -->
                        </div>
                        
                        <!-- Modal footer -->
                        <div class="modal-footer float-center">
                          <a href="fastcash.php?cash=<?php echo $x;?>" class="btn btn-success ">Yes</a>
                          <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                        </div>
                        
                      </div>
                    </div>
                  </div>

                <!-- Modal End -->
            </div>
            <?php }else{
                
              }
              $x += 500;
            } ?>
            
            <div class="col-md-6  " >
              <a href="withdrawal.php" class="btn btn-info btn-lg btn-block m-2" role="button">Other Amount</a>
              </div>

    <!-- this is raw End    -->
          </div>
    <!-- this is card body End    -->
    </div> 
    <div class="card-footer">
                <div class="clearfix">
                    <a href="Menu.php" class="float-left btn btn-success" role="button"><i class="fas fa-arrow-circle-left"></i> Back Menu</a>
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