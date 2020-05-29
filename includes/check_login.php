<?php

// if fname not present in session
if(!isset($_SESSION["fname"]) && !$_SESSION["role"]==1){
    // redirect to login.php  if user not logged in
    header("location:login.php");
}

?>