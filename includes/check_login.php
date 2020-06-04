<?php

// if fname not present in session
if(!isset($_SESSION["fname"])){
    // redirect to login.php  if user not logged in
    header("location:login.php");
}

?>