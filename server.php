<?php 
include "connect.php";
// This function for Select account data by session account id 
function select_trans($con,$session)
{
    
    $trans_query = "SELECT * FROM  transaction_tbl WHERE account_no= $session ORDER BY trans_id DESC";
    $run_select = mysqli_query($con,$trans_query)  or die("Select query is not correct");
    $show_data = mysqli_fetch_assoc($run_select);
    return $show_data;
}

if (isset($_GET["logout"])) {
    session_start();
    unset($_SESSION["account_id"]);
    unset($_SESSION["ac_id"]);
    unset ($_SESSION["ac_name"]);
    unset($_SESSION["ac_no"]);
    session_destroy();
    
    header("Location:index.php");
}
?>