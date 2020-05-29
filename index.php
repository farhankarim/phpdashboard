<?php
ob_start();
session_start();
include('includes/header.php'); 
include('includes/nav.php'); 
include('includes/database.php'); 
include('includes/check_login.php'); 

$sql="select * from users";
//pass the query with connection to function below to exececute query on server
$res=mysqli_query($connection,$sql);
?>

<div class="container-fluid">

<?php
if (isset($_SESSION["success"])) {


echo '
<div class="alert alert-success alert-dismissible fade show" role="alert">
<strong>Success: </strong>'.$_SESSION["success"].'
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>';
unset($_SESSION["success"]);

}

if (isset($_SESSION["danger"])) {


echo '
<div class="alert alert-danger alert-dismissible fade show" role="alert">
<strong>Success: </strong>'.$_SESSION["danger"].'
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>';
unset($_SESSION["danger"]);

}
                      
  
    
  ?>
<h3 class="m-0 font-weight-bold   text-primary">Registered Users</h6>
<br>
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<thead>
<th>ID</th>
<th>First Name</th>
<th>Last Name</th>
<th>Image</th>
<th>Edit</th>
<th>Delete</th>
</thead>
<tbody>
<!-- 
NOTE:if you get error on html tag that's because you cannot add html between 
php tags you have to close them manually before starting html code block -->

<?php
//if records exist in database
if(mysqli_num_rows($res)>0){
    //get records one by one and show using while loop
    // 1 record per tr tag
    while($data=mysqli_fetch_assoc($res))
    {
    ?>
        <tr>
        <td><?php echo $data["id"]?> </td>
        <td><?php echo $data["fname"]?> </td>
        <td><?php echo $data["lname"]?> </td>
        <td><img height="100" src="uploads/<?php  echo $data["img_path"]?>"></td>
        <td>
            <form action="edit_user.php" method="POST">
            <input type="hidden" name="user_id" 
            value="<?php echo $data["id"]?>" id="id">
        <button type="submit" class="btn btn-danger"
         name="edit_button">Edit</button>
            </form>
        
        
        </td>

        <td>
            <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
            <input type="hidden" name="user_id" value="<?php echo $data["id"]?>" id="id">
            <input type="hidden" name="image_path" value="<?php echo $data["img_path"]?>" id="id">
        <button type="submit" class="btn btn-danger"
         name="del_button">Delete</button>
            </form>
        </td>
        </tr>
    <?php
    if(isset($_POST["del_button"])){
        $id=$_POST["user_id"];
        $img_path=$_POST["img_path"];
      
        if($id==$_SESSION["user_id"]){
            $_SESSION['danger']="Cannot delete currently 
            logged-in user.";
        }
        else{
            $query = "delete from users where id='$id' ";
            $del_run=mysqli_query($connection,$query)
             or die(mysqli_error());

             if($del_run){
              $_SESSION['success']="Data Deleted";
              unlink("/uploads/"+$img_path);
              header("location:index.php");
        }
            else{
              $_SESSION['danger']="Data Not Deleted";
              header("location:index.php");
            } 
        }  
      }    
    }
}
else{?>
    
    <tr >
    <td colspan="4">No records found</td>
    </tr>
<?php
 }
  ?>
    



</tbody>
</table>

</div>



<?php
include('includes/scripts.php');
include('includes/footer.php');
ob_flush();
?>