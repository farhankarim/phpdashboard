<?php
ob_start();
session_start();
include('includes/header.php'); 
include('includes/nav.php'); 
include('includes/database.php'); 

$id=0;
if(isset($_POST["edit_button"])){
    $id=$_POST["user_id"]; //35

    // echo $id;

    $query = "Select * from users where id='$id' ";
    $res=mysqli_query($connection,$query);
    $row =mysqli_fetch_assoc($res);

    
}

if(isset($_POST["edit_complete"])){
    $id=$_POST["user_id"];
   $fname=$_POST["fname"]; 
   $lname=$_POST["lname"];
   
   $update_query="update users set fname='$fname' , lname='$lname' where id='$id'";
   $update_run=mysqli_query($connection,$update_query) or die(mysqli_error());
   
   //return 1
   if($update_run){
       $_SESSION["success_msg"]="Record updated successfully";
       header("location:index.php");
   }
   else{
        header("location:edit_user.php");

   }
   

}


?>

<div class="container-fluid">
<form method="post"  action="<?php echo $_SERVER["PHP_SELF"];?> ">
  <div class="form-group">
    <label for="fname">First Name</label>
    <input type="text" name="fname" value="<?php if (isset($row["fname"])){echo $row["fname"];}?>" class="form-control" placeholder="Enter First Name" id="fname">
  </div>
  <div class="form-group">
    <label for="pwd">Last Name:</label>
    <input type="text" name="lname"  value="<?php if (isset($row["lname"])){echo $row["lname"];}?>" class="form-control" placeholder="Enter Last Name" id="lname">

  </div>
  <input type="hidden" name="user_id" 
            value="<?php echo $id?>" id="id">
  <button type="submit" name="edit_complete" class="btn btn-primary">Submit</button>
</form>
</div>

<?php
include('includes/scripts.php');
include('includes/footer.php');
//remove all echos from memory
ob_flush();
?>