<?php 

$connection = mysqli_connect("localhost","root","","mysite");

if($connection){
    echo "<script>console.log(\"Connection successfull\")</script>";
}
else{
    die(mysqli_connect_error());
}

?>