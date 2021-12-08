<?php 
session_start();
if (isset($_SESSION["ac_name"])) {
  header("Location:Menu.php");

}else{
include("head.php");  
//  include("connect.php");
$username = $depos = "";
$err =  array('name'=>'','pin'=>'','gender'=>'','deposited'=>'','reg'=>'');
if (isset($_POST['register'])) {

    //validation for username textbox
    if (empty($_POST['username'])) {
      $err['name'] = "Username is required";
    }
    else {
        $username = $_POST['username'];
    }

    //validation for Pin code text box
    if (empty($_POST['pin'])) {
      $err['pin'] = "Must be Enter Pin Code";
    }
    else {
        $pattern = '/^[0-9]{4}+$/';
        if (preg_match($pattern, $_POST['pin'])) {
          $pin = $_POST['pin'];
        } 
        else{
          $err['pin'] = "Must be Enter 4 Numerical digit only";
        }
    }
    
    //validation for gender text box
    if (empty($_POST['gender'])) {
      $err['gender'] = "gender is required";
    }
    else {
        $gender = $_POST['gender'];
    }
    //validation for Amount text box
    $am = is_float($_POST['amount']);
    if (empty($_POST['amount'])) {
      $err['deposited'] = "Must be Enter amount";
    }
    else {
      if (($_POST['amount']>=500) & ($_POST['amount']<=25000)) {
          if ($_POST['amount']%500 == 0) {
            $Amount = $_POST['amount'];   
          }else {
            $err['deposited'] = "Must be Amount like(500, 1000, 1500 or 25,000)";
          }
        }
        else {
          $err['deposited'] = "Deposite Amount in limit 500 to 25000 only.";
        }
    }

    //if there is no error 
    if (!array_filter($err)) {
      $con = mysqli_connect("localhost","root","","machine");
      $find_query = "SELECT * FROM account_tbl ORDER BY account_id DESC";
      $selectQ = mysqli_query($con,$find_query)  or die("There is connection error!");
      $getAcc = mysqli_fetch_assoc($selectQ);

      if ($getAcc['account_no']<1) {
        //auto increament and get account number
        $getAcc['account_no'] = 1000;
      }else {
        $getAcc['account_no'] += 1;
      }
      $account_no = $getAcc['account_no'];
      
      $date = date('Y-m-d H:i:s');

      $insert_acc = "INSERT INTO account_tbl value('null','{$username}',{$pin},{$account_no},'{$gender}','{$date}');";
      $insert_acc .= "INSERT INTO transaction_tbl value('null',{$Amount},0,{$Amount},'{$date}',{$account_no});";
      $ins = mysqli_multi_query($con,$insert_acc)  or die("There is connection error!");
      
      if ($ins) {
        $err['reg'] = "<div class='alert alert-success'>Congratulation! Account Registered Successfully now you can login</div>";

      }else{
      $err['reg'] = "<div class='alert alert-danger'>There is mistake with form!</div>";

      }
      
      
    }


}


?>


<div class="container">
<div class="row"><br></div>
    <div class="row">
          <div class="col-md-4"></div>
          
          <div class="col-md-4 card p-4">
          <?php echo $err['reg'];?>
          <form action="" method="post">
          <div class="form-group">
              <label for="username" class="mr-4 font-weight-bold">Username</label>
              <input type="text" name="username" class="form-control pwd" value="<?php echo $username;?>" placeholder="Enter username" id="username" >
              <div class="text-danger"><?php echo $err['name'];?></div>
            </div>
            <div class="form-group">
              <label for="pwd" class="mr-4 font-weight-bold">Pin Code:</label>
              <input type="password" name="pin" class="form-control pwd" maxlength="4"  placeholder="Enter PinCode" id="pwd" >
              <div class="text-danger"><?php echo $err['pin'];?></div>
            </div>
            
          
          <div class="form-group">
              <label class="mr-4 font-weight-bold">Gender </label>
              <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" name="gender"  value="Male" class="custom-control-input" id="Male" >
                  <label class="custom-control-label" for="Male" >Male</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" name="gender" class="custom-control-input" id="Female" value="Female">
                  <label class="custom-control-label" for="Female">Female</label>
              </div>
                <div class="text-danger"><?php echo $err['gender'];?></div>

          </div>

          <div class="form-group">
              <label for="amount" class="mr-4 font-weight-bold">Enter The Deposited Amount</label>
              <input type="text" name="amount" class="form-control pwd"  placeholder="Enter Deposite Amount" id="amount" >
              <div class="text-danger"><?php echo $err['deposited'];?></div>
          </div>

            <div class="">
              <button type="submit" name="register" class="btn btn-primary btn-block">
                  <i class="fas fa-address-card"></i> Register
              </button>
              <a href="index.php" class="btn btn-info btn-block" role="button"><i class="fas fa-address-card"> </i> Go For Login</a>
              <!-- "  pattern="^[0-9]{4}$"-->
            </div>
          </form>
          </div>
          <div class="col-md-4"></div>
    </div>
</div>



<?php include "footer.php"; 

}
?>