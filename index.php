<?php
session_start();
if (isset($_SESSION["ac_name"])) {
  header("Location:Menu.php");
} //here close session ac_name
else{
  
include("head.php");
$err =  array('acc'=>'','pin'=>'','login'=>'');

if (isset($_POST['login'])) {

  //validation for account no text box
  if (empty($_POST['account_no'])) {
    $err['acc'] = "Account No# is required";
  }else {
    
    $pattern = '/^[0-9]{4}+$/';
    if (preg_match($pattern, $_POST['account_no'])) {
      $account = $_POST['account_no'];
    } 
    else{
      $err['acc'] = "Must be Enter 4 Numerical digit only";
    }
  }

  //validation for Pin code text box
  if (empty($_POST['pin'])) {
    $err['pin'] = "Must be Enter Pin Code";
  }else {
    
      // $check = is_numeric($_POST['pin']);
      $pattern = '/^[0-9]{4}+$/';
      if (preg_match($pattern, $_POST['pin'])) {
        $pin = $_POST['pin'];
      } 
      else{
        $err['pin'] = "Must be Enter 4 Numerical digit only";
      }

  }

  //if there is no error 
  if (!array_filter($err)) {
    include "connect.php";
    $find_query = "SELECT * FROM account_tbl WHERE pin= $pin AND account_no = $account";
    $selectQ = mysqli_query($con,$find_query)  or die("There is connection error!");
    $getAccount = mysqli_fetch_assoc($selectQ);
    if (mysqli_num_rows($selectQ)>0) {

      session_start();
      $_SESSION["ac_id"] = $getAccount["account_id"];
      $_SESSION["ac_name"] = $getAccount["username"];
      $_SESSION["ac_no"] = $getAccount["account_no"];

      header("location:Menu.php");
    }
    else{
      $err['login'] = "<div class='alert alert-danger'>Account No or Pincode is incorrect!</div>";
    }
  
  }


}
 

?>

    
<div class="container">
<div class="row"><br><br></div>
    <div class="row">
    <div class="col-md-4"></div>
    
    <div class="col-md-4 jumbotron">
    <?php echo $err['login'];?>
    <form action="" method="post">
    <div class="form-group">
        <label for="acnt">Account No# </label>
        <input type="text" name="account_no" class="form-control pwd" maxlength="4"  placeholder="Enter Account No#" id="acnt" >
        <div class="text-danger"><?php echo $err['acc'];?></div>
      </div>
      <div class="form-group">
        <label for="pwd">Pin Code:</label>
        <input type="password" name="pin" class="form-control pwd" maxlength="4"  placeholder="Enter PinCode" id="pwd" >
      </div>
      <div class="text-danger"><?php echo $err['pin'];?></div>
      <br>
      <div class="">
        <button type="submit" name="login" class="btn btn-info btn-block"><i class="fas fa-sign-in-alt"></i> login</button>
        <a href="register.php" class="btn btn-primary btn-block" role="button"><i class="fas fa-address-card"> </i> Register</a>
        <!-- <button type="button" name="clear"  onclick="delete_num()" class="btn btn-danger" > <i class='fas fa-backspace' style='color:white'> </i></button> -->
        <!-- "  pattern="^[0-9]{4}$"-->
      </div>
    </form>
    </div>
    <div class="col-md-4"></div>
    </div>
</div>

<?php include("footer.php");
  
  }?>
