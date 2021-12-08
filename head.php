<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- font Awosame -->
<script src="https://kit.fontawesome.com/997d2022e2.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="back.css">
<script>

function delete_num()
{
    var field = document.getElementById('pwd');
    field.value = field.value.slice(0, -1); //Extract from index 0 to the before-last character
    textbox.pop(); //Remove the last element from the number. It's length is maintained by js itself.
    return false;
}
</script>
</head>
<body>
    
<?php 
//basename($_SERVER['PHP_SELF'] this function get the current page name like(index.php) 
include("server.php");
?>
<div  id="slider">
