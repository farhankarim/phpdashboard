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
