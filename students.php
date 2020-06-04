<?php
ob_start();
session_start();
include('includes/header.php'); 
include('includes/nav.php'); 
include('includes/database.php'); 
include('includes/check_login.php'); 

?>

<div class="modal fade" id="studentaddmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Student Data </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

        <form action="<?php echo $_SERVER["PHP_SELF"];?> " method="POST" enctype="multipart/form-data">

            <div class="modal-body">
                <div class="form-group">
                    <label> First Name </label>
                    <input type="text" name="fname" class="form-control" placeholder="Enter First Name">
                </div>

                <div class="form-group">
                    <label> Last Name </label>
                    <input type="text" name="lname" class="form-control" placeholder="Enter Last Name">
                </div>

                <div class="form-group">
                    <label> Course </label>
                    <input type="text" name="course" class="form-control" placeholder="Enter Course">
                </div>

                <div class="form-group">
                    <label> Phone Number </label>
                    <input type="number" name="contact" class="form-control" placeholder="Enter Phone Number">
                </div>
                <div class="form-group">
                    <label> image </label>
                    <input type="file" name="img_path" class="form-control" placeholder="Enter Phone Number">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="insertdata" class="btn btn-primary">Save Data</button>
            </div>
        </form>

    </div>
  </div>
</div>




<!-- ####################################################################################################################### -->

<!-- EDIT POP UP FORM (Bootstrap MODAL) -->

<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Edit Student Data </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

        <form action="<?php echo $_SERVER["PHP_SELF"];?> " method="POST" enctype="multipart/form-data">

            <div class="modal-body">

                <input type="hidden" name="update_id" id="update_id">

                <div class="form-group">
                    <label> First Name </label>
                    <input type="text" name="fname" id="fname" class="form-control" placeholder="Enter First Name">
                </div>

                <div class="form-group">
                    <label> Last Name </label>
                    <input type="text" name="lname" id="lname" class="form-control" placeholder="Enter Last Name">
                </div>

                <div class="form-group">
                    <label> Course </label>
                    <input type="text" name="course" id="course" class="form-control" placeholder="Enter Course">
                </div>

                <div class="form-group">
                    <label> Phone Number </label>
                    <input type="text" name="contact" id="contact" class="form-control" placeholder="Enter Phone Number">
                </div>
                <div class="form-group">
                    <label> Image </label>
                    <input type="file" name="img_path" id="img_path">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="updatedata" class="btn btn-primary">Update Data</button>
            </div>
        </form>

    </div>
  </div>
</div>

<!-- #################################################################################################### -->





<!-- ####################################################################################################################### -->

<!-- DELETE POP UP FORM (Bootstrap MODAL) -->

<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Delete Student Data </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

        <form action="<?php echo $_SERVER["PHP_SELF"];?> " method="POST">

            <div class="modal-body">

                <input type="hidden" name="delete_id" id="delete_id">

                <h4> Do you want to Delete this Data ??</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">  NO </button>
                <button type="submit" name="deletedata" class="btn btn-primary"> Yes !! Delete it. </button>
            </div>
        </form>

    </div>
  </div>
</div>

<!-- #################################################################################################### -->


<?php include('includes/message_flash.php'); ?>

<div class="container">

    <div class="container-fluid">
    <h2> Students </h2>
    
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#studentaddmodal">
                    ADD DATA
                </button>

        
            <?php
                
                $query = "SELECT * FROM student";
                $query_run = mysqli_query($connection, $query);
            ?>
                <table id="datatableid" class="table table-bordered ">
                   
                    <thead>
                        <tr>
                            <th scope="col"> ID</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name </th>
                            <th scope="col"> Course </th>
                            <th scope="col"> Contact </th>
                            <th scope="col"> Image </th>
                            <th scope="col"> EDIT </th>
                            <th scope="col"> DELETE </th>
                        </tr>
                    </thead>
                    <tbody>
            <?php
                 
                    foreach($query_run as $row)
                    {
            ?>
                   
                        <tr>
                            <td> <?php echo $row['id']; ?> </td>                            
                            <td> <?php echo $row['fname']; ?> </td>                            
                            <td> <?php echo $row['lname']; ?> </td>                            
                            <td> <?php echo $row['course']; ?> </td>                            
                            <td> <?php echo $row['contact']; ?> </td>  
                            <td style="color:#f8f9fc;"><?php echo $row['img_path']; ?><img height="100" src="uploads/<?php  echo trim($row["img_path"])?>"></td>                           
                            <td> 
                                <button type="button" class="btn btn-success editbtn"> EDIT </button>
                            </td> 
                            <td>
                                <button type="button" class="btn btn-danger deletebtn"> DELETE </button>
                            </td>
                        </tr>
                    
            <?php           
                    }
                
            ?>
            </tbody>
                </table>
        

    </div>
</div>

<!-- scripts here -->


<!-- crud here -->
<?php

if(isset($_POST['insertdata']))
{
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $course = $_POST['course'];
    $contact = $_POST['contact'];
    $img_path = $_POST['img_path'];

            // get the name of file
            $c_image = $_FILES['img_path']['name'];
            // get the location of file in chrome temp folder
            $c_image_tmp = $_FILES['img_path']['tmp_name'];
            // move the file from temp folder to server folder named uploads
            move_uploaded_file($c_image_tmp,"uploads/$c_image");

    

    $query = "INSERT INTO student (`fname`,`lname`,`course`,`contact`,`img_path`) VALUES ('$fname','$lname','$course','$contact','$c_image')";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['success']="Data Inserted";
        header('Location: students.php');
    }
    else
    {
        $_SESSION['danger']="Data Not Inserted";
        header('Location: students.php');
    }
}


if(isset($_POST['deletedata']))
{
    $id = $_POST['delete_id'];

    // DELETE IMAGE
    $query = "select * from student WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);

    // DELETE RECORD
    $query = "DELETE FROM student WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);



    if($query_run)
    {
        $_SESSION['success']="Data Deleted";
        header('Location: students.php');
    }
    else
    {
        $_SESSION['danger']="Data Not Deleted";
        header('Location: students.php');
    }
}



    if(isset($_POST['updatedata']))
    {   
        $id = $_POST['update_id'];
        
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $course = $_POST['course'];
        $contact = $_POST['contact'];

            // get the name of file
            $c_image = $_FILES['img_path']['name'];
            
            if($c_image){
                // get the location of file in chrome temp folder
            $c_image_tmp = $_FILES['img_path']['tmp_name'];
            // move the file from temp folder to server folder named uploads
            move_uploaded_file($c_image_tmp,"uploads/$c_image");


            $query = "UPDATE student SET fname='$fname', lname='$lname', course='$course', contact=' $contact', img_path=' $c_image' WHERE id='$id'  ";
            $query_run = mysqli_query($connection, $query);
            if($query_run)
                {
                    $_SESSION['success']="Data Updated";
                    header('Location: students.php');
                }
                else
                {
                    $_SESSION['danger']="Data Not Updated";
                    header('Location: students.php');
                }
            }

           else{
                // get the location of file in chrome temp folder
            $query = "UPDATE student SET fname='$fname', lname='$lname', course='$course', contact=' $contact' WHERE id='$id'  ";
            $query_run = mysqli_query($connection, $query);
            if($query_run)
                {
                    $_SESSION['success']="Data Updated No Image";
                    header('Location: students.php');
                }
                else
                {
                    $_SESSION['danger']="Data Not Updated";
                    header('Location: students.php');
                }
            }
            
        

        

    if($query_run)
    {
        $_SESSION['success']="Data Updated";
        header('Location: students.php');
    }
    else
    {
        $_SESSION['danger']="Data Not Updated";
        header('Location: students.php');
    }
    }


?>
<!-- crud here -->
<?php
include('includes/scripts.php');
include('includes/footer.php');
ob_flush();
?>
