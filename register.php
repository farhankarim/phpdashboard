<?php session_start();?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin 2 - Register</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
              </div>
              
   <?php

   
  if(isset($_SESSION["success"])){
    echo '
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
  <strong>Success: </strong>'.$_SESSION["success"].'
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
</div>';
    
    // delete success after showing in alert box
    unset( $_SESSION["success"]);
  }
  
    
  ?>

<?php

   
if(isset($_SESSION["danger"])){
  echo '
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
<strong>Success: </strong>'.$_SESSION["danger"].'
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>';
  
  // delete success after showing in alert box
  unset( $_SESSION["danger"]);
}

  
?>.
  
              <form method="post"  action="<?php echo $_SERVER["PHP_SELF"];?> " enctype="multipart/form-data">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" name="fname" class="form-control form-control-user" id="exampleFirstName" placeholder="First Name">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" name="lname" class="form-control form-control-user" id="exampleLastName" placeholder="Last Name">
                  </div>
                </div>
                
                <div class="form-group">
                  <input name="email" type="text" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address">
                </div>

                <div class="form-group">
                <label >Choose file</label> 
                <input name="image" type="file" >
              </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input name="password" type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Repeat Password">
                  </div>
                </div>
                
                <hr> <button class="btn btn-google btn-user btn-block"  type="submit" name="signup_submit">Sign Up</button>
                <hr>
                <div class="text-center">
                    <a class="small" href="login.php">Already have an account? Log in.</a>
                  </div>
              
              </form>
            
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>

<?php
include("includes/database.php");
if(isset($_POST['signup_submit'])){
  $fname=$_POST['fname'];
  $lname=$_POST['lname'];
  $email=$_POST['email'];
  $password=md5($_POST['password']);
  // get the name of file
  $c_image = $_FILES['image']['name'];
  // get the location of file in chrome temp folder
  $c_image_tmp = $_FILES['image']['tmp_name'];
  // move the file from temp folder to server folder named uploads
  move_uploaded_file($c_image_tmp,"uploads/$c_image");


$check_email="select * from users where email='$email'";
$check_query=mysqli_query($connection,$check_email);
if(mysqli_num_rows($check_query)>0){
  $_SESSION["danger"]="User with this email alredy exists.";
  header("location:register.php");
}
else{
  $query="insert into users (fname,lname,email,password,img_path) values('$fname','$lname','$email','$password','$c_image');";
  $reqult=mysqli_query($connection,$query);
  
    if($connection->query($query)){
        $_SESSION["success"]="User Created Successfully.".$email. $fname. " " .$lname;
        //send mail if user created successfully.
        // include("includes/mail.php");
        header("location:register.php");
    }
    else{
         echo $connection->error;
    }    
    
} 
  
}
?>